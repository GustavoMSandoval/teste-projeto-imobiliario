<?php

use App\Http\Controllers\HouseController;
use App\Models\House;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $houses = House::all();

    return view('welcome', ['houses' => $houses]);
});


Route::post('/house/store', [HouseController::class, 'store'])->name('house.store');