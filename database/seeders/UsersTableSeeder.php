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
        $admin = $this->createUser(UserType::Admin, "Owner", "Owner898787", "09123456789");
        (new WalletService())->deposit($admin, 10 * 100_000, TransactionName::CapitalDeposit);

        // $master = $this->createUser(UserType::Master, "Master 1", "M898437", "09112345678", $admin->id);
        // (new WalletService())->transfer($admin, $master, 8 * 100_000, TransactionName::CreditTransfer);

        $agent_1 = $this->createUser(UserType::Agent, "Agent 1", "A898737", "09112345674", $admin->id);
        (new WalletService())->transfer($admin, $agent_1, 5 * 100_000, TransactionName::CreditTransfer);

        $player_1 = $this->createUser(UserType::Player, "Player 1", "MW111111", "09111111111", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_1, 30000, TransactionName::CreditTransfer);

        $player_2 = $this->createUser(UserType::Player, "Player 2", "MW222222", "09222222222", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_2, 30000, TransactionName::CreditTransfer);

        $player_3 = $this->createUser(UserType::Player, "Player 3", "MW333333", "09333333333", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_3, 30000, TransactionName::CreditTransfer);

        $player_4 = $this->createUser(UserType::Player, "Player 4", "MW444444", "09444444444", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_4, 30000, TransactionName::CreditTransfer);

        $player_5 = $this->createUser(UserType::Player, "Player 5", "W555555", "09555555555", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_5, 30000, TransactionName::CreditTransfer);

        $player_6 = $this->createUser(UserType::Player, "Player 6", "W666666", "09666666666", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_6, 30000, TransactionName::CreditTransfer);

        $player_7 = $this->createUser(UserType::Player, "Player 7", "MW7777777", "09777777777", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_7, 30000, TransactionName::CreditTransfer);

        $player_8 = $this->createUser(UserType::Player, "Player 8", "MW888888", "09888888888", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_8, 30000, TransactionName::CreditTransfer);

        $player_9 = $this->createUser(UserType::Player, "Player 9", "tak", "tak", $agent_1->id);
        (new WalletService())->transfer($agent_1, $player_9, 30000, TransactionName::CreditTransfer);
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
            'is_changed_password' => 1,
            'type' => $type->value
        ]);
    }
}
