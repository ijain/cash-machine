<?php

namespace App\Libs;

use App\Http\Controllers\Controller;
use App\Interfaces\iTransaction;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Validator;

class CashTransaction extends Controller implements iTransaction
{
    private $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * Validate Inputs
     * @throws Exception
     */
    public function validator()
    {
        $validator =  Validator::make(
            $this->input,
            [
                'bills.*' => 'required|integer',
            ],
            [
                'bills.*.required' => 'The number of bills must be 0 or greater',
                'bills.*.integer' => 'The banknote value must be numeric',
            ]
        );

        $validator->after(function ($validator) {
            if ((int)$this->amount() > Transaction::CASH_LIMIT) {
                $validator->errors()->add('total', 'The total amount must not exceed ' . Transaction::OUTPUT_CASH_LIMIT);
            } elseif ((int)$this->amount() <= 0) {
                $validator->errors()->add('total', 'The total amount must be greater than 0.');
            } elseif ((Transaction::total() + (int)$this->amount()) >= Transaction::TOTAL_LIMIT) {
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
        $amount = 0;

        if (is_array($this->input['bills'])) {
            foreach ($this->input['bills'] as $bill => $quantity) {
                if (is_numeric($quantity)) {
                    $amount += $bill * $quantity;
                }
            }
        }

        return $amount ?? 0;
    }

    /**
     * Return Inputs
     */
    public function inputs()
    {
        return $this->input['bills'] ?? [];
    }
}
