<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ItemGroupsTableSeeder::class);
        $this->call(ItemTypesTableSeeder::class);
        $this->call(SeasonsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(AvatarsTableSeeder::class);
    }
}
