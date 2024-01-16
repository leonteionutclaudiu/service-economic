{{-- noutate.blade.php --}}

<title>Service Economic Trade - {{ $item->title }}</title>

<x-layout>

    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14">

        <h2 class="mb-6 text-center text-economic-darkgreen">{{ $item->title }}</h2>

        <img src="{{ $item->image('picture_1') }}" alt="{{ $item->title }}" class="mb-6"
            style="width: 100vw; max-height: 60vh; object-fit: contain; display: block;" />

        <div class="max-w-[75ch] mx-auto mb-6">{!! $item->description !!}</div>

        {!! $item->renderBlocks() !!}

    </div>

</x-layout>
