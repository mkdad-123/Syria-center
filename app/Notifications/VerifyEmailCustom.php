<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailCustom extends BaseVerifyEmail implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        // فعّل التنفيذ بعد اكتمال عملية الحفظ في DB
        $this->afterCommit(); // ✅ لا تُعرّف خاصية $afterCommit
    }

    // ضع قناة mail في طابور اسمه emails
    public function viaQueues(): array
    {
        return [
            'mail' => 'emails',
        ];
    }

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
