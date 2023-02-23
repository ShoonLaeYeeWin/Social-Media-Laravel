<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123@'),
            'type' => '0',
            'address' => 'Yangon',
            'phone' => '09441003608',
            'dob' => '2023-02-01',
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('User123@'),
            'type' => '1',
            'address' => 'Mandalay',
            'phone' => '09910036081',
            'dob' => '2023-02-01',
        ]);
    }
}
