<?php
namespace App\Observers;
use App\Notifications\NotifUser;

class ItemObserver
{
    public function created()
    {
        $author = $item->user;
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NotifUser());
        }
    }
}