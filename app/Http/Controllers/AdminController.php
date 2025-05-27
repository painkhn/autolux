<?php

namespace App\Http\Controllers;

use App\Models\{ Brand, Car };
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $cars = Car::with('brand')->get();
        // dd($cars);
        return view('pages.admin', compact('brands', 'cars'));
    }
}
