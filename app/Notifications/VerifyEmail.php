<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;

class VerifyEmail extends BaseVerifyEmail
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        $password = \Str::random(10);
        $notifiable->password = \Hash::make($password);
        $notifiable->save();

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        // This is mainly a phpstan fix
        $action = !is_array(\Lang::get('Verify Email Address')) ? \Lang::get('Verify Email Address') : 'Verify Email Address';

        return (new MailMessage)
            ->subject($action)
            ->line(\Lang::get('Please click the button below to verify your email address.'))
            ->action($action, $verificationUrl)
            ->line(\Lang::get('If you did not create an account, no further action is required.'))
            ->line(\Lang::get('Your password is: :password', ['password' => $password]));
    }
}
