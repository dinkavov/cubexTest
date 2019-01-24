<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMess;
use App\Mail\AdminMail;
use App\Models\Messages;
use App\Models\Chat;
use App\Repositories\MessRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessController extends Controller
{
    protected $chat;
	protected $messRepository;

    public function __construct(MessRepository $messRepository)
    {
        $this->middleware('auth');
        $this->chat = new Chat();
        $this->messRepository = $messRepository;
    }

    public function index()
    {
        if(Gate::allows('adminAction')){
            $allMess = $this->messRepository->getAllMess();

            return view('mess.indexmess')->with(['mess' => $allMess]);
        } else {
            return redirect('/home')->with('error', 'You cannot view all mess');
        }
    }

    public function create()
    {
        return view('mess.createmess');
    }

    public function store(StoreMess $request)
    {
        if(Gate::allows('makeMess')){
            $mess = $this->messRepository->storeMess($request->input(), Auth::id(), $this->getFileNameToStore($request));
            Mail::to("vladislav5133@gmail.com")->send(new AdminMail($mess));
            
            return redirect('/home')->with('success', 'Заявка отправлена');
        }
        else
            return redirect('/home')->with('error', 'Заявку можно отправлять не чаще чем 1 раз в 5 минут.');
    }

    private function getFileNameToStore(StoreMess $request){
        if ($request->hasFile('file')){
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('file')->storeAs('public/files', $filenameToStore);
        }
        else
            $filenameToStore = null;

        return $filenameToStore;
    }

    public function show($id)
    {
        if(Gate::allows('adminAction')){
            $mess = $this->messRepository->getMessById($id);
            return view('mess.showmess', ['mess' => $mess]);
        } else {
            return redirect('/home')->with('error', 'You can not view this mess!');
        }
    }

    public function markAsViewed(Request $request, $messId)
    {
        if(Gate::allows('adminAction')){
            $this->messRepository->markAsViewed($messId);

            $this->chat::create([
                'request_id' => $messId,
                'text' => 'Ваша заявка была просмотрена! Ожидайте ответа.',
                'isManager' => Chat::SEND_MANAGER
            ]);

            return redirect()->route('mess.index')->with('success', 'Сообщение отмечено прочитанным');
        }
        else
            return redirect('/home')->with('error', 'You cannot perform this action');
    }

    public function ushow()
    {
        if(!Gate::allows('adminAction')){
            $mess = $this->messRepository->getLatestUserMess(Auth::user()->id);

            return view('mess.ushowmess', ['mess' => $mess]);
        }
    }
}