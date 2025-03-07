<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Fiction', 'Education', 'Action', 'Comedy', 'Other'];

        foreach($categories as $c){
            category::updateOrCreate(['name' => $c]);
        }
    }
}
