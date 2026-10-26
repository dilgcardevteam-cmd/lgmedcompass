<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class AccountDeclined extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Account Request Declined')
            ->view('emails.account-declined', [
                'user' => $notifiable,
                'logoUrl' => $this->logoUrl(),
                'logoPath' => $this->logoPath(),
            ]);
    }

    private function logoPath(): ?string
    {
        $logoPath = public_path('images/lgmed-logo-email.png');

        return is_file($logoPath) ? $logoPath : null;
    }

    private function logoUrl(): ?string
    {
        $applicationUrl = Config::get('app.url');

        if (! is_string($applicationUrl) || $applicationUrl === '') {
            return null;
        }

        if (! filter_var($applicationUrl, FILTER_VALIDATE_URL)) {
            return null;
        }

        $scheme = parse_url($applicationUrl, PHP_URL_SCHEME);
        $host = parse_url($applicationUrl, PHP_URL_HOST);

        if ($scheme !== 'https' || $host === null || in_array($host, ['127.0.0.1', 'localhost'], true)) {
            return null;
        }

        return rtrim($applicationUrl, '/').'/images/lgmed-logo-email.png';
    }
}
