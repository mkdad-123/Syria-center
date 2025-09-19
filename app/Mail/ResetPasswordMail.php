<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $code;

    public function __construct($code)
    {
        $this->code = $code;
        $this->onQueue('emails');    // اختياري
        $this->afterCommit();
        // $this->onConnection('database'); // اختياري لو عندك اتصال صفوف مخصص

    }

    public function build()
    {
        return $this->subject('رمز إعادة تعيين كلمة المرور')
            ->view('customauth.email')
            ->with(['code' => $this->code]);
    }
}
