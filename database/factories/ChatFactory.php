<?php

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Chat>
 */
class ChatFactory extends Factory
{
    /** @var class-string<Chat>  */
    protected $model = Chat::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'created_at' => $date = fake()->dateTimeBetween('-2 months'),
            'updated_at' => $date,
        ];
    }
}
