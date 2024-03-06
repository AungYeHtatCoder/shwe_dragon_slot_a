<?php

namespace Database\Seeders;

use App\Models\Admin\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code'  => '1002',
                'name'  => 'Evolution Gaming',
                'order' => '1',
                'image' => 'evolution_gaming.webp'
            ],
            [
                'code'  => '1003',
                'name'  => 'All Bet',
                'order' => '2',
                'image' => 'all_bet.jpeg'
            ],
            [
                'code'  => '1004',
                'name'  => 'Big Gaming',
                'order' => '3',
                'image' => 'big_gaming.jpeg'
            ],
            [
                'code'  => '1005',
                'name'  => 'SA Gaming',
                'order' => '4',
                'image' => 'sa_gaming.jpeg'
            ],
            [
                'code'  => '1009',
                'name'  => 'CQ9',
                'order' => '6',
                'image' => 'cq9.jpeg'
            ],
            [
                'code'  => '1011',
                'name'  => 'Play Tech',
                'order' => '7',
                'image' => 'play_tech.png'
            ],
            [
                'code'  => '1013',
                'name'  => 'Joker',
                'order' => '8',
                'image' => 'joker.png'
            ],
            [
                'code'  => '1014',
                'name'  => 'Dragon Soft',
                'order' => '9',
                'image' => 'dragon_soft.jpeg'
            ],
            [
                'code'  => '1017',
                'name'  => 'TF Gaming',
                'order' => '10'
            ],
            [
                'code'  => '1020',
                'name'  => 'WM Casino',
                'order' => '11',
                'image' => 'wm_casino.jpeg'
            ],
            [
                'code'  => '1022',
                'name'  => 'Sexy Gaming',
                'order' => '12',
                'image' => 'sexy_gaming.jpeg'
            ],
            [
                'code'  => '1039',
                'name'  => 'AMAYA',
                'order' => '13',
                'image' => 'amaya.png'
            ],
            [
                'code'  => '1041',
                'name'  => 'Habanero',
                'order' => '14',
                'image' => 'habanero.jpeg'
            ],
            [
                'code'  => '1046',
                'name'  => 'IBC',
                'order' => '15',
                'image' => 'IBC.png'
            ],
            [
                'code'  => '1048',
                'name'  => 'Reevo',
                'order' => '16',
                'image' => 'reevo.jpeg'
            ],
            [
                'code'  => '1049',
                'name'  => 'EvoPlay',
                'order' => '17',
                'image' => 'evoplay.png'
            ],
            [
                'code'  => '1050',
                'name'  => 'PlayStar',
                'order' => '18',
                'image' => 'playstar.png'
            ],
            [
                'code'  => '1052',
                'name'  => 'Dream Gaming',
                'order' => '19',
                'image' => 'dream_gaming.jpeg'
            ],
            [
                'code'  => '1053',
                'name'  => 'Nexus 4D',
                'order' => '20',
                'image' => 'nex4d.jpeg'
            ],
            [
                'code'  => '1074',
                'name'  => 'HKGP Lottery',
                'order' => '21',
                'image' => 'lottery.jpeg'
            ],
            [
                'code'  => '1075',
                'name'  => 'SlotXo',
                'order' => '22',
                'image' => 'slogxo.jpeg'
            ],
            [
                'code'  => '1076',
                'name'  => 'AMB Poker',
                'order' => '23',
                'image' => 'ambpoker.webp'
            ],
            [
                'code'  => '1077',
                'name'  => 'SkyWind',
                'order' => '24',
                'image' => 'sky_wind.webp'
            ],
            [
                'code'  => '1081',
                'name'  => 'BTI',
                'order' => '25',
                'image' => 'BTI.jpeg'
            ],
            [
                'code'  => '1084',
                'name'  => 'Advant Play',
                'order' => '26',
                'image' => 'advant_play.jpeg'
            ],
            [
                'code'  => '1085',
                'name'  => 'JDB',
                'order' => '27',
                'image' => 'jdb.jpeg'
            ],
            [
                'code'  => '1091',
                'name'  => 'Jili',
                'order' => '28',
                'image' => 'jili.png'
            ],
        ];

        Product ::insert($data);
    }
}
