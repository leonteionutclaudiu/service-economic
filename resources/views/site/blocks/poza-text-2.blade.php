<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 my-4">
    <div class="overflow-hidden transition duration-700 ease-in-out bg-white rounded shadow-md hover:shadow-xl h-fit">
        <img src="{{ $block->image('highlight', 'desktop') }}" alt="{{ env('APP_NAME') }}"
            class="w-full h-auto mx-auto transition duration-700 ease-in-out hover:scale-110 hover:brightness-90" />
    </div>

    <span class="block mb-4 text-start">{!! $block->content['text'] !!}</span>
</div>
