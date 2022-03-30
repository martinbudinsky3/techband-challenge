<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@mail.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Test Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'is_admin' => true
        ]);
    }
}
