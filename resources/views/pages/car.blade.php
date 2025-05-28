@extends('layouts.app')

@section('content')
    <div>
        <div class="w-full relative overflow-hidden">
            <img src="{{ asset('storage/' . $car->image) }}" alt="" class="-mt-40 w-full">
            <div class="grid grid-cols-3 items-center justify-between p-5 bg-gray-200 dark:bg-[#14181d] rounded-xl mb-5">
                <img src="{{ asset('storage/' . $car->brand->image) }}" alt="" class="w-20">
                <h2 class="text-4xl font-black uppercase text-black dark:text-white justify-self-center">
                    {{ $car->title }}
                </h2>
                <p class="my-5 text-2xl font-semibold justify-self-end text-black dark:text-white">
                    {{ $car->price }} <span class="text-blue-700">₽</span>
                </p>
            </div>
            <form method="POST" action="{{ route('cart.add', ['car' => $car->id]) }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 text-lg font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                    </svg>
                    <span>Добавить в корзину</span>
                </button>
            </form>
        </div>

        <div class="py-10">
            <h1 class="text-center text-2xl font-semibold text-black dark:text-white">Характеристики</h1>
            <ul class="bg-gray-200 dark:bg-[#14181d] my-5 p-5 rounded-xl text-black dark:text-white">
                <li class="space-y-5">
                    <ul class="flex text-lg font-semibold">
                        <li class="w-1/3">
                            Пробег
                        </li>
                        <li class="w-2/3">
                            {{ $car->mileage }}
                        </li>
                    </ul>
                    <hr class="border-black">
                    <ul class="flex text-lg font-semibold">
                        <li class="w-1/3">
                            Год выпуска
                        </li>
                        <li class="w-2/3">
                            {{ $car->year }} г. (фиксану)
                        </li>
                    </ul>
                    <hr class="border-black">
                    <ul class="flex text-lg font-semibold">
                        <li class="w-1/3">
                            Топливо
                        </li>
                        <li class="w-2/3">
                            @if ($car->engine_type === 'petrol')
                                <span>Бензин</span>
                            @elseif ($car->engine_type === 'diesel')
                                <span>Дизель</span>
                            @elseif ($car->engine_type === 'electric')
                                <span>Электрическое</span>
                            @elseif ($car->engine_type === 'hybrid')
                                <span>Гибрид</span>
                            @endif
                        </li>
                    </ul>
                    <hr class="border-black">
                    <ul class="flex text-lg font-semibold">
                        <li class="w-1/3">
                            Объём двигателя
                        </li>
                        <li class="w-2/3">
                            {{ $car->engine_volume }} л
                        </li>
                    </ul>
                    <hr class="border-black">
                    <ul class="flex text-lg font-semibold">
                        <li class="w-1/3">
                            Мощность двигателя
                        </li>
                        <li class="w-2/3">
                            {{ $car->engine_power }} лс
                        </li>
                    </ul>
                    <hr class="border-black">
                    <ul class="flex text-lg font-semibold">
                        <li class="w-1/3">
                            Коробка передач
                        </li>
                        <li class="w-2/3">
                            @if ($car->transmission === 'automatic')
                                <span>Автомат</span>
                            @elseif ($car->transmission === 'manual')
                                <span>Механика</span>
                            @elseif ($car->engine_type === 'robot')
                                <span>Робот</span>
                            @endif
                        </li>
                    </ul>
                    <hr class="border-black">
                    <ul class="flex text-lg font-semibold">
                        <li class="w-1/3">
                            Привод
                        </li>
                        <li class="w-2/3">
                            {{ $car->drive_type }}
                        </li>
                    </ul>
                    <hr class="border-black">
                    <ul class="flex text-lg font-semibold">
                        <li class="w-1/3">
                            Цвет
                        </li>
                        <li class="w-2/3">
                            {{ $car->color }}
                        </li>
                    </ul>
                    <hr class="border-black">
                    <ul class="flex text-lg font-semibold">
                        <li class="w-1/3">
                            Тип кузова
                        </li>
                        <li class="w-2/3">
                            {{ $car->body_type }}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
@endsection