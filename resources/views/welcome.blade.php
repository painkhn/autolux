@extends('layouts.app')

@section('content')
    <div class="space-y-5">
        <form action="{{ route('home') }}" method="GET" class="w-full p-4 bg-gray-200 dark:bg-[#14181d] border border-black/20 dark:border-black rounded-md flex items-center gap-4 justify-between">
            
            <div class="w-full">   
                <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" name="search" id="search" value="{{ request('search') }}" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Введите название авто..." />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <select name="brand" id="brands" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[200px] p-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Все марки</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->title }}
                        </option>                
                    @endforeach
                </select>

                <select name="sort" id="sort" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[200px] p-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Сортировка</option>
                    <option value="new" {{ request('sort') == 'new' ? 'selected' : '' }}>Сначала новые</option>
                    <option value="old" {{ request('sort') == 'old' ? 'selected' : '' }}>Сначала старые</option>
                </select>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
                
                @if(request()->has('search') || request()->has('brand') || request()->has('sort'))
                <a href="{{ route('home') }}" class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-3 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Сбросить
                </a>
                @endif
            </div>

        </form>
        
        @if($cars->isEmpty())
        <div class="p-4 text-center bg-gray-200 dark:bg-[#14181d] border border-black/20 dark:border-black rounded-md">
            <p class="text-black dark:text-white">Автомобили не найдены</p>
        </div>
        @else
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($cars as $car)
                <li class="relative">
                    <form method="post" action="{{ route('favorite.store', ['id' => $car->id]) }}" class="absolute top-4 right-4 z-20">
                        @csrf
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            @if ($car->is_favorite === 0)
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z"/>
                                </svg>
                            @endif
                        </button>
                    </form>
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
        
        <div class="mt-4">
            {{ $cars->links() }}
        </div>
        @endif
    </div>
@endsection