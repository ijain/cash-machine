<?php

namespace App\Services;

use App\Interfaces\iTransaction;
use App\Models\Transaction;

class CashingMachine
{
    /**
     * Store transaction in Database
     */
    public function store(iTransaction $sourceTransaction)
    {
        $transaction = new Transaction();
        $transaction->total = $sourceTransaction->amount();
        $transaction->inputs = $sourceTransaction->inputs();
        $transaction->save();

        return $transaction;
    }
}
