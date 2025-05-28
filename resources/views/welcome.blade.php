@extends('layouts.app')

@section('content')
    <div class="space-y-5">
        <div class="w-full p-4 bg-gray-200 dark:bg-[#14181d] border border-black/20 dark:border-black rounded-md flex items-center gap-4 justify-between">
            
            <div class="w-full">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Введите название авто..." required />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[200px] p-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Выберите марку</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">
                            {{ $brand->title }}
                        </option>                
                    @endforeach
                </select>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </div>

        </div>
        <ul class="grid grid-cols-3 gap-10">
            @foreach ($cars as $car)
                <a href="{{ route('car.show', ['id' => $car->id]) }}">
                    <div class="p-5 border border-black/20 dark:border-black bg-gray-200 dark:bg-[#14181d] rounded-md transition-all shadow-black hover:shadow-xl relative">
                        <button type="button" class="absolute top-4 right-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                            </svg>
                        </button>
                        <div class="w-full h-[180px] flex items-center justify-center text-center overflow-hidden">
                            <img src="{{ asset('storage/' . $car->image) }}" alt="" class="max-w-[300px] w-full">
                        </div>
                        <h3 class="text-black dark:text-white text-lg font-semibold">
                            {{ $car->title }} | <span>{{ $car->price }} ₽</span>
                        </h3>
                    </div>
                </a>
            @endforeach
        </ul>
    </div>
@endsection