<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'level' => 1,
            'name' => 'Jean Bonnet',
            'img' => '/assets/profiles/user.png',
            'email' => 'utilisateur@email.com',
            'password' => Hash::make('password'),
            'bio' => 'lorem ipsum dolor sit amet'
        ]);
    }
}
