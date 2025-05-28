<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function shop()
    {
        $brands = Brand::all();
        $cars = Car::where('status', 'available')->get();
        return view('welcome', compact('cars', 'brands'));
    }
}
