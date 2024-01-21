<header x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-10 shadow-lg bg-[rgba(255,255,255,0.75)]"
    :class="{ 'backdrop-blur-md': open === false }">
    <div class="container flex items-center justify-between px-6 py-4 mx-auto">
        <a href="/" class="text-2xl font-bold text-gray-800">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-auto" />
        </a>

        <!-- Butonul de meniu pentru dispozitivele mici -->
        <button @click="open = !open" class="lg:hidden focus:outline-none">
            <!-- Iconița hamburger pentru meniu -->
            <i x-show="!open" class="text-2xl text-gray-800 fas fa-bars"></i>
            <!-- Iconița pentru închiderea meniului -->
            <i x-show="open" class="text-2xl text-gray-800 fas fa-times"></i>
        </button>

        <!-- Meniul pentru dispozitivele mici -->
        <nav x-show="open" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-x-[-100%] "
            x-transition:enter-end="opacity-100 translate-x-0 "
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 translate-x-0 "
            x-transition:leave-end="opacity-0 translate-x-[-100%] " @keydown.escape="open = false"
            class="fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center max-h-screen overflow-y-auto bg-white bg-opacity-75 border-0 md:border-r md:right-auto mobile-navbar lg:hidden min-w-[100vw] min-h-[100vh] backdrop-blur-md">
            <div class="flex justify-end">
                <button
                    class="absolute inline-block text-gray-700 transition lg:hidden md:right-10 md:top-10 top-4 right-4 hover:text-economic-red hover:scale-125"
                    @click="open = false">
                    <i class="text-2xl fas fa-times"></i>
                </button>
            </div>
            <div>
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-auto" />
                </a>
                <ul class="text-center" style="list-style: none;">
                    <li><a href="/noutati"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen text-black">Noutati</a>
                    </li>
                    <li><a href="#"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen text-black">Oferte</a>
                    </li>
                    <li> <x-nav-dropdown title="Despre noi" :toPages="['echipa', 'cariera', 'despre-noi']">
                            <a href="/echipa"
                                class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen ">Echipa</a>
                            <a href="/cariera"
                                class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen ">Cariera</a>
                            <a href="/despre-noi"
                                class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Despre
                            </a>
                        </x-nav-dropdown>
                    </li>
                    <li><a href="#"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen text-black">Intrebari
                            frecvente</a>
                    </li>
                    <li><a href="/contact"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen text-black">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Meniul pentru dispozitivele mari -->
        <nav id="mainMenu" class="hidden lg:block lg:ml-auto">
            <ul class="items-center justify-end pt-4 text-lg font-semibold text-gray-800 lg:flex lg:pt-0"
                style="list-style: none;">
                <li><a href="/articole"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen text-black">Articole</a>
                </li>
                <li><a href="/oferte"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen text-black">Oferte</a>
                </li>
                <li> <x-nav-dropdown title="Despre noi" :toPages="['echipa', 'cariera', 'despre-noi']">
                        <a href="/echipa"
                            class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Echipa</a>
                        <a href="/cariera"
                            class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Cariera</a>
                        <a href="/despre-noi"
                            class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Despre
                        </a>
                    </x-nav-dropdown></li>
                <a href="/intrebari-frecvente"
                    class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen text-black">Intrebari
                    frecvente</a>
                </li>
                <li><a href="/contact"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen text-black">Contact</a>
                </li>

                @guest
                    <li><a href="/login"
                            class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen text-black"><svg
                                height='20px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                            </svg></a>
                    </li>
                @endguest

                @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profilul meu') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Ieși din cont') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
            </ul>
        </nav>
    </div>
</header>
