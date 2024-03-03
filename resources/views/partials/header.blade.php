<script>
    document.addEventListener('DOMContentLoaded', function() {
        // fetch categories (product tags) when the page loads
        const dropdowns = document.querySelectorAll('.categoryDropdown');

        dropdowns.forEach(dropdown => {
            const loadingOption = document.createElement('a');
            loadingOption.textContent = 'Se incarca...';
            loadingOption.classList.add('block', 'px-4', 'py-2', 'text-base', 'text-gray-700');
            dropdown.appendChild(loadingOption);

            axios.get('/api/categories')
                .then(response => {
                    const categories = response.data.categories;

                    // Sort categories alphabetically by name
                    categories.sort((a, b) => a.name.localeCompare(b.name));

                    dropdown.removeChild(loadingOption);

                    // categories.forEach(category => {
                    Object.values(categories).forEach(category => {
                        const link = document.createElement('a');
                        link.href = '/products/' + category.slug;
                        link.textContent = category.name;
                        link.classList.add('block', 'px-4', 'py-2', 'text-base',
                            'text-gray-700',
                            'transition', 'hover:text-economic-darkgreen');
                        dropdown.appendChild(link);
                    });
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                });
        });

        // Fetch cart count when the page loads
        axios.get('/cart/count')
            .then(response => {
                const cartCount = response.data.count;
                updateCartCount(cartCount);
            })
            .catch(error => {
                console.error('Error fetching cart count:', error);
            });

        // Function to update the cart count
        function updateCartCount(count) {
            const cartCountElement = document.getElementById('cartCount');
            if (count > 0) {
                cartCountElement.textContent = count;
                cartCountElement.style.display = 'block';
            } else {
                cartCountElement.style.display = 'none';
            }
        }

        // Fetch favorites count when the page loads
        axios.get('/favorites/count')
            .then(response => {
                const favoritesCount = response.data.count;
                updateFavoritesCount(favoritesCount);
            })
            .catch(error => {
                console.error('Error fetching favorites count:', error);
            });
    });

    // Function to update the favorites count
    function updateFavoritesCount(count) {
        const favoritesCountElement = document.getElementById('favoritesCount');
        if (count > 0) {
            favoritesCountElement.textContent = count;
            favoritesCountElement.style.display = 'block';
        } else {
            favoritesCountElement.style.display = 'none';
        }
    }
</script>

