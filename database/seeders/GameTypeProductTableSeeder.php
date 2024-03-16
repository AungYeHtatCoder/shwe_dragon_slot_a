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
                'image' => 'evolution_gaming.webp',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 2,
                'game_type_id'  => 2,
                'image' => 'all_bet.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id'  => 3,
                'game_type_id'  => 2,
                'image' => 'big_gaming.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id'  => 4,
                'game_type_id'  => 2,
                'image' => 'sa_gaming.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 5,
                'game_type_id'  => 1,
                'image' => 'cq9.jpeg',
                'rate' =>'1.0000'
            ],
            [
                'product_id'  => 5,
                'game_type_id'  => 8,
                'image' => 'cq9.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 6,
                'game_type_id'  => 1,
                'image' => 'play_tech.webp',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 6,
                'game_type_id'  => 2,
                'image' => 'play_tech.webp',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 7,
                'game_type_id'  => 1,
                'image' => 'joker.png',
                'rate' => '1000.0000'
            ],
            [
                'product_id'  => 8,
                'game_type_id'  => 1,
                'image' => 'dragon_soft.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 9,
                'game_type_id'  => 13,
                'image' => 'tf_gaming.jpeg',
                'rate' => '1.0000'

            ],
            [
                'product_id'  => 10,
                'game_type_id'  => 2,
                'image' => 'wm_casino.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 11,
                'game_type_id'  => 2,
                'image' => 'sexy_gaming.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 12,
                'game_type_id'  => 1,
                'image' => 'spade_gaming.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id'  => 12,
                'game_type_id'  => 8,
                'image' => 'spade_gaming.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id'  => 13,
                'game_type_id'  => 1,
                'image' => 'amaya.png',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 14,
                'game_type_id'  => 1,
                'image' => 'habanero.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 15,
                'game_type_id'  => 3,
                'image' => 'IBC.png',
                'rate' => '1000.0000'
            ],
            [
                'product_id'  => 16,
                'game_type_id'  => 1,
                'image' => 'reevo.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 17,
                'game_type_id'  => 1,
                'image' => 'evoplay.png',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 18,
                'game_type_id'  => 1,
                'image' => 'playstar.png',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 19,
                'game_type_id'  => 2,
                'image' => 'dream_gaming.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id'  => 20,
                'game_type_id'  => 5,
                'image' => 'nex4d.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 21,
                'game_type_id'  => 5,
                'image' => 'lottery.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 22,
                'game_type_id'  => 1,
                'image' => 'slotxo.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 23,
                'game_type_id'  => 7,
                'image' => 'amb_poker.webp',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 24,
                'game_type_id'  => 1,
                'image' => 'sky_wind.webp',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 24,
                'game_type_id'  => 2,
                'image' => 'sky_wind.webp',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 25,
                'game_type_id'  => 3,
                'image' => 'BTI.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 26,
                'game_type_id'  =>1,
                'image' => 'advant_play.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 27,
                'game_type_id'  => 1,
                'image' => 'jdb.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id'  => 28,
                'game_type_id'  => 1,
                'image' => 'jili.png',
                'rate' => '1.0000'
            ]
            ];

        GameTypeProduct::insert($data);
    }
}