<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $users = [
            [
                'name' => 'Alf',
                'email' => 'alf@email.com',
                'password' => Hash::make('alf_pass'),
                'gender_id' => 2,
            ],
            [
                'name' => 'Alice',
                'email' => 'alice@email.com',
                'password' => Hash::make('alice_pass'),
                'gender_id' => 1,
            ],
            [
                'name' => 'Bob',
                'email' => 'bob@email.com',
                'password' => Hash::make('bob_pass'),
                'gender_id' => 3
            ],
            [
                'name' => 'Kate',
                'email' => 'kate@email.com',
                'password' => Hash::make('kate_pass'),
                'gender_id' => 1,
            ],
            [
                'name' => 'Luke',
                'email' => 'luke@email.com',
                'password' => Hash::make('luke_pass'),
                'gender_id' => 2,
            ],
        ];

        foreach($users as $user) {
            App\User::create($user);
        }

    }
}
