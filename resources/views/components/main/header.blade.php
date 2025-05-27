<header class="w-full dark:bg-[#14181d]">
    <div class="max-w-7xl w-full min-h-20 mx-auto grid grid-cols-3 items-center px-5 justify-between">
        <x-logo />

        @auth
            @if (auth()->user()->role === 'admin')
                <ul class="justify-self-center">
                    <li>
                        <a href="{{ route('admin.index') }}" class="font-semibold text-black dark:text-white transition-all hover:underline hover:opacity-80">
                            Панель администратора
                        </a>
                    </li>
                </ul>
            @endif
        @else
            <div class="justify-self-center"></div>
        @endauth

        <div class="flex items-center justify-self-end">
            @auth
                <ul class="flex items-center gap-4">
                    <li class="flex items-center">
                        <button type="button" id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" class="transition-all hover:opacity-80">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                        <x-user-dropdown />
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}" class="transition-all hover:opacity-80">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#!" class="transition-all hover:opacity-80">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            @else
                <ul class="flex items-center">
                    <li>
                        <button data-modal-target="register-modal" data-modal-toggle="register-modal" class="font-semibold hover:underline px-4 py-2 text-black dark:text-white">Регистрация</button>
                        <x-main.register-modal title="register-modal" />
                    </li>
                    <li>
                        <button data-modal-target="login-modal" data-modal-toggle="login-modal" class="font-semibold px-4 py-2 border border-black/20 dark:border-white/20 transition-all hover:border-black/40 hover:dark:border-white/40 text-sm text-black dark:text-white">Вход</button>
                        <x-login-modal title="login-modal" />
                    </li>
                </ul>
            @endauth
            <button
                onclick="
                    const html = document.documentElement;
                    const isDark = html.classList.toggle('dark');
                    localStorage.theme = isDark ? 'dark' : 'light';
                    document.getElementById('theme-icon').setAttribute('data-theme', isDark ? 'dark' : 'light');
                "
                class="flex items-center justify-center px-4 py-2 transition-all hover:opacity-80 font-semibold"
                aria-label="Сменить тему">
                <svg id="theme-icon" data-theme="light"
                    class="w-6 h-6 flex items-center justify-center text-center relative dark:text-white text-black"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <!-- Солнце -->
                    <g data-theme="light">
                        <circle cx="12" cy="12" r="5"></circle>
                        <path
                            d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                    </g>
                    <!-- Луна -->
                    <g data-theme="dark" style="display: none;">
                        <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                    </g>
                </svg>
            </button>
        </div>
    </div>
</header>