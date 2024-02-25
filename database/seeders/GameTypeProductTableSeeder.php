<?php

namespace Database\Seeders;

use App\Models\Admin\GameType;
use App\Models\Admin\GameTypeProduct;
use Illuminate\Database\Seeder;

class GameTypeProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'product_id'  => 1,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 2,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 3,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 4,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 5,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 5,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 6,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 6,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 7,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 8,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 9,
                'game_type_id'  => 13,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 10,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 11,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 12,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 13,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 14,
                'game_type_id'  => 3,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 15,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 16,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 17,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 18,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 19,
                'game_type_id'  => 5,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 20,
                'game_type_id'  => 5,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 21,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 22,
                'game_type_id'  => 7,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 23,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 23,
                'game_type_id'  => 2,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 24,
                'game_type_id'  => 3,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 25,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 26,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 27,
                'game_type_id'  => 1,
                'image' => 'test.png'
            ],
            [
                'product_id'  => 27,
                'game_type_id'  => 8,
                'image' => 'test.png'
            ],
            ];

        GameTypeProduct::insert($data);
    }
}