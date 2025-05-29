@extends('layouts.app')

@section('content')
    <div class="flex gap-10">
        <div class="w-1/2">
            <div class="space-y-2">
                <a href="{{ route('favorite.index') }}" class="text-black dark:text-white font-semibold text-xl flex items-center gap-0 transition-all hover:gap-2">
                    Избранное
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
                    </svg>
                </a>
                @if ($favorites->count() > 0)
                    <ul class="grid grid-cols-2 gap-5">
                        @foreach ($favorites->take(2) as $favorite)
                            <li>
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
                    <h3 class="text-black mb-5 dark:text-white font-semibold opacity-80">
                        Вы не добавили ни одного автомобиля в избранное
                    </h3>
                    <a href="{{ route('home') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Перейти в каталог
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="w-1/2">
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 w-full">
                @csrf
                @method('patch')
    
                <div>
                    <x-input-label for="name" :value="__('Имя пользователя')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
    
                <div>
                    <x-input-label for="email" :value="__('Электронная почта')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
    
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                {{ __('Your email address is unverified.') }}
    
                                <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>
    
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
    
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
    
                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400"
                        >{{ __('Сохранено.') }}</p>
                    @endif
                </div>
            </form>
    
            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 w-full">
                @csrf
                @method('put')
    
                <div>
                    <x-input-label for="update_password_current_password" :value="__('Текущий пароль')" />
                    <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>
    
                <div>
                    <x-input-label for="update_password_password" :value="__('Новый пароль')" />
                    <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>
    
                <div>
                    <x-input-label for="update_password_password_confirmation" :value="__('Повторите пароль')" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
    
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
    
                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400"
                        >{{ __('Сохранено.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection