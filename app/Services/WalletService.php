<?php

namespace App\Services;

use App\Enums\TransactionName;
use App\Models\User;
use Bavix\Wallet\External\Dto\Extra;
use Bavix\Wallet\External\Dto\Option;

class WalletService
{
    public function forceTransfer(User $from, User $to, float $amount, TransactionName $transaction_name, array $meta = [])
    {
        return $from->forceTransferFloat($to, $amount, new Extra(
            deposit: new Option(self::buildTransferMeta($to, $from, $transaction_name, $meta)),
            withdraw: new Option(self::buildTransferMeta($from, $to, $transaction_name, $meta))
        ));
    }

    public function transfer(User $from, User $to, float $amount, TransactionName $transaction_name, array $meta = [])
    {
        return $from->forceTransferFloat($to, $amount, new Extra(
            deposit: new Option(self::buildTransferMeta($to, $from, $transaction_name, $meta)),
            withdraw: new Option(self::buildTransferMeta($from, $to, $transaction_name, $meta))
        ));
    }

    public function deposit(User $user, float $amount, TransactionName $transaction_name, array $meta = [])
    {
        $user->depositFloat($amount, self::buildDepositMeta($user, $user, $transaction_name, $meta));
    }

    public static function buildTransferMeta(User $user, User $target_user, TransactionName $transaction_name, array $meta = [])
    {
        return array_merge([
            "name" => $transaction_name,
            "opening_balance" => $user->balanceFloat,
            "target_user_id" => $target_user->id
        ], $meta);
    }

    public static function buildDepositMeta(User $user, User $target_user, TransactionName $transaction_name, array $meta = [])
    {
        return array_merge([
            "name" => $transaction_name->value,
            "opening_balance" => $user->balanceFloat,
            "target_user_id" => $target_user->id
        ], $meta);
    }
}
