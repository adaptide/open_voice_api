<?php

namespace Database\Seeders;

use App\Models;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Models\Organization::factory()->count(5)->create();
        Models\Project::factory()->count(10)->create();
        Models\Category::factory()->count(10)->create();
        Models\Text::factory()->count(50)->create();
        Models\Recording::factory()->count(50)->create();
        Models\Review::factory()->count(30)->create();
        Models\License::factory()->count(5)->create();
        Models\Contribution::factory()->count(20)->create();
        Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
