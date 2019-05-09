<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class PaymentRecieved extends Mailable
{
    use Queueable, SerializesModels;

    public $paymentDetails;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($paymentDetails,$user)
    {
        //
        $this->user=$user;
        $this->paymentDetails=$paymentDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.payment_received')
                    ->from('info@kidstories.app');
    }
}
