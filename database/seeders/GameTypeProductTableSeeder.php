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
                'product_id' => 1,
                'game_type_id' => 1,
                'image' => 'asia_gaming.jpeg',
                'rate' => '100.0000',
            ],
            [
                'product_id' => 1,
                'game_type_id' => 2,
                'image' => 'asia_gaming_casino.jpeg',
                'rate' => '100.0000',
            ],
            [
                'product_id' => 2,
                'game_type_id' => 2,
                'image' => 'all_bet.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 3,
                'game_type_id' => 2,
                'image' => 'big_gaming_casino.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id' => 4,
                'game_type_id' => 1,
                'image' => 'pragmatic_play.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 4,
                'game_type_id' => 2,
                'image' => 'pragmatic_casino.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 5,
                'game_type_id' => 1,
                'image' => 'pg_soft.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 6,
                'game_type_id' => 1,
                'image' => 'cq_9.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 6,
                'game_type_id' => 4,
                'image' => 'cq_9_fishing.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 7,
                'game_type_id' => 1,
                'image' => 'play_tech.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 7,
                'game_type_id' => 2,
                'image' => 'play_tech_casino.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 8,
                'game_type_id' => 3,
                'image' => 'sbo_sport.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 9,
                'game_type_id' => 1,
                'image' => 'joker.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 9,
                'game_type_id' => 4,
                'image' => 'joker_fishing.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 10,
                'game_type_id' => 2,
                'image' => 'yeebet.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 11,
                'game_type_id' => 2,
                'image' => 'wm_casino.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 12,
                'game_type_id' => 2,
                'image' => 'sexy_gaming.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 13,
                'game_type_id' => 1,
                'image' => 'real_time_gaming.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id' => 14,
                'game_type_id' => 1,
                'image' => 'yggdrasil.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 14,
                'game_type_id' => 2,
                'image' => 'yggdrasil.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 15,
                'game_type_id' => 1,
                'image' => 'vivo_gaming.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 15,
                'game_type_id' => 2,
                'image' => 'vivo_gaming.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 16,
                'game_type_id' => 3,
                'image' => 'ug_sport.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 17,
                'game_type_id' => 2,
                'image' => 'king_855.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 18,
                'game_type_id' => 1,
                'image' => 'habanero.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 19,
                'game_type_id' => 3,
                'image' => 'ibc.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id' => 20,
                'game_type_id' => 1,
                'image' => 'reevo.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 21,
                'game_type_id' => 2,
                'image' => 'dream_gaming.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 22,
                'game_type_id' => 1,
                'image' => 'skywind_group.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 22,
                'game_type_id' => 2,
                'image' => 'skywind_group.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 23,
                'game_type_id' => 1,
                'image' => 'venus.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 24,
                'game_type_id' => 1,
                'image' => 'advant_play.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 25,
                'game_type_id' => 1,
                'image' => 'j_d_b.png',
                'rate' => '100.0000'
            ],
            [
                'product_id' => 26,
                'game_type_id' => 1,
                'image' => 'genesis.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 27,
                'game_type_id' => 1,
                'image' => 'e_bet.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 27,
                'game_type_id' => 2,
                'image' => 'e_bet_casino.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 28,
                'game_type_id' => 2,
                'image' => 'n2_live.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 29,
                'game_type_id' => 3,
                'image' => 'ssport.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 30,
                'game_type_id' => 1,
                'image' => 'royal_slot_gaming.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 31,
                'game_type_id' => 1,
                'image' => 'yes_get_rich.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 32,
                'game_type_id' => 1,
                'image' => 'evoplay.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 33,
                'game_type_id' => 1,
                'image' => 'simple_play.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id' => 33,
                'game_type_id' => 4,
                'image' => 'simple_play_fishing.jpeg',
                'rate' => '1000.0000'
            ],
            [
                'product_id' => 34,
                'game_type_id' => 1,
                'image' => 'jili.png',
                'rate' => '1.0000'
            ]
            ];

        GameTypeProduct::insert($data);
    }
}