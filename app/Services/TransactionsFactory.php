<?php

namespace App\Services;

use App\Libs\BankTransaction;
use App\Libs\CardTransaction;
use App\Libs\CashTransaction;

class TransactionsFactory
{
    public static function make(string $source, array $input)
    {
        switch ($source) {
            case 'card':
                $transaction = new CardTransaction($input);
                break;
            case 'bank':
                $transaction = new BankTransaction($input);
                break;
            default:
                $transaction = new CashTransaction($input);
                break;
        }

        return $transaction;
    }
}
