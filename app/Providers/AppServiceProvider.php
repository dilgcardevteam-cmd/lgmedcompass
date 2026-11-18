<?php

namespace App\Providers;

use App\Models\CalendarEvent;
use App\Models\Document;
use App\Models\DocumentProcess;
use App\Models\LgmedReport;
use App\Models\User;
use App\Policies\CalendarEventPolicy;
use App\Policies\DocumentPolicy;
use App\Policies\DocumentProcessPolicy;
use App\Policies\LgmedReportPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Document::class, DocumentPolicy::class);
        Gate::policy(CalendarEvent::class, CalendarEventPolicy::class);
        Gate::policy(DocumentProcess::class, DocumentProcessPolicy::class);
        Gate::policy(LgmedReport::class, LgmedReportPolicy::class);
        Gate::define('manage-accounts', function (User $user): bool {
            return $user->role !== 'Employee';
        });

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Your Email Address') // Custom subject
                ->line('Please click the button below to verify your email address.') // Custom text
                ->action('Verify Email Address', $url) // The button
                ->line('If you did not create an account, no further action is required.'); // Footer text
        });

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        Gate::define('update-user', function (User $authUser, User $targetUser) {
            return $authUser->role === 'Admin';
        });

        Gate::define('delete-user', function (User $authUser, User $targetUser) {
            return $authUser->role === 'Admin';
        });

        Gate::define('view-any-user', function (User $authUser) {
            return in_array($authUser->role, ['Admin', 'Technical Inspector']);
        });
    }
}
