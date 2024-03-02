<?php

namespace App\Services;

use App\Enums\TransactionName;
use App\Models\User;

class WalletService
{
    public function forceTransfer(User $from, User $to, float $amount, TransactionName $transaction_name, array $meta = [])
    {
        $from->forceTransferFloat($to, $amount, self::buildTransferMeta($from, $to, $transaction_name, $meta));
    }

    public function transfer(User $from, User $to, float $amount, TransactionName $transaction_name, array $meta = [])
    {
        $from->transferFloat($to, $amount, self::buildTransferMeta($from, $to, $transaction_name, $meta));
    }

    public function deposit(User $user, float $amount, TransactionName $transaction_name, array $meta = [])
    {
        $user->depositFloat($amount, self::buildDepositMeta($user, $transaction_name, $meta));
    }

    public static function buildTransferMeta(User $from, User $to, TransactionName $transaction_name, array $meta = [])
    {
        return array_merge([
            "name" => $transaction_name,
            "from_opening_balance" => $from->balanceFloat,
            "to_opening_balance" => $to->balanceFloat,
        ], $meta);
    }

    public static function buildDepositMeta(User $user, TransactionName $transaction_name, array $meta = [])
    {
        return array_merge([
            "name" => $transaction_name->value,
            "user_opening_balance" => $user->balanceFloat,
        ], $meta);
    }
}
