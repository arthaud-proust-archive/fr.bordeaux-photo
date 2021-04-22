<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role' => '["user"]',
            'name' => 'Jean Bonnet',
            'img' => '/assets/profiles/user.png',
            'email' => 'utilisateur@email.com',
            'password' => Hash::make('password'),
            'bio' => 'Je suis un utilisateur'
        ]);

        DB::table('users')->insert([
            'role' => '["jury"]',
            'name' => 'Jean Jury',
            'img' => '/assets/profiles/user.png',
            'email' => 'jury@email.com',
            'password' => Hash::make('password'),
            'bio' => 'Je suis un jury'
        ]);

        DB::table('users')->insert([
            'role' => '["admin"]',
            'name' => 'Jean Admin',
            'img' => '/assets/profiles/user.png',
            'email' => 'admin@email.com',
            'password' => Hash::make('password'),
            'bio' => 'J\'administre'
        ]);
    }
}
