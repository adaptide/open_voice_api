<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->sentence(3);

        return [
            'organization_id' => Organization::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph,
            'is_public' => $this->faker->boolean(70),
        ];
    }
}
