<!-- search-results.blade.php -->

<title>Rezultate pentru '{{ $searchInput }}'</title>

<x-layout>

    <div class="py-6 mx-auto lg:py-20 md:py-14 max-w-[1500px]">
        @if (session('error'))
            <div class="relative px-4 py-3 text-center text-red-700 bg-red-100 border border-red-400 rounded"
                role="alert">
                <strong class="font-bold">Eroare:</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @else
            <h2 class="px-2 mb-4 text-center text-economic-darkgreen md:px-12">Rezultate pentru '{{ $searchInput }}'</h2>

            <div
                class="grid grid-cols-1 gap-4 px-4 py-6 mx-auto sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 md:px-12">
                @forelse ($products as $product)
                    <a href="{{ route('product', ['slug' => $product->slug]) }}"
                        class="relative block w-full mx-auto mb-6 overflow-hidden font-semibold text-center transition-transform duration-300 transform rounded-lg shadow-lg text-economic-darkgreen bg-light md:max-w-sm hover:shadow-xl hover:scale-105">
                        <div class="flex flex-col justify-between h-full gap-4">
                            <img src="{{ $product->image('picture') }}" alt="{{ $product->title }}"
                                class="block object-contain w-full h-auto mb-4 max-h-60" />
                            <p class="p-4 text-lg font-semibold">{{ $product->title }}</p>
                        </div>
                    </a>
                @empty
                    <p class="mx-auto text-lg text-center text-gray-500 col-span-full">Nu exista rezultate pentru
                        cautarea dvs.
                    </p>
                @endforelse
            </div>

            {{ $products->links('vendor.pagination.tailwind') }}
        @endif
    </div>

</x-layout>
