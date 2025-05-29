<?php

namespace App\Http\Controllers;

use App\Models\{ Brand, Car };
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $cars = Car::with('brand')->get();
        $orders = Order::with('user')->with('car')->get();
        // dd($orders);
        return view('pages.admin', compact('brands', 'cars', 'orders'));
    }
}
