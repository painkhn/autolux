@extends('layouts.app')

@section('content')
    <div class="w-2/3">
        <ul class="grid grid-cols-2 gap-10">
            @foreach ($cartItems as $item)
                <div class="p-5 border border-black/20 dark:border-black bg-gray-200 dark:bg-[#14181d] rounded-md transition-all shadow-black hover:shadow-xl relative">
                    <!-- <form method="POST" action="{{ route('cart.add', ['car' => $item->car->id]) }}">
                        @csrf
                        <button type="submit" class="absolute top-4 right-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    </form> -->
                    <!-- <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                    </svg>

                    </button> -->
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
        </ul>
    </div>
@endsection