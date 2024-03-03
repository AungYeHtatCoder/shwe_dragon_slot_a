<?php

namespace Database\Seeders;

use App\Enums\TransactionName;
use App\Enums\UserType;
use App\Models\User;
use App\Services\WalletService;
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
                'agent_id'      => 2,
                'status'         => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];

        $admin = $this->createUser(UserType::Admin, "Owner", "SDG898787", "09123456789");
        (new WalletService())->deposit($admin, 1000 * 100000, TransactionName::CapitalDeposit);

        $agent_1 = $this->createUser(UserType::Agent, "Agent 1", "SDG898737", "09112345678", $admin->id);
        (new WalletService())->transfer($admin, $agent_1, 100 * 100000, TransactionName::CreditTransfer);

        $player_1 = $this->createUser(UserType::Player, "Player 1", "SDG14893038", "09222345678", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_1, 40 * 100000, TransactionName::CreditTransfer);
        $player_2 = $this->createUser(UserType::Player, "Player 2", "tak", "091234567890", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_2, 50 * 100000, TransactionName::CreditTransfer);
    }

    private function createUser(UserType $type, $name, $user_name, $phone, $parent_id = null)
    {
        return User::create([
            'name'           => $name,
            'user_name'      => $user_name,
            'phone'          => $phone,
            'password'       => Hash::make('password'),
            'agent_id'      => $parent_id,
            'status'         => 1,
            'type' => $type->value
        ]);
    }
}
