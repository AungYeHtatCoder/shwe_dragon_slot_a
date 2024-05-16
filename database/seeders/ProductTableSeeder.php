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
                'code'  => '1006',
                'name'  => 'Pragmatic Play',
                'order' => 1,
            ],
            [
                'code'  => '1012',
                'name'  => 'SBO',
                'order' => 11,
            ],
            [
                'code'  => '1013',
                'name'  => 'Joker',
                'order' => 12,
            ],
            [
                'code'  => '1016',
                'name'  => 'YEE Bet',
                'order' => 13,
            ],
            [
                'code'  => '1020',
                'name'  => 'WM Casino',
                'order' => 14,
            ],
            [
                'code'  => '1027',
                'name'  => 'Yggdrasil',
                'order' => 15,
            ],
            [
                'code'  => '1034',
                'name'  => 'Spade Gaming',
                'order' => 16,
            ],
            [
                'code'  => '1035',
                'name'  => 'Vivo Gaming',
                'order' => 17,
            ],
            [
                'code'  => '1050',
                'name'  => 'PlayStar',
                'order' => 6,
            ],
            [
                'code'  => '1056',
                'name'  => 'TrueLab',
                'order' => 18,
            ],
            [
                'code'  => '1058',
                'name'  => 'BGaming',
                'order' => 19,
            ],
            [
                'code'  => '1060',
                'name'  => 'Wazdan',
                'order' => 20,
            ],
            [
                'code'  => '1062',
                'name'  => 'Fazi',
                'order' => 21,
            ],
            [
                'code'  => '1063',
                'name'  => 'Play Pearls',
                'order' => 22,
            ],
            [
                'code'  => '1064',
                'name'  => 'Net Game',
                'order' => 23,
            ],
            [
                'code'  => '1065',
                'name'  => 'Kiron',
                'order' => 24,
            ],
            [
                'code'  => '1067',
                'name'  => 'Red Rake',
                'order' => 25,
            ],
            [
                'code'  => '1070',
                'name'  => 'Boongo',
                'order' => 26,
            ],
            [
                'code'  => '1077',
                'name'  => 'Skywind',
                'order' => 29,
            ],
            [
                'code'  => '1085',
                'name'  => 'JDB',
                'order' => 4,
            ],
            [
                'code'  => '1086',
                'name'  => 'GENESIS',
                'order' => 30,
            ],
            [
                'code'  => '1097',
                'name'  => 'Funta Gaming',
                'order' => 31,
            ],
            [
                'code'  => '1098',
                'name'  => 'Felix Gaming',
                'order' => 32,
            ],
            [
                'code'  => '1101',
                'name'  => 'ZeusPlay',
                'order' => 33,
            ],
            [
                'code'  => '1102',
                'name'  => 'KA Gaming',
                'order' => 7,
            ],
            [
                'code'  => '1109',
                'name'  => 'Netent',
                'order' => 34,
            ],
            [
                'code'  => '1110',
                'name'  => 'Red Tiger',
                'order' => 5,
            ],
            [
                'code'  => '1111',
                'name'  => 'Gaming World',
                'order' => 35,
            ],
            [
                'code'  => '1001',
                'name'  => 'Asia Gaming',
                'order' => 36,
            ],
            [
                'code'  => '1002',
                'name'  => 'Evolution Gaming',
                'order' => 37,
            ],
            [
                'code'  => '1004',
                'name'  => 'Big Gaming',
                'order' => 10,
            ],
            [
                'code'  => '1007',
                'name'  => 'PG Soft',
                'order' => 2,
            ],
            [
                'code'  => '1009',
                'name'  => 'CQ9',
                'order' => 8,
            ],
            [
                'code'  => '1022',
                'name'  => 'Sexy Gaming',
                'order' => 38,
            ],
            [
                'code'  => '1023',
                'name'  => 'Real Time Gaming',
                'order' => 39,
            ],
            [
                'code'  => '1091',
                'name'  => 'Jili',
                'order' => 3,
            ],
            [
                'code'  => '1038',
                'name'  => 'King 855',
                'order' => 40,
            ],
            [
                'code'  => '1041',
                'name'  => 'Habanero',
                'order' => 41,
            ],
            [
                'code'  => '1150',
                'name'  => 'Live22SM',
                'order' => 42,
            ],
            [
                'code'  => '1132',
                'name'  => 'YesGetRich',
                'order' => 43,
            ],
            [
                'code'  => '1089',
                'name'  => 'Simple Play	',
                'order' => 44,
            ],
            [
                'code'  => '1084',
                'name'  => 'Advant Play',
                'order' => 45,
            ],
            [
                'code'  => '1104',
                'name'  => 'SSports',
                'order' => 46,
            ],
            [
                'code'  => '1052',
                'name'  => 'Dream Gaming',
                'order' => 48,
            ],
            [
                'code'  => '1055',
                'name'  => 'Mr Slotty',
                'order' => 49,
            ],
            [
                'code'  => '1049',
                'name'  => 'Evoplay',
                'order' => 50,
            ],
            [
                'code'  => '1100',
                'name'  => 'SmartSoft',
                'order' => 9,
            ],
        ];

        Product::insert($data);
    }
}
