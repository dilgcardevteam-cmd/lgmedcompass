<?php

namespace App\Notifications;

use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceRequestWorkflowUpdate extends Notification
{
    use Queueable;

    public function __construct(
        public ServiceRequest $serviceRequest,
        public string $title,
        public string $message,
        public string $tab = 'my-requests'
    ) {}

    /**
     * Get the delivery channels for the notification.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $notifiable instanceof User ? ['database', 'mail'] : ['mail'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'service_request_id' => $this->serviceRequest->id,
            'service_type' => $this->serviceRequest->service_type,
            'url' => route('request.index', ['tab' => $this->tab]),
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $serviceRequest = $this->serviceRequest;
        $data = [
            'requesterName' => $serviceRequest->requester_name,
            'requestReference' => 'REQ-'.($serviceRequest->requested_at?->format('Y') ?? now()->format('Y')).'-'.str_pad((string) $serviceRequest->getKey(), 6, '0', STR_PAD_LEFT),
            'requestSubject' => $serviceRequest->subject,
            'serviceType' => $serviceRequest->service_type,
            'otherServiceType' => $serviceRequest->other_service_type,
            'status' => $serviceRequest->status,
            'dateNeeded' => $serviceRequest->date_needed?->format('F j, Y'),
            'updateTitle' => $this->title,
            'updateMessage' => $this->message,
            'latestComment' => $serviceRequest->last_comment,
            'deliverableLink' => $serviceRequest->deliverable_link,
            'hasDeliverableFiles' => $serviceRequest->status === ServiceRequest::STATUS_COMPLETED
                && $serviceRequest->deliverables()->exists(),
            'trackingUrl' => route('request.track', $serviceRequest->tracking_token),
        ];

        return (new MailMessage)
            ->subject($this->title)
            ->view('emails.service-request-update', $data)
            ->text('emails.service-request-update-text', $data);
    }
}
