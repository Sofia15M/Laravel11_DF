<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('img/LogoC.png') }}" alt="Logo" class="block h-9 w-auto">
                    </a>
                    <h1 class="m-2 text-Azul3 text-xl"> <strong>Digital<span class="text-Azul4 text-xl">Face</span></strong></h1>
                </div>
            </div>

            <!-- Hamburger icon - Visible on all screens -->
            <div class="-me-2 flex items-center">
                <button
                    class="inline-flex items-center justify-center p-2 rounded-md text-Azul3 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                    onclick="window.location.href='{{ route('personas.index') }}'">
                    <svg class="h-7 w-7" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <circle cx="7" cy="5" r="2" />
                        <path d="M5 22v-5l-1-1v-4a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4l-1 1v5" />
                        <circle cx="17" cy="5" r="2" />
                        <path d="M15 22v-4h-2l2 -6a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1l2 6h-2v4" />
                    </svg>
                </button>
                <button id="openApiButton" class="inline-flex items-center justify-center p-2 rounded-md text-Azul3 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-7 w-7" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M4 8v-2a2 2 0 0 1 2 -2h2"/>
                        <path d="M4 16v2a2 2 0 0 0 2 2h2"/>
                        <path d="M16 4h2a2 2 0 0 1 2 2v2"/>
                        <path d="M16 20h2a2 2 0 0 0 2 -2v-2"/>
                        <line x1="9" y1="10" x2="9.01" y2="10"/>
                        <line x1="15" y1="10" x2="15.01" y2="10"/>
                        <path d="M9.5 15a3.5 3.5 0 0 0 5 0"/>
                    </svg>
                </button>
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-7 w-7" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation Menu - Controlled by `x-show` -->
    <div x-show="open" @click.away="open = false" class="block sm:block">
        <div class="pt-4 pb-4 m-1 border-t border-b border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4">
                <div class="shrink-0 me-3">
                    @if (Auth::user()->foto_user)
                        <img class="h-20 w-20 rounded-full object-cover" src="{{ asset('storage/' . Auth::user()->foto_user) }}" alt="{{ Auth::user()->name }}" />
                    @else
                        <img class="h-20 w-20 rounded-full object-cover" src="{{ asset('img/LogoC.png') }}" alt="Default Avatar" />
                    @endif
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                        @if (Auth::user()->id_rol == 1)
                            Administrador:
                        @elseif (Auth::user()->id_rol == 2)
                            Vigilante:
                        @else
                            Rol desconocido
                        @endif
                    </div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link
                href="{{ route('dashboard') }}"
                :active="request()->routeIs('dashboard')"
                class="{{ request()->routeIs('dashboard') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Bienvenido') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('unidads.index') }}"
                :active="request()->routeIs('unidads.index')"
                class="{{ request()->routeIs('unidads.index') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Unidad') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('propietarios.index') }}"
                :active="request()->routeIs('propietarios.index')"
                class="{{ request()->routeIs('propietarios.index') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Propietarios') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('apartamentos.index') }}"
                :active="request()->routeIs('apartamentos.index')"
                class="{{ request()->routeIs('apartamentos.index') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Apartamentos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('residentes.index') }}"
                :active="request()->routeIs('residentes.index')"
                class="{{ request()->routeIs('residentes.index') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Residentes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('administradors.index') }}"
                :active="request()->routeIs('administradors.index')"
                class="{{ request()->routeIs('administradors.index') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Administradores') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('vigilantes.index') }}"
                :active="request()->routeIs('vigilantes.index')"
                class="{{ request()->routeIs('vigilantes.index') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Vigilantes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('empleados.index') }}"
                :active="request()->routeIs('empleados.index')"
                class="{{ request()->routeIs('empleados.index') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Empleados') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('visitantes.index') }}"
                :active="request()->routeIs('visitantes.index')"
                class="{{ request()->routeIs('visitantes.index') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Visitantes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('domiciliarios.index') }}"
                :active="request()->routeIs('domiciliarios.index')"
                class="{{ request()->routeIs('domiciliarios.index') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                {{ __('Domiciliarios') }}
            </x-responsive-nav-link>
        </div>

        <!-- Settings options for logged in user -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <x-responsive-nav-link href="{{ route('profile.show') }}"
                    :active="request()->routeIs('profile.show')"
                    class="{{ request()->routeIs('profile.show') ? 'bg-Azul03 text-Azul3 border-l-4 border-Azul3' : '' }}">
                    {{ __('Pefil') }}
                </x-responsive-nav-link>

                @if (auth()->user()->id_rol == 1)
                    <x-responsive-nav-link href="{{ route('auth.register') }}">
                        {{ __('Crear usuario') }}
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link href="{{ route('logout') }}"
                               @click.prevent="$root.submit();">
                    {{ __('Cerrar Sesión') }}
                </x-responsive-nav-link>
            </form>

            <!-- Team Management -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-responsive-nav-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                    <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                        {{ __('Create New Team') }}
                    </x-responsive-nav-link>
                @endcan

                <!-- Team Switcher -->
                @if (Auth::user()->allTeams()->count() > 1)
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-switchable-team :team="$team" component="responsive-nav-link" />
                    @endforeach
                @endif
            @endif
        </div>
    </div>
</nav>

<script>
    document.getElementById('openApiButton').addEventListener('click', function() {
    // Cambia la URL por la de tu API
    const apiUrl = '10.171.146.125:5000'; // Reemplaza con la URL de tu API

    // Abre la URL en una nueva pestaña
    window.open(apiUrl, '_blank');
});
</script>
