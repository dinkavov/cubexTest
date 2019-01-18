<?php

namespace App\Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class AdminMail extends Model
{
	use Queueable, SerializesModels;
	
	protected $mess;

	public function __construct(Messages $mess)
    {
        $this->mess = $mess;
    }


    public function build()
    {
        //var_dump($this->mess);
        return $this->from('new@cubex.com', $this->mess->user->name)
                    ->to('email@example.com')
                    ->subject('You have new message '.$this->mess->user->name)
                    ->attach(public_path('storage/files/'.$this->mess->file))
                    ->view('emails.AdminMail')
                    ->with(['theme' => $this->mess->theme,
                            'content' => $this->mess->message,
                            'createdAt' => $this->mess->created_at,
                            'userName' => $this->mess->user->name]);
    }
}
