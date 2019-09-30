<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->truncate();

        $items = [
            [
                'name' => 'Air Max',
                'user_id' => 1,
                'item_type_id' => 1, // Trainers
            ],
            [
                'name' => 'Internationalist (Green)',
                'user_id' => 1,
                'item_type_id' => 1, // Trainers
            ],
            [
                'name' => 'Nike ACG',
                'user_id' => 1,
                'item_type_id' => 2, // Walking boots
            ],
            [
                'name' => 'Nudie Skinny',
                'user_id' => 1,
                'item_type_id' => 5, // Black Jeans
            ],
        ];

        foreach($items as $item) {
            App\Item::create($item);
        }
    }
    
}
