<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function home()
    {
        $cars = Car::all();
        return view('welcome', compact('cars'));
    }

    public function shop(Request $request)
    {
        $query = Car::query()->with('brand');
    
    // Поиск по названию
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }
        
        // Фильтрация по марке
        if ($request->has('brand') && $request->input('brand') != '') {
            $query->where('brand_id', $request->input('brand'));
        }
        
        // Сортировка по году выпуска
        if ($request->has('sort')) {
            if ($request->input('sort') == 'new') {
                $query->orderBy('year', 'desc');
            } elseif ($request->input('sort') == 'old') {
                $query->orderBy('year', 'asc');
            }
        } else {
            // Сортировка по умолчанию
            $query->orderBy('created_at', 'desc');
        }
        
        $cars = $query->paginate(12);
        $brands = Brand::all();
        
        return view('pages.shop', compact('cars', 'brands'));
    }
}
