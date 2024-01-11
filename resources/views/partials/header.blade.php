<header x-data="{ open: false }" class="bg-white shadow-lg">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <a href="#" class="text-2xl font-bold text-gray-800">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-auto" />
        </a>

        <!-- Butonul de meniu pentru dispozitivele mici -->
        <button @click="open = !open" class="lg:hidden focus:outline-none">
            <!-- Iconița hamburger pentru meniu -->
            <i x-show="!open" class="fas fa-bars text-gray-800 text-2xl"></i>
            <!-- Iconița pentru închiderea meniului -->
            <i x-show="open" @click.away="open = false" class="fas fa-times text-gray-800 text-2xl"></i>
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
                    class="absolute inline-block text-gray-700 transition md:hidden md:right-10 md:top-10 top-4 right-4 hover:text-radacini-pur hover:scale-125"
                    @click="isOpen = false">
                    <i class="text-2xl fas fa-times"></i>
                </button>
            </div>
            <div class="">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-auto" />
                <ul class="text-center" style="list-style: none;">
                    <li><a href="#" class="block py-3 hover:text-blue-500 transition duration-300">Anunturi</a>
                    </li>
                    <li><a href="#" class="block py-3 hover:text-blue-500 transition duration-300">Oferte</a></li>
                    <li><a href="#" class="block py-3 hover:text-blue-500 transition duration-300">Despre noi</a>
                    </li>
                    <li><a href="#" class="block py-3 hover:text-blue-500 transition duration-300">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Meniul pentru dispozitivele mari -->
        <nav id="mainMenu" class="hidden lg:block lg:ml-auto">
            <ul class="lg:flex items-center justify-end text-lg font-semibold text-gray-800 pt-4 lg:pt-0" style="list-style: none;">
                <li><a href="#"
                        class="lg:px-4 py-2 block hover:text-blue-500 transition duration-300">Anunturi</a>
                </li>
                <li><a href="#" class="lg:px-4 py-2 block hover:text-blue-500 transition duration-300">Oferte</a>
                </li>
                <li><a href="#" class="lg:px-4 py-2 block hover:text-blue-500 transition duration-300">Despre
                        noi</a></li>
                <li><a href="#" class="lg:px-4 py-2 block hover:text-blue-500 transition duration-300">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
