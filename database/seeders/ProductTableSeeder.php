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
                'code'  => '1002',
                'name'  => 'Evolution Gaming',
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
                'code'  => '1012',
                'name'  => 'SB0',
                'order' => 6,
            ],
            [
                'code'  => '1013',
                'name'  => 'Joker',
                'order' => 7,
            ],
            [
                'code'  => '1016',
                'name'  => 'YEE Bet',
                'order' => 8,
            ],
            [
                'code'  => '1020',
                'name'  => 'WM Casino',
                'order' => 9,
            ],
            [
                'code'  => '1022',
                'name'  => 'Sexy Gaming',
                'order' => 10,
            ],
            [
                'code'  => '1023',
                'name'  => 'Real Time Gaming',
                'order' => 11,
            ],
            [
                'code'  => '1027',
                'name'  => 'Yggdrasil',
                'order' => 12,
            ],

            [
                'code'  => '1034',
                'name'  => 'Spade Gaming',
                'order' => 13,
            ],
            [
                'code'  => '1035',
                'name'  => 'Vivo Gaming	',
                'order' => 14,
            ],

            [
                'code'  => '1038',
                'name'  => 'King 855',
                'order' => 15,
            ],

            [
                'code'  => '1048',
                'name'  => 'Reevo',
                'order' => 16,
            ],
            [
                'code'  => '1050',
                'name'  => 'PlayStar',
                'order' => 17,
            ],

            [
                'code'  => '1052',
                'name'  => 'Dream Gaming',
                'order' => 18,
            ],
            [
                'code'  => '1056',
                'name'  => 'TrueLab',
                'order' => 19,
            ],
            [
                'code'  => '1058',
                'name'  => 'BGaming',
                'order' => 20,
            ],
            [
                'code'  => '1060',
                'name'  => 'Wazdan',
                'order' => 21,
            ],
            [
                'code'  => '1062',
                'name'  => 'Fazi',
                'order' => 22,
            ],
            [
                'code'  => '1063',
                'name'  => 'Play Pearls',
                'order' => 23,
            ],
            [
                'code'  => '1064',
                'name'  => 'Net Game',
                'order' => 24,
            ],
            [
                'code'  => '1065',
                'name'  => 'Kiron',
                'order' => 25,
            ],
            [
                'code'  => '1067',
                'name'  => 'Red Rake',
                'order' => 26,
            ],
            [
                'code'  => '1070',
                'name'  => 'Boongo',
                'order' => 27,
            ],

            [
                'code'  => '1077',
                'name'  => 'Skywind',
                'order' => 28,
            ],
            [
                'code'  => '1084',
                'name'  => 'Advant Play',
                'order' => 29,
            ],
            [
                'code'  => '1085',
                'name'  => 'JDB',
                'order' => 30,
            ],
            [
                'code'  => '1086',
                'name'  => 'GENESIS',
                'order' => 31,
            ],
            [
                'code'  => '1091',
                'name'  => 'Jili',
                'order' => 32,
            ],


            [
                'code'  => '1097',
                'name'  => 'Funta Gaming',
                'order' => 33,
            ],
            [
                'code'  => '1098',
                'name'  => 'Felix Gaming',
                'order' => 34,
            ],
            [
                'code'  => '1101',
                'name'  => 'ZeusPlay',
                'order' => 35,
            ],
            [
                'code'  => '1102',
                'name'  => 'KA Gaming',
                'order' => 36,
            ],
            [
                'code'  => '1104',
                'name'  => 'SSports',
                'order' => 37,
            ],

            [
                'code'  => '1109',
                'name'  => 'Netent',
                'order' => 38,
            ],
            [
                'code'  => '1110',
                'name'  => 'Red Tiger',
                'order' => 39,
            ],
            [
                'code'  => '1111',
                'name'  => 'Gaming World',
                'order' => 40,
            ],
            [
                'code'  => '1150',
                'name'  => 'Live22SM',
                'order' => 41,
            ],

        ];
        Product::insert($data);
    }
}
