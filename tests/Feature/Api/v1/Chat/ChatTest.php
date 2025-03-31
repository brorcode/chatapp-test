<?php

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->perPage = config('chatapp.per_page');

    $this->chats = Chat::factory($this->perPage + 1)->create()->each(function (Chat $chat) {
        $messages = Message::factory()
            ->count(2)
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
});

test('can fetch chats list', function () {
    expect(Chat::query()->count())->toBe($this->perPage + 1);

    $response = $this->get(route('api.v1.chats.index'));
    $response
        ->assertOk()
        ->assertJsonCount($this->perPage, 'chats')
        ->assertExactJson([
            'chats' => $this->chats
                ->sortByDesc('last_message_created_at')
                ->take($this->perPage)
                ->values()
                ->map(function (Chat $chat) {
                    return [
                        'id' => $chat->getKey(),
                        'name' => $chat->name,
                        'last_message' => $chat->last_message,
                        'last_message_created_at' => $chat->last_message_created_at->toDateTimeString(),
                    ];
                })
                ->toArray()
            ,
        ])
    ;
});

test('can fetch chats list with pagination', function () {
    expect(Chat::query()->count())->toBe($this->perPage + 1);

    /** @var Chat $page2Chat */
    $page2Chat = $this->chats->sortBy('last_message_created_at')->first();

    $response = $this->get(route('api.v1.chats.index', ['page' => 2]));
    $response
        ->assertOk()
        ->assertJsonCount(1, 'chats')
        ->assertExactJson([
            'chats' => [
                [
                    'id' => $page2Chat->getKey(),
                    'name' => $page2Chat->name,
                    'last_message' => $page2Chat->last_message,
                    'last_message_created_at' => $page2Chat->last_message_created_at->toDateTimeString(),
                ]
            ],
        ])
    ;
});

test('returns empty array when fetching page with no chats', function () {
    expect(Chat::query()->count())->toBe($this->perPage + 1);

    $response = $this->get(route('api.v1.chats.index', ['page' => 3]));
    $response
        ->assertOk()
        ->assertExactJson([
            'chats' => [],
        ])
    ;
});
