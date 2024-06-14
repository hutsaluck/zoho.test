<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZohoController;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/create', [ZohoController::class, 'createDealAndAccount']);
