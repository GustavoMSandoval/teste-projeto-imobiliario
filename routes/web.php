<?php

use App\Http\Controllers\HouseController;
use App\Models\House;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {


    $houses = House::all();
    //House::with('images')->get();

    return view('welcome', ['houses' => $houses]);

});

Route::post('/house/store', [HouseController::class, 'store'])->name('house.store');

Route::get('/house/{id}/show', [HouseController::class, 'show'])->name('house.show');

