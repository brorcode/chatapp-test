<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Services\ChatService;
use Illuminate\Http\JsonResponse;

class ChatController extends Controller
{
    public function index(ChatService $chatService): JsonResponse
    {
        return response()->json([
            'chats' => ChatResource::collection($chatService->getChats()),
        ]);
    }
}
