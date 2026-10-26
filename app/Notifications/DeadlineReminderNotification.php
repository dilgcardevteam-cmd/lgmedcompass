<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class DeadlineReminderNotification extends Notification
{
    protected $document;

    public function __construct($document, $message, $type)
    {
        $this->document = $document;
        $this->message = $message;
        $this->type = $type;
    }

    public function toArray($notifiable)
    {
        return [
            'document_id' => $this->document->id,
            'title' => $this->document->subject_title,
            'message' => $this->message,
            'type' => $this->type,
            'url' => route('documents.index'),
        ];
    }

    public function via($notifiable)
    {
        return ['database'];
    }
}
