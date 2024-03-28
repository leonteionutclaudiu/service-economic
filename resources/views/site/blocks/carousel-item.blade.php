<swiper-slide class="relative">
    <img style="width: 100%; object-fit: contain; filter:brightness(0.7);" src="{{ $block->image('3/1', '3/1') }}"
        class="bg-white" />

    <div class="absolute inset-0 flex flex-col items-center justify-center">
        @if (isset($block->content['description']) && !empty($block->content['description']))
            <h2 class="font-bold text-xs md:text-2xl
            @if ($block->content['color'] === 'white') text-white
            @elseif ($block->content['color'] === 'black')
                text-black
            @elseif ($block->content['color'] === 'green')
                text-economic-darkgreen @endif
        "
                style="@if ($block->content['color'] === 'white') text-shadow: 2px 2px 4px black;
            @elseif ($block->content['color'] === 'black')
            text-shadow: 2px 2px 4px white;
            @elseif ($block->content['color'] === 'green')
            text-shadow: 2px 2px 4px white; @endif">
                {{ $block->content['description'] }}
            </h2>
        @endif
        @if (isset($block->content['link']) && !empty($block->content['link']))
            <a href="{{ $block->content['link'] }}"
                class="inline-block px-2 py-1 md:px-4 md:py-2 md:mt-4 text-white transition duration-500 ease-in-out rounded-md bg-economic-darkgreen hover:bg-[#01a144] text-xs md:text-2xl">
                Mai multe detalii &rarr;
            </a>
        @endif
    </div>
</swiper-slide>
