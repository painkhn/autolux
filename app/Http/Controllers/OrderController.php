<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
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
    public function store(StoreOrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $cartItems = $user->cartItems()->with('car')->get();
            
            // Проверяем, что корзина не пуста
            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Ваша корзина пуста');
            }

            // Рассчитываем общую стоимость
            $totalPrice = $cartItems->sum(function($item) {
                return $item->car->price * $item->quantity;
            });

            // Создаем заказ для каждого автомобиля в корзине
            foreach ($cartItems as $item) {
                Order::create([
                    'user_id' => $user->id,
                    'car_id' => $item->car_id,
                    'status' => 'pending',
                    'delivery_method' => $request->delivery_method,
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'father_name' => $request->father_name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'total_price' => $item->car->price * $item->quantity,
                    'quantity' => $item->quantity, // Добавляем количество
                ]);
            }

            // Очищаем корзину после создания заказов
            $user->cartItems()->delete();

            DB::commit();

            return redirect()->route('orders.index')
                ->with('success', 'Заказ успешно оформлен');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Произошла ошибка при оформлении заказа: ' . $e->getMessage());
        }
    }

    public function confirm($id)
    {
        $order = Order::where('id', $id);
        $order->update([
            'status' => 'confirmed'
        ]);

        return redirect()->back()->with('status', 'Заказ успешно подтверждён');
    }

    public function complete($id)
    {
        $order = Order::where('id', $id);
        $order->update([
            'status' => 'completed'
        ]);

        return redirect()->back()->with('status', 'Заказ успешно выполнен');
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id);
        $order->update([
            'status' => 'canceled'
        ]);

        return redirect()->back()->with('status', 'Заказ успешно отменён');
    }

    public function pending($id)
    {
        $order = Order::where('id', $id);
        $order->update([
            'status' => 'pending'
        ]);

        return redirect()->back()->with('status', 'Заказ успешно возвращён');
    }
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
