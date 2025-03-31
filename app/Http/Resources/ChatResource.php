<?php

namespace App\Http\Resources;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    private function getResource(): Chat
    {
        return $this->resource;
    }

    public function toArray(Request $request): array
    {
        $chat = $this->getResource();

        return [
            'id' => $chat->getKey(),
            'name' => $chat->name,
            'last_message' => $chat->last_message,
            'last_message_created_at' => $chat->last_message_created_at->toDateTimeString(),
        ];
    }
}
