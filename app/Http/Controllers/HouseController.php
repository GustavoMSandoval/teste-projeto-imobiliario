<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HouseAddress;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        // Save house
        $house = House::create(['name' => $request->name, 'description' => $request->description]);

        $houseAdress = HouseAddress::create([
            'cep' => $request->cep, 
            'rua' => $request->rua, 
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
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

}
