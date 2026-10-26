<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class UserDeclinedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Account Request Declined')
            ->view('emails.user-declined', [
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
