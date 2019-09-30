<?php

use Illuminate\Database\Seeder;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seasons')->truncate();

        $seasons = [
            [
                'name' => 'Spring',
            ],
            [
                'name' => 'Summer',
            ],
            [
                'name' => 'Autumn',
            ],
            [
                'name' => 'Winter',
            ],
            [
                'name' => 'All',
            ],
        ];

        foreach($seasons as $season) {
            App\Season::create($season);
        }
    }
}