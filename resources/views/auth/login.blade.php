@push('styles')
    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">
@endpush

<x-guest-layout>

    <section>
        <div class="container">
            <div class="user login">
                <div class="form-box">
                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-control">
                            <h1>Bienvenidos</h1>
                            <x-input class="input" id="email" type="email" name="email" placeholder="Ingrese su correo electrónico" :value="old('email')" required autofocus autocomplete="off"/>
                            <x-input class="input" id="password" type="password" name="password" placeholder="Ingrese su Contraseña" required autocomplete="current-password" />
                            <label for="remember_me" class="flex-label">
                                <x-checkbox id="remember_me" name="remember" class="checkbox" />
                                <span class="span-text">{{ __('Recordar') }}</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a class="notpassword" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif

                            <x-button class="button">
                                {{ __('Iniciar') }}
                            </x-button>
                        </div>
                    </form>
                </div>
                <div class="img-box">
                    <img src="../img/Logo.jpg" alt="Logo" />
                </div>
            </div>
        </div>
    </section>


</x-guest-layout>
