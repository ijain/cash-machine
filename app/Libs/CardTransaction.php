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
                'expiration-date' => 'required|date_format:m/Y|after_or_equal:' . date("m/Y", strtotime("+2 month")),
                'cardholder' => 'required|string',
                'cvv' => 'required|numeric|regex:/^[0-9]{3}$/',
                'amount' => 'required|numeric',
            ],
            [
                'card-number.regex' => 'The card number must start with 4 and have 16 digits',
                'card-number.required' => 'The card number is required',
                'expiration-date.date_format' => 'The value must be a date in the following format: MM/YYYY',
                'expiration-date.after_or_equal' => 'The expiration date must be at least 2 months greater than the current month',
                'cardholder.required' => 'The cardholder name is required',
                'cvv.required' => 'CVV number is required',
                'cvv.regex' => 'CVV number must contain 3 digits',
                'amount.numeric' => 'The amount must contain digits',
            ]
        );

        $validator->after(function ($validator) {
            if ((Transaction::total() + (int)$this->amount()) > Transaction::TOTAL_LIMIT) {
                $validator->errors()->add('total', 'The total amount of all transactions for the day must not exceed ' . Transaction::TOTAL_LIMIT . '. The current total is ' . Transaction::total() . '.');
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
