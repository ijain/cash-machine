<?php

namespace App\Libs;

use App\Http\Controllers\Controller;
use App\Interfaces\iTransaction;
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
     */
    public function validate()
    {
        $validator = Validator::make($this->input, [
            'bills.1' => 'required',
            'bills.2' => 'required',
            'bills.3' => 'required',
            'bills.4' => 'required',
            'bills.5' => 'required',
        ],[
            'bills.1.required' => 'required',
            'bills.2.required' => 'required',
            'bills.3.required' => 'required',
            'bills.4.required' => 'required',
            'bills.5.required' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->action('App\Http\Controllers\TransactionController@create', ['cash']);
        }
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
