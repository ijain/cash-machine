<?php

namespace App\Libs;

use App\Http\Controllers\Controller;
use App\Interfaces\iTransaction;
use App\Rules\CashTotal;
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
        return Validator::make(
            $this->input,
            [
                'bills.*' => 'required'
            ],
            [
                'bills.*.required' => 'The number of bills must be 0 or greater'
            ]
        );
    }

    /**
     * Return total amount
     * */
    public function amount()
    {
        $amount = 0;

        if (is_array($this->input['bills'])) {
            foreach ($this->input['bills'] as $bill => $quantity) {
                $amount += $bill * $quantity;
            }
        }

        return $amount;
    }

    /**
     * Return Inputs
     */
    public function inputs()
    {
        return $this->input;
    }
}
