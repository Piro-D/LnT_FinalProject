<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'adminTest',
            'password' => 'admin123',
            'role' => 'admin',
            'phone' => '081241005971',
            'address'=> 'Test Address',
            'postal' => '12345',],
        );
    }
}
