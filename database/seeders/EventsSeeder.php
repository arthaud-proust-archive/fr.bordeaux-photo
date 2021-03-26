<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'type' => 'rallye',
            'title' => 'Le temps presse',
            'description' => 'Lorem ipsum',
            'date_start' => Carbon::now()->addDays(30)->timestamp,
            'date_end' => Carbon::now()->addDays(31)->timestamp,
            'jury' => json_encode(User::where('role', 'jury')->get()->toArray())
        ]);

        DB::table('events')->insert([
            'type' => 'nocturne',
            'title' => 'De jour comme de nuit',
            'description' => 'Lorem ipsum',
            'date_start' => Carbon::now()->addDays(44)->timestamp,
            'date_end' => Carbon::now()->addDays(44)->timestamp,
            'jury' => json_encode(User::where('role', 'jury')->get()->toArray())
        ]);

        DB::table('events')->insert([
            'type' => 'rallye',
            'title' => 'Sans fin',
            'description' => 'Lorem ipsum',
            'date_start' => Carbon::now()->timestamp,
            'date_end' => Carbon::now()->addDays(100)->timestamp,
            'jury' => json_encode(User::where('role', 'jury')->get()->toArray())
        ]);
    }
}
