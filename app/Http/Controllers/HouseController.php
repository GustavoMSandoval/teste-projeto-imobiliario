<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HouseAddress;
use App\Services\GeocodingService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HouseController extends Controller
{

    protected GeocodingService $geocoder;

    public function __construct(GeocodingService $geocoder) {
        $this->geocoder = $geocoder;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Save house
        $house = House::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        // Geocode address
        $coordinates = $this->geocoder->geocodeAddress([
            'rua' => $request->rua,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
        ]);

        // Save house address
        $houseAddress = HouseAddress::create([
            'cep' => $request->cep, 
            'rua' => $request->rua, 
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'latitude' => $coordinates['latitude'] ?? null,
            'longitude' => $coordinates['longitude'] ?? null,
            'house_id' => $house->id
        ]);

        // Save images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('houses', 'public');
                $house->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->back()->with('success', 'House and images uploaded successfully.');
    }

    public function show($id)
    {
        $house = House::with('address')->findOrFail($id);

        if (!$house->address) {
            abort(404, 'Address not found for this house.');
        }
    
        $response = Http::get('https://geocode.maps.co/search', [
            'q' => "{$house->address->rua}, {$house->address->cidade}, {$house->address->estado}",
            'api_key' => env('GEOCODE_API_KEY')
        ]);
    
        $coordinatesData = $response->json();
    
        if (empty($coordinatesData)) {
            abort(500, 'Could not geocode address.');
        }
    
        $houseCoordinates = [
            'lat' => $coordinatesData[0]['lat'],
            'lng' => $coordinatesData[0]['lon']
        ];
    
        return view('house', [
            'house' => $house,
            'houseCoordinates' => $houseCoordinates
        ]);
        
    }

}
