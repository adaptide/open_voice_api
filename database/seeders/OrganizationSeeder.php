<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class OrganizationSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();

        Organization::create([
            'name' => 'Қазақ Тіл Деректер Қоры',
            'slug' => Str::slug('Қазақ Тіл Деректер Қоры'),
            'email' => 'info@kazcorpus.kz',
            'phone' => '+7 777 123 4567',
            'logo' => null,
            'owner_id' => $user->id ?? 1,
        ]);
    }
}
