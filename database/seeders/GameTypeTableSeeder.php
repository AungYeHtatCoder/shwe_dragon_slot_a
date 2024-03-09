<?php

namespace Database\Seeders;

use App\Models\Admin\GameType;
use Illuminate\Database\Seeder;

class GameTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'  => 'Slot',
                'code'  => '1',
                'order' => '1',
                'img' => 'slots.png'
            ],
            [
                'name'  => 'Live Casino',
                'code'  => '2',
                'order' => '2',
                'img'   => 'live_casino.png'
            ],
            [
                'name'  => 'Sport Book',
                'code'  => '3',
                'order' => '3',
                'img'   => 'sportbook.png'
            ],
            [
                'name'  => 'Virtual Sport',
                'code'  => '4',
                'order' => '4',
                'img'   => 'virtual_sport.png'
            ],
            [
                'name' => 'Lottery',
                'code' => '5',
                'order'=> '5',
                'img'  => 'lottery.png'
            ],
            [
                'name' => 'Qipai',
                'code' => '6',
                'order' => '6',
                'img'   => 'qipai.png'
            ],
            [
                'name' => 'P2P',
                'code' => '7',
                'order' => '7',
                'img'  => 'p2p.png'
            ],
            [
                'name' => 'Fishing',
                'code' => '8',
                'order' => '8',
                'img'  => 'fishing.png'
            ],
            [
                'name' => 'Others',
                'code' => '9',
                'order' => '9',
                'img'  => 'others.png'
            ],
            [
                'name' => 'Cock Fighting',
                'code' => '10',
                'order' => '10',
                'img'  => 'cook_fighting.png'
            ],
            [
                'name' => 'Bonus',
                'code' => '11',
                'order' => '11',
                'img'   => 'bonus.png'
            ],
            [
                'name' => 'Jackpot',
                'code' => '12',
                'order' => '12',
                'img'  => 'jackpot.png'
            ],
            [
                'name' => 'ESport',
                'code' => '13',
                'order' => '13',
                'img' => 'esport.png'
            ]
        ];

        GameType::insert($data);
    }
}
