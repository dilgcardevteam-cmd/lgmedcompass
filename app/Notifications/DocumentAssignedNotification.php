<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DocumentAssignedNotification extends Notification
{
    use Queueable;

    protected $document;

    public function __construct($document)
    {
        $this->document = $document;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'document_id' => $this->document->id,
            'title' => $this->document->subject_title,
            'message' => 'A document was assigned to you for review.',
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'document_id' => $this->document->id,
            'title' => $this->document->subject_title,
            'type' => $this->type,
            'message' => $this->message ?? $this->getDefaultMessage(),
            'url' => $this->url ?? route('documents.index'),
        ];
    }

    protected function getDefaultMessage()
    {
        return match ($this->type) {
            'deadline_reminder' => 'Deadline reminder',
            'document_assigned' => 'A document was assigned to you for review.',
            default => 'Notification',
        };
    }
}
