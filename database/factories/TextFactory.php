<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Text>
 */
class TextFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'project_id' => Project::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'content' => $this->faker->paragraph(5),
        ];
    }
}
