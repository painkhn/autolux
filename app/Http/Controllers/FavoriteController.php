<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::with('car')->where('user_id', $user->id)->get();
        return view('pages.favorites', compact('favorites', 'user'));
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
    // public function store(StoreFavoriteRequest $request)
    // {
        
    // }

    public function store($id)
    {
        $user = Auth::user(); // Получаем пользователя
        $car = Car::where('id', $id)->first();
        // dd($car);

        // Получаем избранные
        $favorite = $user->favorites()->where('car_id', $car->id)->first();


        if ($favorite) { // Если уже в избранном, то удаляем
            // $car->update([
            //     'is_favorite' => false
            // ]);
            $favorite->delete();
            return redirect()->back()->with('success', 'Авто удалено из избранного');
        } else {
            // Добавляем в избранное
            Favorite::create([
                'user_id' => $user->id,
                'car_id' => $car->id,
            ]);
            // $car->update([
            //     'is_favorite' => true
            // ]);
            return redirect()->back()->with('success', 'Авто добавлено в избранное');
        }
    }

    public function clear()
    {
        $user = Auth::user();
        
        // Получаем все ID автомобилей в избранном у пользователя
        $favoriteCarIds = $user->favorites()->pluck('car_id');
        
        // Обновляем статус is_favorite для этих автомобилей
        Car::whereIn('id', $favoriteCarIds)->update(['is_favorite' => false]);
        
        // Удаляем все записи из избранного для пользователя
        $user->favorites()->delete();
        
        return redirect()->back()->with('success', 'Избранное успешно очищено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
