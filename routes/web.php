<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/affiliates', [AffiliateController::class, 'index'])->name('affiliates');
Route::get('/affiliates/too-far-away', [AffiliateController::class, 'tooFarAway'])->name('affiliates.too-far-away');
