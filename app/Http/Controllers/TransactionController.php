<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Transaction;
use App\Services\CashingMachine;
use Illuminate\Http\Request;
use App\Services\TransactionsFactory;

class TransactionController extends Controller
{
    public function home()
    {
        $total = Transaction::whereDate('created_at', date('Y-m-d'))->sum('amount');

        if ($total >= 20000) {
            return view('welcome-limit');
        }

        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($source)
    {
        return view($source . '-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $source)
    {
        $input = $request->except(['_token']);

        $factory = TransactionsFactory::make($source, $input);
        $validator = $factory->validator();

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($factory->inputs());
        }

        $cashMachine = new CashingMachine();
        $transaction = $cashMachine->store($factory);

        $sourceData = Source::whereName($source)->first();
        $sourceData->transactions()->sync($transaction);

        return redirect('/' . $source . '/confirm')->with(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction, string $source)
    {
        return view($source . '-confirm');
    }
}
