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
                'product_id'  => '1002',
                'name'  => 'Evolution Gaming',
                'order' => '1'
            ],
            [
                'product_id'  => '1003',
                'name'  => 'All Bet',
                'order' => '2'
            ],
            [
                'product_id'  => '1004',
                'name'  => 'Big Gaming',
                'order' => '3'
            ],
            [
                'product_id'  => '1005',
                'name'  => 'SA Gaming',
                'order' => '4'
            ],
            [
                'product_id'  => '1005',
                'name'  => 'SA Gaming',
                'order' => '4'
            ],
            [
                'product_id'  => '1006',
                'name'  => 'Pragmatic Play',
                'order' => '5'
            ],
            [
                'product_id'  => '1009',
                'name'  => 'CQ9',
                'order' => '6'
            ],
            [
                'product_id'  => '1011',
                'name'  => 'Play Tech',
                'order' => '7'
            ],
            [
                'product_id'  => '1013',
                'name'  => 'Joker',
                'order' => '8'
            ],
            [
                'product_id'  => '1014',
                'name'  => 'Dragon Soft',
                'order' => '9'
            ],
            [
                'product_id'  => '1017',
                'name'  => 'TF Gaming',
                'order' => '10'
            ],
            [
                'product_id'  => '1020',
                'name'  => 'WM Casino',
                'order' => '11'
            ],
            [
                'product_id'  => '1022',
                'name'  => 'Sexy Gaming',
                'order' => '12'
            ],
            [
                'product_id'  => '1039',
                'name'  => 'AMAYA',
                'order' => '13'
            ],
            [
                'product_id'  => '1041',
                'name'  => 'Habanero',
                'order' => '14'
            ],
            [
                'product_id'  => '1046',
                'name'  => 'IBC',
                'order' => '15'
            ],
            [
                'product_id'  => '1048',
                'name'  => 'Reevo',
                'order' => '16'
            ],
            [
                'product_id'  => '1049',
                'name'  => 'EvoPlay',
                'order' => '17'
            ],
            [
                'product_id'  => '1050',
                'name'  => 'PlayStar',
                'order' => '18'
            ],
            [
                'product_id'  => '1052',
                'name'  => 'Dream Gaming',
                'order' => '19'
            ],
            [
                'product_id'  => '1053',
                'name'  => 'Nexus 4D',
                'order' => '20'
            ],
            [
                'product_id'  => '1074',
                'name'  => 'HKGP Lottery',
                'order' => '21'
            ],
            [
                'product_id'  => '1075',
                'name'  => 'SlotXo',
                'order' => '22'
            ],
            [
                'product_id'  => '1076',
                'name'  => 'AMB Poker',
                'order' => '23'
            ],
            [
                'product_id'  => '1077',
                'name'  => 'SkyWind',
                'order' => '24'
            ],
            [
                'product_id'  => '1081',
                'name'  => 'BTI',
                'order' => '25'
            ],
            [
                'product_id'  => '1084',
                'name'  => 'Advant Play',
                'order' => '26'
            ],
            [
                'product_id'  => '1085',
                'name'  => 'JDB',
                'order' => '27'
            ],
            [
                'product_id'  => '1091',
                'name'  => 'Jili',
                'order' => '28'
            ],
        ];

        Product::insert($data);
    }
}
