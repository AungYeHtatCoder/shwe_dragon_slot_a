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
                'code'  => '1001',
                'name'  => 'Asia Gaming',
                'order' => 1,
            ],
            [
                'code'  => '1003',
                'name'  => 'All Bet',
                'order' => 2,
            ],
            [
                'code'  => '1004',
                'name'  => 'Big Gaming',
                'order' => 3,
            ],
            [
                'code'  => '1006',
                'name'  => 'Pragmatic Gaming',
                'order' => 4,
            ],
            [
                'code'  => '1007',
                'name'  => 'PG Soft',
                'order' => 5,
            ],
            [
                'code'  => '1009',
                'name'  => 'CQ9',
                'order' => 6,
            ],
            [
                'code'  => '1011',
                'name'  => 'Play Tech',
                'order' => 7,
            ],
            [
                'code'  => '1012',
                'name'  => 'SB0',
                'order' => 8,
            ],
            [
                'code'  => '1013',
                'name'  => 'Joker',
                'order' => 9,
            ],
            [
                'code'  => '1016',
                'name'  => 'YEE Bet',
                'order' => 10,
            ],
            [
                'code'  => '1020',
                'name'  => 'WM Casino',
                'order' => 11,
            ],
            [
                'code'  => '1022',
                'name'  => 'Sexy Gaming',
                'order' => 12,
            ],
            [
                'code'  => '1023',
                'name'  => 'Real Time Gaming',
                'order' => 13,
            ],
            [
                'code'  => '1027',
                'name'  => 'Yggdrasil',
                'order' => 14,
            ],
            [
                'code'  => '1035',
                'name'  => 'Vivo Gaming	',
                'order' => 15,
            ],
            [
                'code'  => '1036',
                'name'  => 'UG Sport',
                'order' => 16,
            ],
            [
                'code'  => '1038',
                'name'  => 'King 855',
                'order' => 17,
            ],
            [
                'code'  => '1041',
                'name'  => 'Habanero',
                'order' => 18,
            ],
            [
                'code'  => '1046',
                'name'  => 'IBC',
                'order' => 19,
            ],
            [
                'code'  => '1048',
                'name'  => 'Reevo',
                'order' => 20,
            ],
            [
                'code'  => '1052',
                'name'  => 'Dream Gaming',
                'order' => 21,
            ],
            [
                'code'  => '1077',
                'name'  => 'Skywind',
                'order' => 22,
            ],
            [
                'code'  => '1080',
                'name'  => 'Venus',
                'order' => 23,
            ],
             [
                'code'  => '1084',
                'name'  => 'Advant Play',
                'order' => 24,
            ],
            [
                'code'  => '1085',
                'name'  => 'JDB',
                'order' => 25,
            ],
            [
                'code'  => '1086',
                'name'  => 'GENESIS',
                'order' => 26,
            ],
            [
                'code'  => '1092',
                'name'  => 'EBet',
                'order' => 27,
            ],
            [
                'code'  => '1096',
                'name'  => 'N2Live',
                'order' => 28,
            ],
            [
                'code'  => '1104',
                'name'  => 'SSports',
                'order' => 29,
            ],
            [
                'code'  => '1105',
                'name'  => 'Royal Slot Gaming',
                'order' => 30,
            ],
            [
                'code'  => '1132',
                'name'  => 'YesGetRich',
                'order' => 31,
            ],
            [
                'code'  => '1049',
                'name'  => 'Evoplay',
                'order' => 32,
            ],
            [
                'code'  => '1089',
                'name'  => 'Simple Play	',
                'order' => 33,
            ],
            [
                'code'  => '1091',
                'name'  => 'Jili',
                'order' => 34,
            ],
        ];

        Product ::insert($data);
    }
}
