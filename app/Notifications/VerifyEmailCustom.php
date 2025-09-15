<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailCustom extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('تفعيل حسابك — المركز السوري للتنمية المستدامة والتمكين المجتمعي')
            ->view('mail.verify-emaill', [
                'url'  => $url,
                'user' => $notifiable,
            ]);
    }
}
