<?php

namespace App\Enums;

enum WagerStatus: string
{
    case Win = "win";
    case Lose = "lose";
    case Cancel = "cancel";
    case Refund = "refund";
}
