{{-- products.blade.php --}}

<title>{{ $tag->name }}</title>

<x-layout>

    <div class="py-6 mx-auto lg:py-20 md:py-14 max-w-[1500px]">

        {{-- Breadcrumb --}}
        <nav class="flex flex-wrap gap-2 px-4 py-2 mb-4 md:px-12 text-economic-darkgray" aria-label="Breadcrumb">
            <a href="/" class="transition hover:text-black"><i class="fa fa-home" aria-hidden="true"></i>
                Pagina principala / </a>
            <a href="{{ url('/products/' . $tag->slug) }}" class="font-semibold transition hover:text-black">
                {{ $tag->name }}
            </a>
        </nav>

        <h2 class="px-2 mb-4 text-center text-economic-darkgreen md:px-12">{!! $tag->name !!}</h2>

        <div
            class="grid grid-cols-1 gap-4 px-4 py-6 mx-auto sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 md:px-12 ">
            @forelse ($products as $product)
                <div
                    class="relative w-full mx-auto mb-6 overflow-hidden font-semibold text-center transition-transform duration-300 transform rounded-lg shadow-lg text-economic-darkgreen bg-light md:max-w-sm hover:shadow-xl hover:scale-105 flex flex-col justify-between h-full gap-4">
                    <a href="{{ route('product', ['slug' => $product->slug]) }}">
                        <img src="{{ $product->image('picture') }}" alt="{{ $product->title }}"
                            class="block object-contain w-full h-auto mb-4 max-h-60" />
                        <p class="p-4 text-lg font-semibold">{{ $product->title }}</p>
                    </a>
                    <div class="flex gap-2 justify-center items-center">
                        <form method="post" action="{{ route('cart.store') }}" class="product-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button
                                class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md  w-fit mx-auto text-3xl hover:scale-125 transition"><i
                                    class="fa-solid fa-cart-plus"></i>
                            </button>
                        </form>
                        @if (auth()->check() && $favorites && $favorites->contains('product_id', $product->id))
                        @foreach ($favorites as $favorite)
                                @if ($favorite->product_id === $product->id)
                                    <form method="post" action="{{ route('favorites.destroy', $favorite->id) }}"
                                        class="product-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md text-economic-red hover:scale-125 mx-auto text-3xl transition">
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                    </form>
                                @endif
                            @endforeach
                        @else
                            <form method="post" action="{{ route('favorites.store') }}" class="product-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit"
                                    class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md text-economic-red hover:scale-125 mx-auto text-3xl transition"><i
                                        class="fa-regular fa-heart"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

            @empty
                <p class="text-center text-gray-500 col-span-full">Nu există produse pentru această categorie.</p>
            @endforelse
        </div>
    </div>

    {{ $products->links('vendor.pagination.tailwind') }}

    </div>

    @if (session('success'))
        <x-flash-message type="success" :message="session('success')" />
    @endif

    @if (session('error'))
        <x-flash-message type="error" :message="session('error')" />
    @endif

</x-layout>
