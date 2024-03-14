{{-- noutati-all.blade.php --}}

<title>Service Economic Trade - Articole</title>

<x-layout>

    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14">

        <h2 class="text-center text-economic-darkgreen">Toate articolele</h2>

        <div class="grid grid-cols-1 gap-4 px-2 py-6 mx-auto sm:grid-cols-2 md:grid-cols-3 w-fit">
            @forelse ($noutati as $noutate)
                <a href="/articole/{{ $noutate->slug }}"
                    class="relative block w-[90vw] sm:w-full mx-auto mb-6 overflow-hidden transition-transform duration-300 transform bg-white rounded-lg shadow-lg md:max-w-sm hover:shadow-xl hover:scale-105">
                    <img src="{{ $noutate->image('picture_1') }}" class="object-contain object-center w-full h-48"
                        alt="{{ $noutate->title }}" />
                    <div class="px-6 py-4">
                        <h2 class="mb-2 text-xl font-semibold leading-tight text-economic-darkgreen">
                            {{ $noutate->title }}
                        </h2>
                        <div class="mb-6 text-economic-gri">
                            {!! $noutate->subtitle !!}
                        </div>
                        <p class="absolute bottom-0 right-0 px-2 py-1 font-bold text-economic-darkgreen">
                            Citeste mai mult &rarr;
                        </p>
                    </div>
                </a>
            @empty
                <p class="mx-auto text-center text-gray-700" style="grid-column-end: 3; ">Nu exista articole disponibile
                    in
                    acest
                    moment.</p>
            @endforelse
        </div>

        {{ $noutati->links('vendor.pagination.tailwind') }}

    </div>

</x-layout>
