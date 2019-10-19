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
                'nickname' => 'Alfie',
                'email' => 'alf@email.com',
                'password' => Hash::make('alf_pass'),
                'gender_id' => 2,
            ],
            [
                'name' => 'Alice Wonderland',
                'nickname' => 'Alice',
                'email' => 'alice@email.com',
                'password' => Hash::make('alice_pass'),
                'gender_id' => 1,
            ],
            [
                'name' => 'Bob Down',
                'nickname' => 'Bobby',
                'email' => 'bob@email.com',
                'password' => Hash::make('bob_pass'),
                'gender_id' => 3
            ],
            [
                'name' => 'Kate Nash',
                'nickname' => 'Katie',
                'email' => 'kate@email.com',
                'password' => Hash::make('kate_pass'),
                'gender_id' => 1,
            ],
            [
                'name' => 'Luke Skywalker',
                'nickname' => 'Jedi',
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
