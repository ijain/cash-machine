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
                'card-number' => 'required|numeric|regex:/^4[0-9]{15}$/',
                'expiration-date' => 'required|date_format:mm/yyyy|before:today +2 month',
                'cardholder' => 'required|string',
                'cvv' => 'required|numeric|regex:/^[0-9]{3}$/',
                'amount' => 'required|numeric|between:1,20000|regex:/^\d+(\.\d{1,2})?$/',
            ],
            [
                'card-number.regex' => 'The card number must start with 4 and have 16 digits',
                'card-number.required' => 'The card number is required',
                'expiration-date.date_format' => 'The value must be a date in the following format: MM/YYYY',
                'expiration-date.before' => 'Expiration Date must be at least 2 months before the current month',
                'cardholder.required' => 'The cardholder name is required',
                'cvv.required' => 'CVV number is required and must contain 3 digits',
                'amount.regex' => 'The amount suppose to be with 2 decimal spaces, for example: 20.00',
                'amount.between' => 'The amount suppose to be between 1 and 20000',
            ]
        );

        $validator->after(function ($validator) {
            $total = Transaction::whereDate('created_at', date('Y-m-d'))->sum('amount');

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
