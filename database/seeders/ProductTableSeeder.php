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
                'order' => 28,
            ],
            [
                'code'  => '1003',
                'name'  => 'All Bet',
                'order' => 29,
            ],
            [
                'code'  => '1004',
                'name'  => 'Big Gaming',
                'order' => 3,
            ],
            [
                'code'  => '1005',
                'name'  => 'SA Gaming',
                'order' => 4,
            ],
            [
                'code'  => '1009',
                'name'  => 'CQ9',
                'order' => 5,
            ],
            [
                'code'  => '1011',
                'name'  => 'Play Tech',
                'order' => 6,
            ],
            [
                'code'  => '1013',
                'name'  => 'Joker',
                'order' => 7,
            ],
            [
                'code'  => '1014',
                'name'  => 'Dragon Soft',
                'order' => 8,
            ],
            [
                'code'  => '1017',
                'name'  => 'TF Gaming',
                'order' => 9,
            ],
            [
                'code'  => '1020',
                'name'  => 'WM Casino',
                'order' => 10,
            ],
            [
                'code'  => '1022',
                'name'  => 'Sexy Gaming',
                'order' => 11,
            ],
            [
                'code'  => '1034',
                'name'  => 'Spade Gaming',
                'order' => 12,
            ],
            [
                'code'  => '1039',
                'name'  => 'AMAYA',
                'order' => 13,
            ],
            [
                'code'  => '1041',
                'name'  => 'Habanero',
                'order' => 14,
            ],
            [
                'code'  => '1046',
                'name'  => 'IBC',
                'order' => 15,
            ],
            [
                'code'  => '1048',
                'name'  => 'Reevo',
                'order' => 16,
            ],
            [
                'code'  => '1049',
                'name'  => 'EvoPlay',
                'order' => 17,
            ],
            [
                'code'  => '1050',
                'name'  => 'PlayStar',
                'order' => 18,
            ],
            [
                'code'  => '1052',
                'name'  => 'Dream Gaming',
                'order' => 29,
            ],
            [
                'code'  => '1053',
                'name'  => 'Nexus 4D',
                'order' => 20,
            ],
            [
                'code'  => '1074',
                'name'  => 'HKGP Lottery',
                'order' => 21,
            ],
            [
                'code'  => '1075',
                'name'  => 'SlotXo',
                'order' => 22,
            ],
            [
                'code'  => '1076',
                'name'  => 'AMB Poker',
                'order' => 23,
            ],
            [
                'code'  => '1077',
                'name'  => 'SkyWind',
                'order' => 24,
            ],
            [
                'code'  => '1081',
                'name'  => 'BTI',
                'order' => 25,
            ],
            [
                'code'  => '1084',
                'name'  => 'Advant Play',
                'order' => 26,
            ],
            [
                'code'  => '1085',
                'name'  => 'JDB',
                'order' => 1,
            ],
            [
                'code'  => '1091',
                'name'  => 'Jili',
                'order' => 2,
            ],
        ];

        Product ::insert($data);
    }
}
