<?php

namespace App\Notifications;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ServiceRequestReceived extends Notification
{
    use Queueable;

    public function __construct(public ServiceRequest $serviceRequest) {}

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
    public function toDatabase(object $notifiable): array
    {
        $isDataAnalysis = $this->serviceRequest->service_type === ServiceRequest::SERVICE_TYPE_DATA_ANALYSIS;

        return [
            'title' => $isDataAnalysis ? 'New Data Analysis Request' : 'New Request for Review',
            'message' => $isDataAnalysis
                ? "A new Data Analysis request was submitted: {$this->serviceRequest->subject}"
                : "A new request was submitted for review: {$this->serviceRequest->subject}",
            'service_request_id' => $this->serviceRequest->id,
            'service_type' => $this->serviceRequest->service_type,
            'url' => route('request.index'),
        ];
    }
}
