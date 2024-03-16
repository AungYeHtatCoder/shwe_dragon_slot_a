<?php

namespace App\Enums;

enum TransactionName: string
{
    use HasLabelTrait;

    case CapitalDeposit = "capital_deposit";

    case Stake = 'stake';
    case Payout = 'payout';
    case Bonus = 'bonus';
    case JackPot = 'jack_pot';
    case Cancel = 'cancel';
    case Rollback = 'rollback';
    case BuyIn = "buy_in";
    case BuyOut = "buy_out";

    case Commission = 'commission';
    case Refund = "refund";

    case CreditTransfer = 'credit_transfer'; 
    case DebitTransfer = 'debit_transfer';

    case CreditAdjustment = 'credit_adjustment';
    case DebitAdjustment = 'debit_adjustment';
}
