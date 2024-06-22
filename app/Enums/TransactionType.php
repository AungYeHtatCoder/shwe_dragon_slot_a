<?php
namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionType extends Enum
{
    const DEPOSIT = 'deposit';
    const WITHDRAW = 'withdraw';
}

