<x-layout>
    <div class="py-6 mx-auto lg:py-20 md:py-14 max-w-7xl">
        <h2 class="px-2 mb-4 text-center text-economic-darkgreen md:px-12">Coșul meu</h2>

        @if (count($cartItems) > 0)
            <div class="grid grid-cols-1 gap-4 px-4 py-6 mx-auto md:px-12">
                @foreach ($cartItems as $cartItem)
                    <div
                        class="flex flex-col md:flex-row items-center justify-between p-4 mb-4 bg-light rounded-lg shadow-lg hover:shadow-xl transition duration-300 text-economic-darkgreen">
                        <div class="flex items-center mb-2">
                            <img src="{{ $cartItem->product->image('picture') }}" alt="{{ $cartItem->product->title }}"
                                class="block w-16 md:w-24 mr-4" />
                            <p class="text-lg font-semibold">{{ $cartItem->product->title }}</p>
                        </div>
                        <div class="flex items-end flex-col gap-2">
                            <form class="flex" action="{{ route('cart.update', $cartItem->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1"
                                    class="w-24 text-center mr-4 focus:ring-economic-darkgreen rounded-md">
                                <button type="submit"
                                    class="text-economic-darkgreen hover:text-black whitespace-nowrap">Actualizare
                                    cantitate</button>
                            </form>
                            <form action="{{ route('cart.destroy', $cartItem->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-4"><i
                                        class="fa-solid fa-trash text-2xl transition duration-300 hover:scale-110"></i></button>
                            </form>
                            <div>
                                <p class="font-bold text-lg">
                                    {{ $cartItem->product->price * $cartItem->quantity }} RON</p>
                                <p class="font-bold text-sm text-gray-500">
                                    {{ $cartItem->product->price }} RON / buc</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end px-4 md:px-12">
                <a href="#"
                    class="px-6 py-2 text-lg font-semibold text-white bg-economic-darkgreen rounded-md hover:bg-opacity-80">
                    Continuare
                </a>
            </div>
        @else
            <p class="text-center text-lg text-gray-500">Coșul tău de cumpărături este gol.</p>
        @endif
    </div>

    @if (session('success'))
        <x-flash-message type="success" :message="session('success')" />
    @endif
    @if (session('error'))
        <x-flash-message type="error" :message="session('error')" />
    @endif
</x-layout>
