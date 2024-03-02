<?php

namespace App\Services;

use App\Enums\TransactionName;
use App\Models\Slip;
use App\Models\User;

class PayoutService
{
    protected User $admin_user;

    public function __construct(protected readonly WalletService $walletService)
    {
        $this->admin_user = User::adminUser();
    }

    public function transferStake(Slip $slip, float $amount)
    {
        return $this->walletService->transfer(
            $slip->user,
            $this->admin_user,
            $amount,
            TransactionName::Stake,
            $this->meta($slip)
        );
    }

    public function transferPayout(Slip $slip, float $amount)
    {
        return $this->walletService->transfer(
            $this->admin_user,
            $slip->user,
            $amount,
            TransactionName::Payout,
            $this->meta($slip)
        );
    }

    public function transferRefund(Slip $slip, float $amount)
    {
        return $this->walletService->transfer(
            $this->admin_user,
            $slip->user,
            $amount,
            TransactionName::Refund,
            $this->meta($slip)
        );
    }

    public function transferCommission(User $user, Slip $slip, float $amount)
    {
        return $this->walletService->transfer(
            $this->admin_user,
            $user,
            $amount,
            TransactionName::Commission,
            $this->meta($slip)
        );
    }

    private function meta(Slip $slip)
    {
        return [
            "slip_id" => $slip->id,
        ];
    }
}
