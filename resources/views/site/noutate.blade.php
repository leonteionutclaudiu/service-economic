{{-- noutate.blade.php --}}

<title>Service Economic Trade - {{ $item->title }}</title>

<x-layout>

    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14 container">
        <h2 class="mb-6 text-center text-economic-darkgreen">{{ $item->title }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">

            <div class="{{ count($noutatiRelevante) > 0 ? 'col-span-4' : 'col-span-12' }}">
                <img src="{{ $item->image('picture_1') }}" alt="{{ $item->title }}" class="mb-6"
                    style="width: 100vw; max-height: 60vh; object-fit: contain; display: block;" />
                <div class="max-w-[75ch] mx-auto mb-6">{!! $item->description !!}</div>

                {!! $item->renderBlocks() !!}
            </div>

            @if (count($noutatiRelevante) > 0)
                <div class="h-fit static md:sticky md:top-[100px] md:right-0">
                    <!-- articole recomandate -->
                    <h6 class="text-economic-gri">Articole recomandate</h6>
                    @foreach ($noutatiRelevante as $noutateRelevanta)
                        <a href="/articole/{{ $noutateRelevanta->slug }}"
                            class="shadow-md flex flex-col items-center justify-center gap-2 mb-3 rounded-md p-2 transition duration-300 hover:shadow-xl">
                            <img src="{{ $noutateRelevanta->image('picture_1') }}" alt="{{ $noutateRelevanta->title }}"
                                class="w-full max-w-40" />
                            <h4 class="text-economic-darkgreen text-base">{{ $noutateRelevanta->title }}</h4>
                            <p>{{ $noutateRelevanta->content }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</x-layout>
