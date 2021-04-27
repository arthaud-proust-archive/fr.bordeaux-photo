@php

$displayableRoutes = [
    'Accueil' => 'home',
    'Évènements' => 'event.index'
]

@endphp

<nav x-data="{ open: false }" class="">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                
                
                <div class="flex-shrink-0 flex items-center p-1">
                    <button id="themeToggler" class="p-3 text-p1">
                        <svg width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 0C7.77614 0 8 0.223858 8 0.5V2.5C8 2.77614 7.77614 3 7.5 3C7.22386 3 7 2.77614 7 2.5V0.5C7 0.223858 7.22386 0 7.5 0ZM2.1967 2.1967C2.39196 2.00144 2.70854 2.00144 2.90381 2.1967L4.31802 3.61091C4.51328 3.80617 4.51328 4.12276 4.31802 4.31802C4.12276 4.51328 3.80617 4.51328 3.61091 4.31802L2.1967 2.90381C2.00144 2.70854 2.00144 2.39196 2.1967 2.1967ZM0.5 7C0.223858 7 0 7.22386 0 7.5C0 7.77614 0.223858 8 0.5 8H2.5C2.77614 8 3 7.77614 3 7.5C3 7.22386 2.77614 7 2.5 7H0.5ZM2.1967 12.8033C2.00144 12.608 2.00144 12.2915 2.1967 12.0962L3.61091 10.682C3.80617 10.4867 4.12276 10.4867 4.31802 10.682C4.51328 10.8772 4.51328 11.1938 4.31802 11.3891L2.90381 12.8033C2.70854 12.9986 2.39196 12.9986 2.1967 12.8033ZM12.5 7C12.2239 7 12 7.22386 12 7.5C12 7.77614 12.2239 8 12.5 8H14.5C14.7761 8 15 7.77614 15 7.5C15 7.22386 14.7761 7 14.5 7H12.5ZM10.682 4.31802C10.4867 4.12276 10.4867 3.80617 10.682 3.61091L12.0962 2.1967C12.2915 2.00144 12.608 2.00144 12.8033 2.1967C12.9986 2.39196 12.9986 2.70854 12.8033 2.90381L11.3891 4.31802C11.1938 4.51328 10.8772 4.51328 10.682 4.31802ZM8 12.5C8 12.2239 7.77614 12 7.5 12C7.22386 12 7 12.2239 7 12.5V14.5C7 14.7761 7.22386 15 7.5 15C7.77614 15 8 14.7761 8 14.5V12.5ZM10.682 10.682C10.8772 10.4867 11.1938 10.4867 11.3891 10.682L12.8033 12.0962C12.9986 12.2915 12.9986 12.608 12.8033 12.8033C12.608 12.9986 12.2915 12.9986 12.0962 12.8033L10.682 11.3891C10.4867 11.1938 10.4867 10.8772 10.682 10.682ZM5.5 7.5C5.5 6.39543 6.39543 5.5 7.5 5.5C8.60457 5.5 9.5 6.39543 9.5 7.5C9.5 8.60457 8.60457 9.5 7.5 9.5C6.39543 9.5 5.5 8.60457 5.5 7.5ZM7.5 4.5C5.84315 4.5 4.5 5.84315 4.5 7.5C4.5 9.15685 5.84315 10.5 7.5 10.5C9.15685 10.5 10.5 9.15685 10.5 7.5C10.5 5.84315 9.15685 4.5 7.5 4.5Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>
                </div>

                <!-- Logo -->
                <!-- <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('profil.show') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-p1" />
                    </a>
                </div> -->


                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @foreach($displayableRoutes as $title=>$name)
                    <x-nav-link :href="route($name)" :active="request()->routeIs($name)">
                        {{ $title }}
                    </x-nav-link>
                    @endforeach
                </div>
            </div>

            <!-- Settings Dropdown -->

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-p1 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>
                                @auth
                                {{ Auth::user()->name }}
                                @else
                                Mon compte
                                @endauth
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @auth
                        <!-- Authentication -->
                        <x-dropdown-link :href="route('profil.show')">Profil</x-dropdown-link>
                        @authRole('admin')
                        <x-dropdown-link :href="route('user.index')">Utilisateurs</x-dropdown-link>
                        <x-dropdown-link :href="route('page.index')">Édition des pages</x-dropdown-link>
                        @endauthRole
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link onclick="nav((event)=>{this.closest('form').submit();})">
                                Se déconnecter
                            </x-dropdown-link>
                        </form>
                        @else
                        <x-dropdown-link :href="route('login')">Connexion</x-dropdown-link>
                        <x-dropdown-link :href="route('register')">Créer un compte</x-dropdown-link>
                        <x-dropdown-link :href="route('password.request')">Mot de passe oublié</x-dropdown-link>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button id="menuToggler" @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div id="responsiveMenu" :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach($displayableRoutes as $title=>$name)
                <x-responsive-nav-link :href="route($name)" :active="request()->routeIs($name)">
                    {{ $title }}
                </x-responsive-nav-link>
            @endforeach

            @authRole('admin')
                <x-responsive-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                    Liste des utilisateurs
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('page.index')" :active="request()->routeIs('page.index')">Édition des pages</x-responsive-nav-link>

            @endauthRole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-b border-s3">
            @auth
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <a href="{{ route('profil.show') }}">
                    <div class="ml-3">
                        <div class="font-medium text-base text-p1">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-p3">{{ Auth::user()->email }}</div>
                    </div>
                </a>

            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link onclick="nav((event)=>{this.closest('form').submit();})">Se déconnecter</x-responsive-nav-link>
                </form>
            </div>
            @else 
                <x-responsive-nav-link :href="route('login')">Connexion</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">Créer un compte</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('password.request')">Mot de passe oublié</x-responsive-nav-link>

            @endauth
        </div>
    </div>
</nav>
