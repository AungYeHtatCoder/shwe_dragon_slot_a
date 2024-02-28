<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case Success = 'success';
    case Canceled = 'canceled';
}
