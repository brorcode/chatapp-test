<?php

namespace App\Services;

use App\Models\Chat;
use Illuminate\Contracts\Pagination\Paginator;

class ChatService
{
    public function getChats(): Paginator
    {
        return Chat::query()
            ->select('id', 'name', 'last_message', 'last_message_created_at')
            ->orderByDesc('last_message_created_at')
            ->simplePaginate(config('chatapp.per_page'))
        ;
    }
}
