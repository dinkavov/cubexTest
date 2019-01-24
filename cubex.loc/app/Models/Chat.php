<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
	const SEND_USER = 0;
	const SEND_MANAGER = 1;

	protected $table = 'chats';

	protected $fillable = [
		'request_id',
		'text',
		'isManager'
	];

	public function message()
	{
	    return $this->belongsTo('App\Models\Messages', 'request_id');
	}

	public function getChatMessages($request_id)
	{
		return self::where(['request_id' => $request_id])->get();
	}
}
