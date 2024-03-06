<?php

namespace App\Enums;
enum LogTypeEnum:int {
    case Wallet=0;
    case Category=1;
    case Budget=2;
    case CategoryBudgetLimit=3;
    case Transaction=4;
    case AssociatedTitle=5;
    case ScannerTemplate=6;
    case Objective=7;
    case DeleteLog=8;

    public static function values():array {
        return collect(LogTypeEnum::cases())->pluck("value")->toArray();
    }
}
