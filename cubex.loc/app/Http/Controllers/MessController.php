<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMess;
use App\Mail\AdminMail;
use App\Models\Messages;
use App\Repositories\MessRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessController extends Controller
{
	protected $messRepository;

    public function __construct(MessRepository $messRepository)
    {
        $this->middleware('auth');
        $this->messRepository = $messRepository;
    }

    public function index()
    {
        if(Gate::allows('adminAction')){
            $allMess = $this->messRepository->getAllMess();
            return view('mess.indexmess')->with(['mess' => $allMess]);
        } else {
            return redirect('/')->with('error', 'You cannot view all mess');
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
            Mail::queue(new AdminMail($mess));
            return redirect('/')->with('success', 'Заявка отправлена');
        }
        else
            return redirect('/')->with('error', 'На сегоднешний день ваш лимит заявок исчерпан.');
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
            return redirect('/')->with('error', 'You can not view this mess!');
        }
    }

    public function markAsViewed(Request $request, $messId)
    {
        if(Gate::allows('adminAction')){
            $this->messRepository->markAsViewed($messId);
            return redirect()->route('mess.index')->with('success', 'Сообщение отмечено прочитанным');
        }
        else
            return redirect('/')->with('error', 'You cannot perform this action');
    }

    public function ushow()
    {
        if(!Gate::allows('adminAction')){
            $mess = $this->messRepository->getLatestUserMess(Auth::user()->id);
            return view('mess.ushowmess', ['mess' => $mess]);
        }//ща от юзера несколько создам для проверки, но все равно админ видит ток последнюю, аааааа.... сделать тобы админ все видел? да, ВСе от определеннгоого юзера, ща проверю, зачекай
    }
}
