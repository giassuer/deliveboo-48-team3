<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_order)
    {
        $this->order=$_order;
    }

   
    public function build()
    {
        $order=$this->order;
        return $this->view('admin.mails.new-order-notification',compact('order'));
    }
}