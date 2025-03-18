<?php

namespace Database\Seeders;

use App\Models\License;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LicenseSeeder extends Seeder
{
    public function run()
    {
        License::create([
            'name' => 'Creative Commons Attribution 4.0',
            'slug' => Str::slug('Creative Commons Attribution 4.0'),
            'description' => 'Бұл лицензия бойынша деректерді еркін таратуға және өзгертуге болады.',
        ]);
    }
}
