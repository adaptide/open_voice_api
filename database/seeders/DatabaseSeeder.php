<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            OrganizationSeeder::class,
            ProjectSeeder::class,
            CategorySeeder::class,
            TextSeeder::class,
            RecordingSeeder::class,
            ReviewSeeder::class,
            LicenseSeeder::class,
        ]);
    }
}
