<?php

namespace App\Notifications;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ServiceRequestDeadlineReminder extends Notification
{
    use Queueable;

    public function __construct(
        public ServiceRequest $serviceRequest,
        public string $reminderType
    ) {}

    /**
     * Get the delivery channels for the notification.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $message = match ($this->reminderType) {
            'overdue' => "This request is overdue. It was needed by {$this->serviceRequest->date_needed->format('M j, Y')}: {$this->serviceRequest->subject}",
            'today' => "This request is due today: {$this->serviceRequest->subject}",
            default => "This request is due within three days, on {$this->serviceRequest->date_needed->format('M j, Y')}: {$this->serviceRequest->subject}",
        };

        return [
            'title' => 'Request deadline reminder',
            'message' => $message,
            'type' => $this->reminderType,
            'service_request_id' => $this->serviceRequest->id,
            'service_type' => $this->serviceRequest->service_type,
            'date_needed' => $this->serviceRequest->date_needed->toDateString(),
            'url' => route('request.index', [
                'tab' => $this->serviceRequest->assigned_to_id === null ? 'incoming' : 'claimed',
            ]),
        ];
    }
}
