<?php

namespace App\Enums;

enum TransactionName: string
{
    use HasLabelTrait;

    case CapitalDeposit = "capital_deposit";

    case Stake = 'stake';
    case Payout = 'payout';
    case Commission = 'commission';
    case Refund = "refund";

    case CreditTransfer = 'credit_transfer';
    case DebitTransfer = 'debit_transfer';

    case CreditAdjustment = 'credit_adjustment';
    case DebitAdjustment = 'debit_adjustment';
}
