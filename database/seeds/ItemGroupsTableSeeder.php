<?php

use Illuminate\Database\Seeder;

class ItemGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('item_groups')->truncate();

        $item_groups = [
            [
                'name' => 'Coats',
                'season_id' => 5,
            ],
            [
                'name' => 'Trousers',
                'season_id' => 5,
            ],
            [
                'name' => 'Shirts',
                'season_id' => 5,
            ],
            [
                'name' => 'Sweaters',
                'season_id' => 5,
            ],
            [
                'name' => 'Shorts',
                'season_id' => 2,
            ],
            [
                'name' => 'Scarves',
                'season_id' => 4,
            ],
            [
                'name' => 'Footwear',
                'season_id' => 5,
            ],
        ];

        foreach($item_groups as $item_group) {
            App\ItemGroup::create($item_group);
        }
        
    }
}
