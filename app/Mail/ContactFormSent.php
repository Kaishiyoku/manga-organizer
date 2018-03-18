<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormSent extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $fullname;
    public $content;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $fullname
     * @param $content
     */
    public function __construct($email, $fullname, $content)
    {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('home.contact.subject', ['name' => env('APP_NAME_LONG')]))
            ->view('emails.contact.sent')
            ->text('emails.contact.sent')
            ->with([
                'email' => $this->email,
                'fullname' => $this->fullname,
                'content' => $this->content
            ]);
    }
}
