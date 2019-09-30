<?php

use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->truncate();

        $genders = [
            [
                'title' => 'Female',
            ],
            [
                'title' => 'Male',
            ],
            [
                'title' => 'Non-Binary',
            ],
        ];

        foreach($genders as $gender) {
            App\Gender::create($gender);
        }
    }
}
