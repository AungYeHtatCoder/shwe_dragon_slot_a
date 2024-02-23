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
                'order' => '1'
            ],
            [
                'name'  => 'Live Casino',
                'code'  => '2',
                'order' => '2'
            ],
            [
                'name'  => 'Sport Book',
                'code'  => '3',
                'order' => '3'
            ],
            [
                'name'  => 'Virtual Sport',
                'code'  => '4',
                'order' => '4'
            ],
            [
                'name' => 'Lottery',
                'code' => '5',
                'order' => '5'
            ],
            [
                'name' => 'Qipai',
                'code' => '6',
                'order' => '6'
            ],
            [
                'name' => 'P2P',
                'code' => '7',
                'order' => '7'
            ],
            [
                'name' => 'Fishing',
                'code' => '8',
                'order' => '8'
            ],
            [
                'name' => 'Others',
                'code' => '9',
                'order' => ''
            ],
            [
                'name' => 'Cock Fighting',
                'code' => '10',
                'order' => '10'
            ],
            [
                'name' => 'Bonus',
                'code' => '11',
                'order' => '11'
            ],
            [
                'name' => 'Jackpot',
                'code' => '12',
                'order' => '12'
            ],
            [
                'name' => 'ESport',
                'code' => '13',
                'order' => '13'
            ]
            ];

        GameType::insert($data);
    }
}