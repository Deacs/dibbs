<?php

use Illuminate\Database\Seeder;

class AvatarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('avatars')->truncate();

        $avatars = [
            [
                'user_id' => 1,
            ],
            [
                'user_id' => 2,
            ],
            [
                'user_id' => 3,
            ],
            [
                'user_id' => 4,
            ],
            [
                'user_id' => 5,
            ],
        ];

        foreach($avatars as $avatar) {
            App\Avatar::create($avatar);
        }
    }
}
