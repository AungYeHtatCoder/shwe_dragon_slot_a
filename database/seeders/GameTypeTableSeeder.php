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
                'status' => 1,
                'img' => 'slots.png'
            ],
            [
                'name'  => 'Live Casino',
                'code'  => '2',
                'order' => '2',
                'status' => 1,
                'img'   => 'live_casino.png'
            ],
            [
                'name'  => 'Sport Book',
                'code'  => '3',
                'order' => '3',
                'status' => 1,
                'img'   => 'sportbook.png'
            ],
            [
                'name' => 'Fishing',
                'code' => '8',
                'order' => '4',
                'status' => 1,
                'img'  => 'fishing.png'
            ],
            [
                'name' => 'Other',
                'code' => '9',
                'order' => '5',
                'status' => 0,
                'img'  => 'other.png'
            ],
        ];

        GameType::insert($data);
    }
}
