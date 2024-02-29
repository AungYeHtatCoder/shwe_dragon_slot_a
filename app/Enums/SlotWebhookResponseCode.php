<?php

namespace App\Enums;

enum SlotWebhookResponseCode: int
{
    case Success = 0;
    case Failed = 16;
    case Error = 19;
    case TooManyRequests = 20;
    case InternalServerError = 999;
    case MemberNotExists = 1000;
    case MemberInsufficientBalance = 1001;
    case IncorrectAgentKey = 1002;
    case DuplicateTransaction = 1003;
    case InvalidSign = 1004;
    case NoGetGameList = 1005;
    case BetNotExist = 1006;
    case ProductUnderMaintenance = 2000;
}
