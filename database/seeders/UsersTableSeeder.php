<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'           => 'Owner',
                'user_name'      => 'SDG898787',
                'phone'          => '09123456789',
                'password'       => Hash::make('password'),
                'balance'        => 1000000,
                'agent_id'      => null,
                'status'        => 1,
                'created_at'     => now(),
                'updated_at'     => now(),

            ],
            [
                'name'           => 'Agent',
                'user_name'      => 'SDG898737',
                'phone'          => '09112345678',
                'password'       => Hash::make('password'),
                'balance'        => 100000,
                'agent_id'      => 1,
                'status'         => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Player',
                'user_name'      => 'SDG14893038',
                'phone'          => '09222345678',
                'password'       => Hash::make('password'),
                'balance'        => 100000,
                'agent_id'      => 2,
                'status'         => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            ];

        User::insert($users);
    }
}