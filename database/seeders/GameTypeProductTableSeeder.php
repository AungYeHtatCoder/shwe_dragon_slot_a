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
                'image' => 'asia_gaming.png',
                'rate' => '100.0000',
            ],
            [
                'product_id' => 1,
                'game_type_id' => 2,
                'image' => 'asia_gaming.png',
                'rate' => '100.0000',
            ],
            [
                'product_id' => 2,
                'game_type_id' => 2,
                'image' => 'all_bet.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 3,
                'game_type_id' => 1,
                'image' => 'big_gaming.png',
                'rate' => '1000.0000'
            ],
            [
                'product_id' => 3,
                'game_type_id' => 2,
                'image' => 'big_gaming.png',
                'rate' => '1000.0000'
            ],
            [
                'product_id' => 4,
                'game_type_id' => 1,
                'image' => 'pragmatic_play.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 4,
                'game_type_id' => 2,
                'image' => 'pragmatic_play.png',
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
                'image' => 'cq_9.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 6,
                'game_type_id' => 4,
                'image' => 'cq_9.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 7,
                'game_type_id' => 1,
                'image' => 'play_tech.jpg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 7,
                'game_type_id' => 2,
                'image' => 'play_tech.jpg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 8,
                'game_type_id' => 3,
                'image' => 'sbo.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 9,
                'game_type_id' => 1,
                'image' => 'joker.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 9,
                'game_type_id' => 4,
                'image' => 'joker.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 10,
                'game_type_id' => 2,
                'image' => 'yee_bet.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 11,
                'game_type_id' => 2,
                'image' => 'wm_casino.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 12,
                'game_type_id' => 2,
                'image' => 'sexy_gaming.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 13,
                'game_type_id' => 1,
                'image' => 'real_time_gaming.png',
                'rate' => '1000.0000'
            ],
            [
                'product_id' => 14,
                'game_type_id' => 1,
                'image' => 'ygdrasil.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 14,
                'game_type_id' => 2,
                'image' => 'yggdrasil.svg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 15,
                'game_type_id' => 1,
                'image' => 'vivo_gaming.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 15,
                'game_type_id' => 2,
                'image' => 'vivo_gaming.png',
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
                'image' => 'habanero.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 19,
                'game_type_id' => 3,
                'image' => 'IBC.png',
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
                'image' => 'sky_wind.svg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 22,
                'game_type_id' => 2,
                'image' => 'sky_wind.svg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 23,
                'game_type_id' => 1,
                'image' => 'venus.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 24,
                'game_type_id' => 1,
                'image' => 'advant_play.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 25,
                'game_type_id' => 1,
                'image' => 'jdb.png',
                'rate' => '100.0000'
            ],
            [
                'product_id' => 26,
                'game_type_id' => 1,
                'image' => 'genius.jpeg',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 27,
                'game_type_id' => 1,
                'image' => 'ebet.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 27,
                'game_type_id' => 2,
                'image' => 'ebet.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 28,
                'game_type_id' => 2,
                'image' => 'n2_live.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 29,
                'game_type_id' => 3,
                'image' => 'ssport.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 30,
                'game_type_id' => 1,
                'image' => 'royal_slot.png',
                'rate' => '1.0000'
            ],
            [
                'product_id' => 31,
                'game_type_id' => 1,
                'image' => 'yet_get_rich.png',
                'rate' => '1.0000'
            ]
            ];

        GameTypeProduct::insert($data);
    }
}