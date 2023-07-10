<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Transaction;
use App\Services\CashingMachine;
use Illuminate\Http\Request;
use App\Services\TransactionsFactory;

class TransactionController extends Controller
{
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

        try {
            $factory = TransactionsFactory::make($source, $input);

            $cashMachine = new CashingMachine();
            $transaction = $cashMachine->store($factory);

            $sourceData = Source::whereName($source)->first();
            $sourceData->transactions()->sync($transaction);

            return redirect('/' . $source . '/confirm')->with(['status' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', "The Message")->withInput($input);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction, string $source)
    {
        return view($source . '-confirm');
    }
}
