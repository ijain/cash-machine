<?php

namespace App\Libs;

use App\Interfaces\iTransaction;
use Illuminate\Http\Request;

class CardTransaction implements iTransaction
{
    private array $input;

    public function __construct(Request $request)
    {
        $this->input = $request->except(['_token']);
    }

    /**
     * Validate Inputs
     */
    public function validate() {

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
    public function inputs() {}
}
