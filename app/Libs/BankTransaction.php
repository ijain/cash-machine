<?php

namespace App\Libs;

use App\Interfaces\iTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankTransaction implements iTransaction
{
    private array $input;

    public function __construct(Request $request)
    {
        $this->input = $request->except(['_token']);
    }

    /**
     * Validate Inputs
     */
    public function validate()
    {
        $validator = Validator::make($this->input, [
            'citizenship' => 'required',
            'name' => 'required',
            'first_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
        ],[
            'citizenship.required' => 'Укажите гражданство.',
            'name.required' => 'Укажите Фамилию.',
            'first_name.required' => 'Укажите Имя.',
            'gender.required' => 'Укажите свой пол.',
            'date_of_birth.required' => 'Укажите дату рождения.',
        ]);

        if($validator->fails()){
            return back()->with('error', $validator)->withInput($this->input);
        }
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
