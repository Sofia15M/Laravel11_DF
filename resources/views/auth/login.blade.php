<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('img/logoC.png') }}" alt="Logo" class="h-16 w-auto">
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Gmail') }}" class="text-white" />
                <x-input id="email" class="block mt-1 w-full p-2 border-b border-white bg-transparent text-white focus:outline-none placeholder-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" class="text-white" />
                <x-input id="password" class="block mt-1 w-full p-2 border-b border-white bg-transparent text-white focus:outline-none placeholder-white" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="text-white" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recordar') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-button class="ms-4 bg-var(--Azul3) text-white px-4 py-2 rounded hover:bg-var(--Azul4)">
                    {{ __('Iniciar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
