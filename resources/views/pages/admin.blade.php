@extends('layouts.app')

@section('content')
    <div class="space-y-5">
        <p class="text-6xl uppercase text-black dark:text-white">
            {{ auth()->user()->name }}
        </p>
        <span class="text-black dark:text-white">
            <?php
                echo date("d.m.Y"); // Выведет текущее время в формате HH:MM:SS (например, 14:30:15)
            ?>
        </span>
        <div>
            <button data-modal-target="new-brand-modal" data-modal-toggle="new-brand-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Добавить марку</button>
            <x-new-brand-modal title="new-brand-modal" />
            <button data-modal-target="new-car-modal" data-modal-toggle="new-car-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Добавить авто</button>
            <x-new-car-modal title="new-car-modal" :brands="$brands" />
        </div>
        <div>
            <ul class="text-black dark:text-white font-semibold flex items-center gap-8">
                @foreach ($brands as $brand)
                    <li>
                        <div class="flex items-center gap-4">
                            @if ($brand->image)
                                <div class="w-10 h-10 flex items-center justify-center rounded-full overflow-hidden">
                                    <input type="image" src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->title }}" class="h-10 cursor-default">
                                </div>
                            @else
                                <div></div>
                            @endif
                            {{ $brand->title }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <ul class="grid grid-cols-2 gap-5">
                @foreach ($cars as $car)
                    <li>
                        <div class="p-5 flex justify-between text-black dark:text-white border border-black/20 dark:border-white/20 rounded-md transition-all hover:border-black/40 hover:dark:border-white/40">
                            <div class="space-y-2 w-1/2">
                                <div class="flex items-center gap-5">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-full overflow-hidden">
                                        <input type="image" src="{{ asset('storage/' . $car->brand->image) }}" alt="{{ $car->brand->title }}" class="h-10 cursor-default">
                                    </div>
                                    <h3 class="font-semibold">
                                        {{ $car->brand->title }}
                                    </h3>
                                </div>
                                <div class="flex items-center gap-x-2 opacity-80">
                                    <h3>
                                        {{ $car->title }}
                                    </h3>
                                    |
                                    <p>
                                        {{ $car->price }} ₽
                                    </p>
                                </div>
                            </div>
                            <div class="w-1/2 text-right">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Редактировать</button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID заказа
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Адрес
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Клиент
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Общая сумма заказа
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                # {{ $order->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $order->address }}
                            </td>
                            <td class="px-6 py-4">
                                <button data-modal-target="order-user-modal" data-modal-toggle="order-user-modal">
                                    {{ $order->user->name }}
                                </button>
                                <x-order-user-data :user="$order->user" :order="$order" />
                            </td>
                            <td class="px-6 py-4">
                                $2999
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection