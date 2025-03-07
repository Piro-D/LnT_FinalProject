<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call necessary seeders first
        // $this->call([
        //     AdminSeeder::class,
        //     CategorySeeder::class,
        // ]);

        // Ensure categories exist before seeding inventories
        Inventory::factory(20)->create();
    }
}
