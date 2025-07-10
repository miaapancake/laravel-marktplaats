<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chats.{chat}', function (User $user, Chat $chat) {
    return $chat->users()->get()->contains('id', $user->id);
});
