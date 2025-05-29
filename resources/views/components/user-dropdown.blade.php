<div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md shadow-black/30 w-44 dark:bg-gray-700 dark:divide-gray-600">
    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
        <div>{{ auth()->user()->name }}</div>
        <div class="font-medium truncate">{{ auth()->user()->email }}</div>
    </div>
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformationButton">
        <li>
            <a href="{{ route('profile.orders') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Мои заказы</a>
        </li>
        <li>
            <a href="{{ route('profile.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Настройки</a>
        </li>
        @if (auth()->user()->role === 'admin')
            <li>
                <a href="{{ route('admin.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Панель админа</a>
            </li>
        @endif
    </ul>
    <div class="py-2">
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit" href="#" class="block w-full py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Выйти из аккаунта</button>
        </form>
    </div>
</div>