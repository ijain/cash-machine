<?php

namespace App\Services;

use App\Interfaces\iTransaction;
use App\Models\Transaction;

class CashingMachine
{
    /**
     * Store transaction in Database
     */
    public function store(iTransaction $transaction)
    {
        $transaction->validate();

        $tx = new Transaction();
        $tx->total = $transaction->amount();
        $tx->inputs = $transaction->inputs();

        return $tx->save();
    }
}
