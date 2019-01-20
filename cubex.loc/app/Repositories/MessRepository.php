<?php
namespace App\Repositories;

use App\Models\Messages;

class MessRepository implements IMessRepository
{
    protected $mess;

    public function __construct(Messages $mess)
    {
        $this->mess = $mess;
    }

    public function storeMess(array $data, $userId, $filePath) : Messages
    {
        $newMess = new Messages();
        $newMess->user_id = $userId;
        $newMess->theme = $data['messageTheme'];
        $newMess->message = $data['message'];
        $newMess->file = array_key_exists('file', $data) == true  ? null : $filePath;
        $newMess->save();
        return $newMess;
    }

    public function getMessById($messId)
    {
        return Messages::find($messId);
    }

    public function getAllMess()
    {
        return Messages::all();
    }

    public function markAsViewed($messId)
    {
        $mess= Messages::find($messId);
        $mess->isViewed = true;
        $mess->save();
    }

    public function getLatestUserMess($userId){
        $mess = Messages::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return $mess;
    }
}