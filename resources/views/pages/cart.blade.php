@extends('layouts.app')

@section('content')
    <div class="flex gap-10">
        <div class="w-2/3 space-y-10">
            <form method="post" action="{{ route('cart.clear') }}">
                <input type="hidden" name="_method" value="DELETE">
                @csrf
                <button type="submit" @disabled($cartItems->count() === 0) class="w-full flex items-center justify-center gap-2 py-3.5 font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none disabled:opacity-50 disabled:hover:bg-blue-700 disabled:hover:dark:bg-blue-600 focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                    </svg>
                    <span>Очистить корзину</span>
                </button>
            </form>
            <ul class="grid grid-cols-2 gap-10">
                @if ($cartItems->count() > 0)
                    @foreach ($cartItems as $item)
                        <div class="p-5 border border-black/20 dark:border-black bg-gray-200 dark:bg-[#14181d] rounded-md transition-all shadow-black hover:shadow-xl relative">
                            <div class="w-full h-[180px] flex items-center justify-center text-center overflow-hidden">
                                <img src="{{ asset('storage/' . $item->car->image) }}" alt="" class="max-w-[300px] w-full">
                            </div>
                            <div class="flex items-center justify-between">
                                <h3 class="text-black dark:text-white text-lg font-semibold">
                                    {{ $item->car->title }} | <span>{{ $item->car->price }} ₽</span>
                                </h3>
                                <p class="text-black dark:text-white font-semibold opacity-50">
                                    Количество: {{ $item->quantity }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>
                        <h3 class="text-black mb-5 dark:text-white font-semibold text-lg">
                            Ваша корзина пуста
                        </h3>
                        <a href="{{ route('home') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Перейти в каталог
                        </a>
                    </div>
                @endif
            </ul>
        </div>
        <div class="w-1/3">
            <div class="w-full p-5 bg-gray-200 dark:bg-[#14181d] rounded-md border-black/20 dark:border-black border text-black dark:text-white space-y-2">
                <p class="font-semibold">
                    Автомобилей в корзине: <span>{{ $cartItems->count() }}</span>
                </p>
                <p class="font-semibold">
                    Итоговая стоимость: <span>{{ number_format($totalPrice, 0, '', ' ') }}</span> ₽
                </p>
                <hr class="border-black">
                <form action="{{ route('order.store') }}" class="space-y-4" method="post">
                    @csrf
                    <div>
                        <x-label for="delivery_method" value="Способ оплаты" />
                        <select id="delivery_method" name="delivery_method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Выберите способ оплаты</option>
                            <option value="cash">Наличные</option>
                            <option value="card">По карте</option>
                        </select>
                    </div>
                    <div>
                        <x-label for="address" value="Адрес доставки" />
                        <x-input id="address" type="text" name="address" placeholder="Введите полный адрес доставки" />
                    </div>
                    <div>
                        <x-label for="name" value="Имя" />
                        <x-input id="name" type="text" name="name" placeholder="Введите ваше полное имя" />
                    </div>
                    <div>
                        <x-label for="last_name" value="Фамилия" />
                        <x-input id="last_name" type="text" name="last_name" placeholder="Введите вашу фамилию" />
                    </div>
                    <div>
                        <x-label for="father_name" value="Отчетсво *" />
                        <x-input id="father_name" type="text" name="father_name" placeholder="Введите ваше отчетсво (если есть)" />
                    </div>
                    <div>
                        <x-label for="phone_number" value="Номер телефона *" />
                        <x-input id="phone_number" type="tel" name="phone_number" placeholder="Введите ваш номер телефона (для связи)" />
                    </div>
                    <div>
                        <x-label for="email" value="Электронная почта" />
                        <x-input id="email" type="email" name="email" placeholder="Введите вашу электронную почту" />
                    </div>
                    <p class="opacity-80">
                        После оформления заказа мы свяжемся с вами по номеру телефона или электронной почте, чтобы подтвердить заказ.
                    </p>
                    <p class="opacity-80">
                        Оформляя заказ, вы соглашаетесь на обработку персональных данных.
                    </p>
                    <button type="submit" @disabled($cartItems->count() === 0) class="disabled:opacity-50 disabled:hover:bg-blue-700 disabled:hover:dark:bg-blue-600 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Оформить заказ</button>
                </form>
            </div>
        </div>
    </div>
@endsection