<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use function Symfony\Component\Translation\t;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $url;

    public function __construct($url)
    {
        $this->url=$url;
    }


    public function build()
    {
        return $this->from('admin@admin.com')->markdown('emails.reset-password-email',['url'=>$this->url]);
    }
}
