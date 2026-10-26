<?php

namespace App\Notifications;

use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FocalPersonAssigned extends Notification
{
    use Queueable;

    public function __construct(
        public Document $document,
        public string $assignedBy,
        public string $previousFocalPerson
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Document Assignment',
            'message' => "You have been assigned as the focal person for: {$this->document->subject_title}",
            'document_id' => $this->document->id,
            'assigned_by' => $this->assignedBy,
            'previous_focal_person' => $this->previousFocalPerson,
            'assignment_step' => 'Focal Person Assignment',
            'due_date' => $this->document->created_at,
            'status' => $this->document->status,
            'url' => route('documents.index'),
        ];
    }
}
