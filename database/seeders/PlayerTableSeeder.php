<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PlayerTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create a user
        $user = User::create(
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
            'user_name'  => 'SDG14893038',
            'phone'      => '09122345678',
            'password'   => Hash::make('password'),
            'balance'    => 100000, // Ensure your User model has a 'balance' attribute if you're using it directly
            'agent_id'   => 2,
            'status'     => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );

        // Create a related user wallet entry
        $user->userWallet()->create([
            'wallet'           => 100000.00,
            'MemberID'         => 0,
            'OperatorID'       => 0,
            'ProductID'        => 0,
            'ProviderID'       => 0,
            'ProviderLineID'   => 0,
            'WagerID'          => 0,
            'CurrencyID'       => 22,
            'GameType'         => 0, // Make sure to add this if it's missing and relevant
            'GameID'           => 0,
            'GameRoundID'      => 0,
            'ValidBetAmount'   => 0.00,
            'BetAmount'        => 0.00,
            'TransactionAmount'=> 0.00,
            'TransactionID'    => '0', // This should probably be a string based on your schema
            'PayoutAmount'     => 0.00,
            'PayoutDetail'     => 'N/A',
            'BetDetail'        => 'N/A',
            'CommisionAmount'  => 0.00,
            'JackpotAmount'    => 0.00,
            // Assuming 'SettlementDate', 'CreatedOn', and 'ModifiedOn' are dates, they should be instances of Carbon or similar
            'SettlementDate'   => now(),
            'JPBet'            => 0.00,
            'Status'           => 0,
            'CreatedOn'        => now(),
            'ModifiedOn'       => now(),
        ]);
    }
}