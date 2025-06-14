<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('car')->get();
        $totalPrice = $cartItems->sum(function($item) {
            return $item->car->price;
        });
        return view('pages.cart', compact('cartItems', 'totalPrice'));
    }

    public function add(Car $car, Request $request)
    {
        $user = Auth::user();
        
        $cartItem = Cart::firstOrCreate(
            ['user_id' => $user->id, 'car_id' => $car->id]
        );
        
        return back()->with('success', 'Авто добавлено в корзину');
    }

    public function clear()
    {
        $user = Auth::user();
        Cart::where('user_id', $user->id)->delete();

        return back()->with('success', 'Корзина очищена');
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
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
