<x-layout>
    <div class="py-6 mx-auto lg:py-20 md:py-14">
        <h2 class="px-2 mb-4 text-center text-economic-darkgreen md:px-12">Coșul meu</h2>

        @if (count($cartItems) > 0)
            <div class="grid grid-cols-1 gap-4 px-4 py-6 mx-auto md:px-12">
                @foreach ($cartItems as $cartItem)
                    <div
                        class="flex flex-col items-center justify-between p-4 mb-4 bg-light rounded-lg shadow-lg text-economic-darkgreen">
                        <div class="flex items-center">
                            <img src="{{ $cartItem->product->image('picture') }}" alt="{{ $cartItem->product->title }}"
                                class="block object-contain w-16 h-16 mr-4" />
                            <p class="text-lg font-semibold">{{ $cartItem->product->title }}</p>
                        </div>
                        <div class="flex items-center">
                            <form action="{{ route('cart.update', $cartItem->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1"
                                    class="w-12 text-center mr-4">
                                <button type="submit" class="text-economic-darkgreen hover:text-black">Actualizare
                                    cantitate</button>
                            </form>
                            <form action="{{ route('cart.destroy', $cartItem->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-4">Șterge</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end px-4 md:px-12">
                <a href="#"
                    class="px-6 py-2 text-lg font-semibold text-white bg-economic-darkgreen rounded-md hover:bg-opacity-80">
                    Către plată
                </a>
            </div>
        @else
            <p class="text-center text-lg text-gray-500">Coșul tău de cumpărături este gol.</p>
        @endif
    </div>

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 7000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="fixed top-28 left-2 flex items-center p-4 mb-4 text-lg text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 z-[999]"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                {{ session('success') }}
            </div>
        </div>
    @endif
</x-layout>
