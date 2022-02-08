<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    // send mail
    public function sendMail(){

        // email data
        $email_data = array(
            'name' => 'Adura',
            'email' => 'aduramimodamilare@gmail.com',
        );

        // send email with the template
        Mail::send($email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['name'])
                ->subject('Welcome to Shopping Cart')
                ->from('info@shop_cart.com', 'Shopping Cart')
                ->send(new Welcome($email_data));
        });
        return view('shopping-cart/mail-test');



    }
}
