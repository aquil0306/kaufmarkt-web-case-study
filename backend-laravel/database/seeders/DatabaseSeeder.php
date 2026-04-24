<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Optional vehicle catalog: php artisan db:seed --class=VehicleCatalogSeeder
        $this->call([
            InstallationSeeder::class,
            SystemUpgradeSeeder::class,
        ]);
    }
}
