<?php

namespace App\Libs;

use App\Interfaces\iTransaction;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class BankTransaction implements iTransaction
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
                'transfer-date' => 'required|date_format:d/m/Y|after_or_equal:' . date("d/m/Y"),
                'customer-name' => 'required|string',
                'account-number' => 'required|alpha_num|regex:/^[a-zA-Z0-9]{6}$/',
                'amount' => 'required|numeric',
            ],
            [
                'transfer-date.date_format' => 'The value must be a date in the following format: DD/MM/YYYY',
                'transfer-date.after_or_equal' => 'The transfer date cannot be in the past',
                'customer-name.required' => 'The customer name is required',
                'account-number.required' => 'The account number is required',
                'account-number.regex' => 'The account number must be alpha-numeric and contains 6 characters',
                'amount.numeric' => 'The amount must contain digits',
            ]
        );

        $validator->after(function ($validator) {
            if ((Transaction::total() + (int)$this->amount()) >= Transaction::TOTAL_LIMIT) {
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
        return $this->input;
    }
}
