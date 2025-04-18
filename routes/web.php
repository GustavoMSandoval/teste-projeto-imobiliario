<?php

use App\Http\Controllers\HouseController;
use App\Models\House;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {


    $houses = House::all();
    //House::with('images')->get();

    return view('welcome', ['houses' => $houses]);

});

Route::post('/house/store', [HouseController::class, 'store'])->name('house.store');

Route::get('/house/{id}/show', function($id) {
    
    
    $house = House::find($id);
    
    $response = Http::get('https://geocode.maps.co/search', [
            'q' => $house->address->rua,
            'api_key' => env('GEOCODE_API_KEY')
        ]);

    $coordinatesData = $response->json();

    $houseCoordinates = [
        'lat' => $coordinatesData[0]['lat'],
        'lng' => $coordinatesData[0]['lon']
    ];

    return view('house',['house' => $house, 'houseCoordinates' => $houseCoordinates]);
    
})->name('house.show');

