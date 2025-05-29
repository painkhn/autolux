@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('favorite.clear') }}" class="mb-10">
        <input type="hidden" name="_method" value="DELETE">
        @csrf
        <button type="submit" @disabled($favorites->count() === 0) class="w-full flex items-center justify-center gap-2 py-3.5 font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none disabled:opacity-50 disabled:hover:bg-blue-700 disabled:hover:dark:bg-blue-600 focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
            </svg>
            <span>Очистить</span>
        </button>
    </form>
    @if ($favorites->count() > 0)
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($favorites as $favorite)
                <li class="relative">
                    <form method="post" action="{{ route('favorite.store', ['id' => $favorite->car->id]) }}" class="absolute top-4 right-4 z-20">
                        @csrf
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z"/>
                            </svg>
                        </button>
                    </form>
                    <a href="{{ route('car.show', ['id' => $favorite->car->id]) }}">
                        <div class="p-5 border border-black/20 dark:border-black bg-gray-200 dark:bg-[#14181d] rounded-md transition-all shadow-black hover:shadow-xl">
                            <div class="w-full h-[180px] flex items-center justify-center text-center overflow-hidden">
                                <img src="{{ asset('storage/' . $favorite->car->image) }}" alt="{{ $favorite->car->title }}" class="max-w-[300px] w-full h-full object-contain">
                            </div>
                            <h3 class="text-black dark:text-white text-lg font-semibold">
                                {{ $favorite->car->title }} | <span>{{ number_format($favorite->car->price, 0, '', ' ') }} ₽</span>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $favorite->car->brand->title }}, {{ $favorite->car->year }} год</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <div>
            <h3 class="text-black mb-5 dark:text-white font-semibold text-lg">
                Вы не добавили ни одного автомобиля в избранное
            </h3>
            <a href="{{ route('home') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Перейти в каталог
            </a>
        </div>
    @endif
@endsection