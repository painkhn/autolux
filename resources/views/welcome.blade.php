@extends('layouts.app')

@section('content')
    <div class="w-full overflow-hidden h-[500px] flex items-center justify-center mb-10">
        <img src="/img/porsche.png" alt="">
    </div>
    <div class="space-y-2 text-center mb-10">
        <h1 class="text-black dark:text-white text-6xl font-black">AUTOLUX</h1>
        <p class="text-xl text-black dark:text-white opacity-80">Автосалон для тех, кто знает чего хочет</p>
    </div>
    <ul class="grid grid-cols-3 gap-5 mb-10">
        @foreach ($cars->take(3) as $car)
            <li>
                <a href="{{ route('car.show', ['id' => $car->id]) }}">
                    <div class="p-5 border border-black/20 dark:border-black bg-gray-200 dark:bg-[#14181d] rounded-md transition-all shadow-black hover:shadow-xl">
                        <div class="w-full h-[180px] flex items-center justify-center text-center overflow-hidden">
                            <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->title }}" class="max-w-[300px] w-full h-full object-contain">
                        </div>
                        <h3 class="text-black dark:text-white text-lg font-semibold">
                            {{ $car->title }} | <span>{{ number_format($car->price, 0, '', ' ') }} ₽</span>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $car->brand->title }}, {{ $car->year }} год</p>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="text-center mb-10">
        @auth
            <a href="{{ route('shop') }}" class="dark:text-blue-400 text-blue-600 transition-all hover:text-blue-500 hover:dark:text-blue-300 text-2xl font-semibold">Скорее переходи к покупкам!</a>
        @else
            <p class="text-lg font-semibold dark:text-white text-black mb-5">
                Войдите в аккаунт, чтобы пользоваться услугами нашего автосалона
            </p>
            <button data-modal-target="login-modal" data-modal-toggle="login-modal" type="button" class="px-5 py-3 text-base font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Войти</button>
            <x-login-modal title="login-modal" />
        @endauth
    </div>
@endsection