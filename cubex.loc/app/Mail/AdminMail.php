<?php

namespace App\Mail;

use App\Models\Messages;
use Illuminate\Mail\Mailable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class AdminMail extends Mailable
{
	
	protected $mess;

	public function __construct(Messages $mess)
    {
        $this->mess = $mess;
    }

    public function build()
    {
        $mail = $this->from('crm.urich@gmail.com', $this->mess->user->name)
                    ->to('vladislav5133@gmail.com')
                    ->subject('You have new message '.$this->mess->user->name)
                    ->view('emails.AdminMail')
                    ->with(['theme' => $this->mess->theme,
                            'content' => $this->mess->message,
                            'createdAt' => $this->mess->created_at,
                            'userName' => $this->mess->user->name]);

        if (!empty($this->mess->file))
            $mail->attach(public_path('storage/files/'.$this->mess->file));

        return $mail;
    }
}
