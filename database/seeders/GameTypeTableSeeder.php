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
                'img' => 'slots.png',
                'order' => '1'
            ],
            [
                'name'  => 'Live Casino',
                'code'  => '2',
                'img' => 'live_casino.png',
                'order' => '2'
            ],
            [
                'name'  => 'Sport Book',
                'code'  => '3',
                'img' => 'sportbook.png',
                'order' => '3'
            ],
            [
                'name'  => 'Virtual Sport',
                'code'  => '4',
                'img' => 'virtual_sport.png',
                'order' => '4'
            ],
            [
                'name' => 'Lottery',
                'code' => '5',
                'img' => 'lottery.png',
                'order' => '5'
            ],
            [
                'name' => 'Qipai',
                'code' => '6',
                'img' => 'qipai.png',
                'order' => '6'
            ],
            [
                'name' => 'P2P',
                'code' => '7',
                'img' => 'p2p.png',
                'order' => '7'
            ],
            [
                'name' => 'Fishing',
                'code' => '8',
                'img' => 'fishing.png',
                'order' => '8'
            ],
            [
                'name' => 'Others',
                'code' => '9',
                'img' => 'others.png',
                'order' => ''
            ],
            [
                'name' => 'Cock Fighting',
                'code' => '10',
                'img' => 'cock_fighting.png',
                'order' => '10'
            ],
            [
                'name' => 'Bonus',
                'code' => '11',
                'img' => 'bonus.png',
                'order' => '11'
            ],
            [
                'name' => 'Jackpot',
                'code' => '12',
                'img' => 'jackpot.png',
                'order' => '12'
            ],
            [
                'name' => 'ESport',
                'code' => '13',
                'img' => 'esport.png',
                'order' => '13'
            ]
            ];

        GameType::insert($data);
    }
}