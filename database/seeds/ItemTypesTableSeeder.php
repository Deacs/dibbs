<?php

use Illuminate\Database\Seeder;

class ItemTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        DB::table('item_types')->truncate();

        $item_types = [
            [
                'name' => 'Trainers',
                'item_group_id' => 7,
            ],
            [
                'name' => 'Walking Boots',
                'item_group_id' => 7,
            ],
            [
                'name' => 'Cargo Shorts',
                'item_group_id' => 5,
            ],
            [
                'name' => 'Button Down Oxford',
                'item_group_id' => 3,
            ],
            [
                'name' => 'Black Jeans',
                'item_group_id' => 2,
            ],
            [
                'name' => 'Burberry Check',
                'item_group_id' => 6,
            ],
        ];

        foreach($item_types as $item_type) {
            App\ItemType::create($item_type);
        }
        
    }
}
