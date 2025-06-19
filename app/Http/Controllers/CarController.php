<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        // $validated = $request->validated();

        $imagePath = $request->file('image')->store('cars', 'public');

        Car::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'mileage' => $request->mileage,
            'year' => $request->year,
            'vin_code' => $request->vin_code,
            'engine_type' => $request->engine_type,
            'engine_power' => $request->engine_power,
            'engine_volume' => $request->engine_volume,
            'transmission' => $request->transmission,
            'drive_type' => $request->drive_type,
            'color' => $request->color,
            'body_type' => $request->body_type,
            'brand_id' => $request->brand_id,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Автомобиль успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = Car::where('id', $id)->with('brand')->first();
        // dd($car);
        return view('pages.car', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePrice(UpdateCarRequest $request, Car $car)
    {
        // \Log::info('Updating price', ['car_id' => $car->id, 'new_price' => $request->price]);
        // dd($request);
        
        $car->update([
            'price' => $request->price
        ]);

        return redirect()->back()->with('status', 'Стоимость товара успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
