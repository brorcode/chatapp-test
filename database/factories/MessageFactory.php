<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /** @var class-string<Message>  */
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'chat_id' => Chat::factory(),
            'message' => fake()->text(fake()->numberBetween(100, 1000)),
            'created_at' => $date = fake()->dateTimeBetween('-1 month'),
            'updated_at' => $date,
        ];
    }
}
