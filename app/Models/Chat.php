<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\ChatFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $name
 * @property string|null $last_message
 * @property Carbon|null $last_message_created_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Collection $messages
 */
class Chat extends Model
{
    /** @use HasFactory<ChatFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'last_message_created_at' => 'datetime',
        ];
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
