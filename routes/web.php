<?php

use App\Http\Controllers\BankMachine;
use App\Http\Controllers\CardMachine;
use App\Http\Controllers\CashMachine1;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/{source}', [TransactionController::class, 'create']);
Route::post('/{source}', [TransactionController::class, 'store']);
Route::get('/{source}/confirm', [TransactionController::class, 'show']);
