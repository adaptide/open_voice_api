<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\Text;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TextSeeder extends Seeder
{
    public function run()
    {
        $project = Project::first();
        $category = Category::first();

        Text::create([
            'project_id' => $project->id,
            'category_id' => $category->id,
            'content' => 'Абай жолы – Мұхтар Әуезовтың ұлы шығармасы.',
            'is_public' => true,
        ]);
    }
}
