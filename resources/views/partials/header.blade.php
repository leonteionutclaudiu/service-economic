<header x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-10 bg-white shadow-lg">
    <div class="container flex items-center justify-between px-6 py-4 mx-auto">
        <a href="/" class="text-2xl font-bold text-gray-800">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-auto" />
        </a>

        <!-- Butonul de meniu pentru dispozitivele mici -->
        <button @click="open = !open" class="lg:hidden focus:outline-none">
            <!-- Iconița hamburger pentru meniu -->
            <i x-show="!open" class="text-2xl text-gray-800 fas fa-bars"></i>
            <!-- Iconița pentru închiderea meniului -->
            <i x-show="open" @click.away="open = false" class="text-2xl text-gray-800 fas fa-times"></i>
        </button>

        <!-- Meniul pentru dispozitivele mici -->
        <nav x-show="open" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-x-[-100%] "
            x-transition:enter-end="opacity-100 translate-x-0 "
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 translate-x-0 "
            x-transition:leave-end="opacity-0 translate-x-[-100%] " @click.away="isOpen = false"
            @keydown.escape="isOpen = false"
            class="fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center max-h-screen overflow-y-auto bg-white bg-opacity-75 border-0 md:border-r md:right-auto backdrop-blur-md mobile-navbar lg:hidden">
            <div class="flex justify-end">
                <button
                    class="absolute inline-block text-gray-700 transition md:hidden md:right-10 md:top-10 top-4 right-4 hover:text-economic-red hover:scale-125"
                    @click="isOpen = false">
                    <i class="text-2xl fas fa-times"></i>
                </button>
            </div>
            <div>
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-auto" />
                </a>
                <ul class="text-center" style="list-style: none;">
                    <li><a href="#"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen">Anunturi</a>
                    </li>
                    <li><a href="#"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen">Oferte</a></li>
                    <li><a href="#"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen">Despre noi</a>
                    </li>
                    <li><a href="/contact"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Meniul pentru dispozitivele mari -->
        <nav id="mainMenu" class="hidden lg:block lg:ml-auto">
            <ul class="items-center justify-end pt-4 text-lg font-semibold text-gray-800 lg:flex lg:pt-0"
                style="list-style: none;">
                <li><a href="#"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen">Anunturi</a>
                </li>
                <li><a href="#"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen">Oferte</a>
                </li>
                <li><a href="#"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen">Despre
                        noi</a></li>
                <li><a href="/contact"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
