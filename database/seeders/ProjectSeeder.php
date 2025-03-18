<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ProjectSeeder extends Seeder
{
    public function run()
    {
        $organization = Organization::first();

        Project::create([
            'organization_id' => $organization->id,
            'name' => 'Қазақша Дауыстық Дерекқор',
            'slug' => Str::slug('Қазақша Дауыстық Дерекқор'),
            'description' => 'Бұл жоба қазақ тіліндегі сөйлеу деректерін жинақтауға арналған.',
            'is_public' => true,
        ]);
    }
}
