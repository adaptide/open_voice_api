<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $organization = Organization::first();

        Category::create([
            'name' => 'Әдеби мәтіндер',
            'slug' => Str::slug('Әдеби мәтіндер'),
            'description' => 'Қазақ әдебиетінен алынған үзінділер.',
            'image' => null,
            'organization_id' => $organization->id,
        ]);
    }
}
