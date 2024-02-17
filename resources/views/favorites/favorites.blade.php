<x-layout>
    <div class="py-6 mx-auto lg:py-20 md:py-14 max-w-7xl">
        <h2 class="px-2 mb-4 text-center text-economic-darkgreen md:px-12">Lista mea de favorite</h2>

        @if (count($favoritesItems) > 0)
            <div class="grid grid-cols-1 gap-4 px-4 py-6 mx-auto md:px-12">
                @foreach ($favoritesItems as $favoriteItem)
                    <div
                        class="flex flex-col md:flex-row items-center justify-between p-4 mb-4 bg-light rounded-lg shadow-lg transition duration-300 hover:shadow-xl text-economic-darkgreen">
                        <div class="flex items-center">
                            <img src="{{ $favoriteItem->product->image('picture') }}"
                                alt="{{ $favoriteItem->product->title }}" class="block w-16 md:w-24 mr-4" />
                            <p class="text-lg font-semibold">{{ $favoriteItem->product->title }}</p>
                        </div>
                        <div class="flex items-center">
                            <form action="{{ route('favorites.destroy', $favoriteItem->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-4"><i class="fa-solid fa-trash text-2xl transition duration-300 hover:scale-110"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-lg text-gray-500">Lista ta de favorite este goală.</p>
        @endif
    </div>

    @if (session('success'))
        <x-flash-message type="success" :message="session('success')" />
    @endif
</x-layout>
