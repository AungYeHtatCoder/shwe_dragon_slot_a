<?php

namespace App\Enums;

enum TransactionStatus: int
{
    case Pending = 100;
    case Settle = 101;
    case Void = 102;
    case NotSet = 0;
}
