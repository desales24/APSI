<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', function () {
    return view('welcome');
});

use App\Models\Payment;

Route::get('/admin/payment/{payment}/print', function (Payment $payment) {
    $payment->load('order.items.shoe'); // pastikan relasi dimuat
    return view('print.payment', compact('payment'));
})->name('print.payment');

