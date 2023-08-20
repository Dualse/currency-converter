<?php

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

Route::get('/', function (\App\Domain\CursExchange\Services\CurrencyInfo $currencyInfo) {
    dd($currencyInfo->getCurrency(new DateTime(), 'USD', 'EUR'));

});
