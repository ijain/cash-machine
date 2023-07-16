<?php

namespace App\Libs;

use App\Interfaces\iTransaction;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class CardTransaction implements iTransaction
{
    private array $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * Validate Inputs
     */
    public function validator()
    {
        $validator =  Validator::make(
            $this->input,
            [
                'card-number' => 'required|numeric|regex:/^4[0-9]{16,16}/',
                'expiration-date' => 'required|date',
                'cardholder' => 'required|string',
                'cvv' => 'required|numeric',
                'amount' => 'required|numeric',
            ],
            [
                'card-number.regex' => 'The number of bills must be 0 or greater',
                'expiration-date.date' => 'The banknote value must be numeric',
                'cardholder.required' => 'The banknote value must be numeric',
                'cvv.required' => 'The banknote value must be numeric',
                'amount.numeric' => 'The banknote value must be numeric',
            ]
        );

        $total = Transaction::whereDate('created_at', date('Y-m-d'))->sum('amount');

        $validator->after(function ($validator) use ($total) {
            if (($total + $this->amount()) >= Transaction::TOTAL_LIMIT) {
                $validator->errors()->add('total', 'The total amount of all transactions for the day must not exceed ' . Transaction::OUTPUT_TOTAL_LIMIT);
            }
        });

        return $validator;
    }

    /**
     * Return total amount
     * */
    public function amount()
    {
        return $this->input['amount'];
    }

    /**
     * Return Inputs
     */
    public function inputs()
    {
        return $this->input ?? [];
    }
}
