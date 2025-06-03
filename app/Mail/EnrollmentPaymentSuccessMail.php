<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class EnrollmentPaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $action;
    public $payment;
    public $enrollment;
    /**
     * Create a new message instance.
     *
     * @param $student
     * @param $payment
     * @param $enrollment
     */
    public function __construct(string $action, $payment, $enrollment, $student)
    {
        $this->student = $student;
        $this->action = $action;
        $this->payment = $payment;
        $this->enrollment = $enrollment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->action === 'EnrollmentPaymentSuccess' ? '生徒登録' : '教師登録';
        return $this->view('emails.' . $this->action)
            ->subject($subject)
            ->with([
                'student' => $this->student,
                'payment' => $this->payment,
                'enrollment' => $this->enrollment,
            ]);
    }
}
