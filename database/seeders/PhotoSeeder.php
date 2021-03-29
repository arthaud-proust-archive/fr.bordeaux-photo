<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'title' => 'Photo test',
            'author' => 'ejRe',
            'author_name' => 'Arthaud Proust',
            'event' => 'ejRe',
            'photo' => '/assets/photos/ejRe/ejRe/full.jpg',
        ]);

        DB::table('photos')->insert([
            'title' => 'Photo test',
            'author' => 'ejRe',
            'author_name' => 'Arthaud Proust',
            'event' => 'ejRe',
            'photo' => '/assets/photos/ejRe/bk5e/full.jpg',
        ]);

        DB::table('photos')->insert([
            'title' => 'Photo test',
            'author' => 'ejRe',
            'author_name' => 'Arthaud Proust',
            'event' => 'ejRe',
            'photo' => '/assets/photos/ejRe/el5a/full.jpg',
        ]);

        DB::table('photos')->insert([
            'title' => 'Photo test',
            'author' => 'ejRe',
            'author_name' => 'Arthaud Proust',
            'event' => 'ejRe',
            'photo' => '/assets/photos/ejRe/bmOe/full.jpg',
        ]);
    }
}
