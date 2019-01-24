<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
	protected $chat;

    public function __construct()
    {
        $this->middleware('auth');
        $this->chat = new Chat();
    }

    public function index($request_id)
    {
    	if (Gate::allows('adminAction')){
    		$manager = true;
	    	$messages = $this->chat->getChatMessages($request_id);

	    	return view('chat.index')->with([
	    		'request_id' => $request_id,
	    		'messages' => $messages,
	    		'manager' => $manager
	    	]);
    	} else {
    		return redirect('/home')->with('error', 'You cannot view manager chat.');
    	}
    }

    public function user($request_id)
    {
    	$manager = false;
    	$messages = $this->chat->getChatMessages($request_id);

    	return view('chat.index')->with([
    		'request_id' => $request_id,
    		'messages' => $messages,
    		'manager' => $manager
    	]);
    }

    public function sendMessage(Request $request)
    {
    	$data = $request->all();

    	$isManager = Auth::user()->id == 1 ?? 0;

    	$this->chat::create([
    		'request_id' => $request->request_id,
    		'text' => $request->message,
    		'isManager' => $isManager
    	]);

    	return response()->json([
    		'status' => 'success',
    		'data' => [
    			'message' => $request->message,
    			'isManager' => $isManager     		]
    	], 200);   
    }
}
