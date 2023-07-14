<?php

namespace App\Interfaces;

interface iTransaction
{
    /**
     * Validate Inputs
     */
    public function validator();

    /**
     * Return total amount
     * */
    public function amount();

    /**
     * Return Inputs
     */
    public function inputs();
}
