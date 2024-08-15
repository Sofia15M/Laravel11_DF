@push('styles')
    <link rel="stylesheet" href="{{ asset('css/styleregister.css') }}">
@endpush

<x-app-layout>

    <section>
        <div class="container">
            <div class="user login">
                <div class="img-box">
                    <img src="../img/info.png" alt="Logo" />
                </div>
                <div class="form-box">
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-control">
                            <h1> <strong>Registrar:</strong> </h1>
                            <x-label for="name" value="{{ __('Nombre completo:') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-label for="email" value="{{ __('Gmail:') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-label for="password" value="{{ __('Contraseña:') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            <x-label for="password_confirmation" value="{{ __('Confirmar contraseña:') }}" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-label for="foto_user" value="{{ __('Foto usuario:')}}"/>
                            <x-input id="foto_user" class="block mt-1 w-full" type="file" name="foto_user" required/>
                            <select name="id_rol" id="id_rol" class="block mt-1 w-full" required>
                                <option value="1">Administrador</option>
                                <option value="2">Vigilante</option>
                            </select>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox name="terms" id="terms" required />

                                            <div class="ms-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-label>
                                </div>
                            @endif

                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-button class="ms-4">
                                    {{ __('Register') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
