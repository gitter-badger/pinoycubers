<?php

namespace App\Accounts;

use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class VerificationEmailSender
{
    /**
     * @var Illuminate\Mail\Mailer
     */
    protected $mailer;

    /**
     * @var string
     */
    protected $view = 'emails.auth.verification';

    /**
     * @param Illuminate\Mail\Mailer $mailer
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(User $user)
    {
        $data = ['verificationCode' => $user->verification_code];

        $this->mailer->send($this->view, $data, function(Message $message) use($user) {
            $message->to($user->email)
            $message->subject('Pinoy Cubers: Verify your email address');
        });
    }
}
