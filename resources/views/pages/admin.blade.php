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
                                    {{ $car->brand->title }}
                                </div>
                                <div class="flex items-center gap-x-2">
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
    </div>
@endsection