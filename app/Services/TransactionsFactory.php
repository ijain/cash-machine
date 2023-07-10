<?php

namespace App\Services;

use App\Libs\BankTransaction;
use App\Libs\CardTransaction;
use App\Libs\CashTransaction;

class TransactionsFactory
{
    public static function make(string $source, array $input)
    {
        return match ($source) {
            'card' => new CardTransaction($input),
            'bank' => new BankTransaction($input),
            default => new CashTransaction($input),
        };
    }
}
