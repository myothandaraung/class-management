<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $action;

    /**
     * Create a new message instance.
     *
     * @param $talk
     * @param $sender
     */
    public function __construct(string $action,$user)
    {
        $this->user = $user;
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->action === 'student_registration' ? '生徒登録' : '教師登録';
        return $this->view('emails.' . $this->action)
            ->subject($subject)
            ->with([
                'user' => $this->user,
            ]);
    }
}
