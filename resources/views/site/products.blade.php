{{-- products.blade.php --}}

<title>{{ $tag->name }}</title>

<x-layout>

    <div class="py-6 mx-auto lg:py-20 md:py-14">

        {{-- Breadcrumb --}}
        <nav class="flex flex-wrap gap-2 px-4 py-2 mb-4 bg-gray-100 md:px-12 text-economic-darkgray"
            aria-label="Breadcrumb">
            <a href="/" class="transition hover:text-black"><i class="fa fa-home" aria-hidden="true"></i>
                Pagina principala / </a>
            <a href="{{ url('/products/' . $tag->slug) }}" class="font-semibold transition hover:text-black">
                {{ $tag->name }}
            </a>
        </nav>

        <h2 class="px-2 mb-4 text-center text-economic-darkgreen md:px-12">{!! $tag->name !!}</h3>

            <div
                class="grid grid-cols-1 gap-4 px-4 py-6 mx-auto sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 md:px-12 ">
                @forelse ($products as $product)
                    <form method="post" action="{{ route('cart.store') }}" class="product-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div
                            class="relative w-full mx-auto mb-6 overflow-hidden font-semibold text-center transition-transform duration-300 transform rounded-lg shadow-lg text-economic-darkgreen bg-light md:max-w-sm hover:shadow-xl hover:scale-105 flex flex-col justify-between h-full gap-4">
                            <a href="{{ route('product', ['slug' => $product->slug]) }}">
                                <img src="{{ $product->image('picture') }}" alt="{{ $product->title }}"
                                    class="block object-contain w-full h-auto mb-4 max-h-60" />
                                <p class="p-4 text-lg font-semibold">{{ $product->title }}</p>
                            </a>
                            <button
                                class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-darkgreen w-fit mx-auto transition border border-economic-darkgreen addToCartBtn"><svg
                                    height="26px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20h44v44c0 11 9 20 20 20s20-9 20-20V180h44c11 0 20-9 20-20s-9-20-20-20H356V96c0-11-9-20-20-20s-20 9-20 20v44H272c-11 0-20 9-20 20z" />

                                </svg>
                    </form></button>
            </div>
        @empty
            <p class="text-center text-gray-500 col-span-full">Nu există produse pentru această categorie.</p>
            @endforelse
    </div>

    {{ $products->links('vendor.pagination.tailwind') }}

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
