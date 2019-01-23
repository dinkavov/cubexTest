<?php


namespace App\Repositories;

interface IMessRepository{
    public function storeMess(array $data, $userId, $filePath);

    public function getMessById($messId);

    public function getAllMess();

    public function markAsViewed($messId);

    public function getLatestUserMess($userId);

    public function getLastUserMessage($userId);
}