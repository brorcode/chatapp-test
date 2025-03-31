<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        Chat::factory(100)->create()->each(function (Chat $chat) {
            $messages = Message::factory()
                ->count(rand(10, 100))
                ->for($chat)
                ->create()
                ->sortByDesc('created_at');

            /** @var Message $lastMessage */
            $lastMessage = $messages->first();

            $chat->last_message = Str::limit($lastMessage->message, 100, '');
            $chat->last_message_created_at = $lastMessage->created_at;
            $chat->updated_at = $lastMessage->created_at;
            $chat->save();
        });
    }
}