<header x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-10 shadow-lg bg-[rgba(255,255,255,0.75)]"
    :class="{ 'backdrop-blur-md': open === false }">
    <div class="xl:container flex items-center justify-between px-6 py-4 lg:py-1 mx-auto">
        <a href="/" class="text-2xl font-bold text-gray-800">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 min-w-28 h-auto" />
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
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 min-w-28 h-auto" />
                </a>
                <ul class="text-center" style="list-style: none;">

                    @guest
                        <li><a href="/login"
                                class="block fixed top-4 left-0 right-0 w-fit mx-auto py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen text-black"><i
                                    class="fa-solid fa-user text-3xl"></i></a>
                        </li>
                    @endguest

                    @auth
                        <li>
                            <div class="fixed top-4 left-0 right-0 w-fit mx-auto sm:flex sm:items-center sm:ms-6">
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
                        </li>
                    @endauth

                    <li><a href="/noutati"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen text-black">Noutati</a>
                    </li>
                    <li> <x-nav-dropdown title="Produse" :toPages="['products']">
                            <div class="categoryDropdown"></div>
                        </x-nav-dropdown>
                    </li>
                    <li> <x-nav-dropdown title="Despre noi" :toPages="['echipa', 'cariera', 'despre-noi']">
                            <a href="/echipa"
                                class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen ">Echipa</a>
                            <a href="/cariera"
                                class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen ">Cariera</a>
                            <a href="/intrebari-frecvente"
                                class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Intrebari
                                frecvente
                            </a>
                            <a href="/despre-noi"
                                class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Despre
                            </a>
                        </x-nav-dropdown>
                    </li>
                    <li><a href="/contact"
                            class="block py-3 transition duration-300 hover:text-economic-darkgreen text-black">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Meniul pentru dispozitivele mari -->
        <nav id="mainMenu" class="hidden lg:flex flex-col">
            <ul class="items-center justify-end text-base flex-wrap font-semibold text-gray-800 lg:flex p-0"
                style="list-style: none;">
                <li class="mx-2">
                    <form method="GET" action="search" class="m-0">
                        <div class="relative">
                            <input type='text' name='search' placeholder='Cauta produse...'
                                class="min-w-44 text-sm xl:text-base pr-12 pl-4 py-2 rounded-lg focus:outline-none bg-gray-100 focus:ring-0 focus:border-0"
                                style="margin: 0; border:none;" />
                            <button type="submit"
                                class="absolute inset-y-0 right-0 flex items-center px-3 bg-gray-400 text-white hover:bg-economic-darkgreen transition duration-300 rounded-r-md">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
                <li>
                    <a href="/programare"
                        class="py-2 px-4 bg-economic-darkgreen text-white rounded-full transition hover:bg-black hover:text-white font-bold block text-center">Programare</a>
                </li>
                <li><a href="/articole"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen text-black">Articole</a>
                </li>
                <li><a href="/oferte"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgreen text-black">Oferte</a>
                </li>
                <li class="py-2 lg:px-4">
                    <div x-data="{ open: false }"
                        class="relative inline-block font-semibold text-left transition duration-300 transform z-10"
                        @mouseleave="open = false">
                        <button @mouseenter="open = true"
                            class="inline-flex items-center justify-center space-x-2 text-base font-semibold focus:outline-none {{ request()->is('products*') ? 'border-b-2 border-black' : 'custom-link' }} text-black hover:text-economic-darkgreen">
                            <span>Produse</span>
                            <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 transition-transform"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" @mouseenter="open = true" @mouseleave="open = false"
                            class="left-0 rounded-md w-56 origin-top-right bg-white shadow-xl lg:absolute categoryDropdown divide-y-2 divide-economic-darkgreen border border-economic-darkgreen z-10"
                            x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90" @click.away="open = false">

                        </div>
                    </div>
                </li>
                <li class="py-2 lg:px-4"> <x-nav-dropdown title="Despre noi" :toPages="['echipa', 'cariera', 'despre-noi']">
                        <a href="/echipa"
                            class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Echipa</a>
                        <a href="/cariera"
                            class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Cariera</a>
                        <a href="/intrebari-frecvente"
                            class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Intrebari
                            frecvente</a>
                        <a href="/despre-noi"
                            class="block px-4 py-2 text-base text-gray-700 transition hover:text-economic-darkgreen">Despre
                        </a>
                    </x-nav-dropdown></li>
                </li>

                <li><a href="/contact"
                        class="block py-2 transition duration-300 lg:px-4 hover:text-white hover:bg-economic-darkgreen hover:border-economic-darkgreen border border-economic-red bg-white text-economic-red rounded-full">Contact</a>
                </li>
                <div class="flex">

                    <li class="relative"><a href="/cart"
                            class="block py-2 transition duration-300 px-4 text-economic-darkgreen hover:text-economic-lightgreen">
                            <i class="fa-solid fa-cart-shopping text-2xl"></i>
                            <!-- Display the count dynamically -->
                            <span id="cartCount"
                                class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-1 text-xs"></span>
                        </a>
                    </li>
                    <li class="relative"><a href="/favorites"
                            class="block py-2 transition duration-300 px-4 text-economic-red hover:text-economic-orange">
                            <i class="fa-solid fa-heart text-2xl"></i>
                            <!-- Display the count dynamically -->
                            <span id="favoritesCount"
                                class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-1 text-xs"></span>
                        </a>
                    </li>
                </div>

                @guest
                    <li><a href="/login"
                            class="block py-2 transition duration-300 lg:px-4 hover:text-economic-darkgray text-black"><i
                                class="fa-solid fa-user text-2xl"></i></a>
                    </li>
                @endguest

                @auth
                    <li>
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
                                        <i class="fas fa-user mr-2"></i>{{ __('Profilul meu') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('profile.edit')">
                                        <i class="fa-solid fa-cubes"></i> {{ __('Comenzile mele') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i> {{ __('Ieși din cont') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </li>
                @endauth

            </ul>
            @role('admin')
                <div class="bg-red-500 text-white px-6 py-1">
                    <a href="/programari" class="text-lg">Programari</a>
                    <a href="/utilizatori" class="text-lg">Utilizatori</a>
                </div>
            @endrole
        </nav>
    </div>
</header>

@auth
    @if (auth()->user()->email_verified_at === null)
        <a href="/profile"
            class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-green-500 transition duration-300 ease-in-out fixed bottom-0 left-0 right-0 hover:text-black text-white text-center p-2 rounded z-50 ">
            <p class="text-sm">Vă rugăm să vă verificați adresa de e-mail pentru a accesa toate funcțiile aplicației. <div
                    class="w-fit">
                    <svg height='20px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z" />
                    </svg>
                </div>
            </p>
        </a>
    @endif
@endauth
