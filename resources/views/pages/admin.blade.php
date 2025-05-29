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
                        <button data-modal-target="brand-edit-modal-{{ $brand->id }}" data-modal-toggle="brand-edit-modal-{{ $brand->id }}" class="flex items-center gap-4">
                            @if ($brand->image)
                                <div class="w-10 h-10 flex items-center justify-center rounded-full overflow-hidden">
                                    <input type="image" src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->title }}" class="h-10">
                                </div>
                            @else
                                <div></div>
                            @endif
                            {{ $brand->title }}
                        </button>
                        <x-brand-edit-modal title="brand-edit-modal-{{ $brand->id }}" :brand="$brand" />
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
            @if ($orders->count() === 0)
                <span class="block opacity-80 font-semibold text-lg">Заказов нет.</span>
            @else
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID заказа</th>
                            <th scope="col" class="px-6 py-3">Адрес</th>
                            <th scope="col" class="px-6 py-3">Клиент</th>
                            <th scope="col" class="px-6 py-3">Общая сумма заказа</th>
                            <th scope="col" class="px-6 py-3">Статус заказа</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    # {{ $order->id }}
                                </th>
                                <td class="px-6 py-4">{{ $order->address }}</td>
                                <td class="px-6 py-4">
                                    <button data-modal-target="order-user-modal-{{ $order->id }}" data-modal-toggle="order-user-modal-{{ $order->id }}">
                                        {{ $order->user->name }}
                                    </button>
                                    <x-order-user-data :user="$order->user" :order="$order" />
                                </td>
                                <td class="px-6 py-4">
                                    {{ number_format($order->total_price, 0, '', ' ') }} ₽
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order->status }}
                                </td>
                                <td class="px-6 py-4 relative">
                                    <!-- Кнопка с уникальным ID -->
                                    <button data-modal-target="order-status-modal-{{ $order->id }}" data-modal-toggle="order-status-modal-{{ $order->id }}"
                                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                                        </svg>
                                    </button>
                                    
                                    <div id="order-status-modal-{{ $order->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Изменить статус заказа
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="order-status-modal-{{ $order->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <p>
                                                        Заказ  #{{ $order->id }}
                                                    </p>
                                                    <p>
                                                        Авто:
                                                    </p>
                                                    <div>
                                                        <a href="{{ route('car.show', ['id' => $order->car->id]) }}">
                                                            <div class="p-5 flex justify-between text-black dark:text-white border border-black/20 dark:border-white/20 rounded-md transition-all hover:border-black/40 hover:dark:border-white/40">
                                                                <div class="space-y-2 w-1/2">
                                                                    <div class="flex items-center gap-5">
                                                                        <div class="w-10 h-10 flex items-center justify-center rounded-full overflow-hidden">
                                                                            <input type="image" src="{{ asset('storage/' . $order->car->brand->image) }}" alt="{{ $order->car->brand->title }}" class="h-10 cursor-default">
                                                                        </div>
                                                                        <h3 class="font-semibold">
                                                                            {{ $order->car->brand->title }}
                                                                        </h3>
                                                                    </div>
                                                                    <div class="flex items-center gap-x-2 opacity-80">
                                                                        <h3>
                                                                            {{ $order->car->title }}
                                                                        </h3>
                                                                        |
                                                                        <p>
                                                                            {{ $order->car->price }} ₽
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        @if ($order->status === 'pending')
                                                            <form method="post" action="{{ route('order.confirm', ['id' => $order->id]) }}">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Подтвердить заказ</button>
                                                            </form>
                                                            <form method="post" action="{{ route('order.cancel', ['id' => $order->id]) }}">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Отменить заказ</button>
                                                            </form>
                                                        @elseif ($order->status === 'confirmed')
                                                            <form method="post" action="{{ route('order.complete', ['id' => $order->id]) }}">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Заказ выполнен</button>
                                                            </form>
                                                        @elseif ($order->status === 'canceled')
                                                            <form method="post" action="{{ route('order.pending', ['id' => $order->id]) }}">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="PATCH">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Вернуть заказ</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection