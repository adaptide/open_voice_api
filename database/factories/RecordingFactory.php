<?php

namespace Database\Factories;

use App\Models\Text;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recording>
 */
class RecordingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'text_id' => Text::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'path' => $this->faker->url,
            'status' => $this->faker->randomElement(['pending', 'validated', 'rejected']),
        ];
    }
}
