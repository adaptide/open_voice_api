<?php

namespace Database\Factories;

use App\Models\Recording;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'recording_id' => Recording::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'feedback' => $this->faker->sentence,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
