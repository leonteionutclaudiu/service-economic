<swiper-slide class="relative">
    <img style="width: 100%; object-fit: contain; " src="{{ $block->image('16/9', '16/9') }}" class="bg-white" />

    <div class="absolute inset-0 flex flex-col items-center justify-center">
        <h2 class="font-bold
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
        <a href="{{ $block->content['link'] }}"
            class="inline-block px-4 py-2 mt-4 text-white transition duration-500 ease-in-out rounded-md bg-economic-darkgreen hover:bg-economic-lightgreen">
            Afla mai multe &rarr;
        </a>
    </div>
</swiper-slide>
