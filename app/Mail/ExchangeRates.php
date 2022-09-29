<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class ExchangeRates extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = config('app.mail_from');
        $name = config('app.mail_name');
        $files = public_path('images/drey.png');


        return $this->from($from, $name)
            ->view('emails.exchange_rates')
            ->with([
            'exchange' => $this->mailData,
             ])
            ->attach($files);
            //->html('emails.orders.shipped_plain');

    }
}
