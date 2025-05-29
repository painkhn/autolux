@extends('layouts.app')

@section('content')
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection