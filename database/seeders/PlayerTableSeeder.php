<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PlayerTableSeeder extends Seeder
{
    public function run(): void
    {

        $user = [
            [
                'name'       => 'mawi',
                'user_name'  => 'mawi',
                'phone'      => '09222222222',
                'password'   => Hash::make('password'),
                'balance'    => 100000, // Ensure your User model has a 'balance' attribute if you're using it directly
                'agent_id'   => 2,
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'name'       => 'AungMyoKhaing',
                'user_name'  => 'SDG14893036',
                'phone'      => '09122345678',
                'password'   => Hash::make('password'),
                'balance'    => 100000, // Ensure your User model has a 'balance' attribute if you're using it directly
                'agent_id'   => 2,
                'status'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        User::insert($user);

    }
}
