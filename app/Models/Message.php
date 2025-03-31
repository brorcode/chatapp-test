<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\MessageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $chat_id
 * @property string $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Chat $chat
 */
class Message extends Model
{
    /** @use HasFactory<MessageFactory> */
    use HasFactory;

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
