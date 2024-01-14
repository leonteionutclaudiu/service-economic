<div class="flex flex-col flex-wrap items-center justify-center gap-4 px-2 py-6 mx-auto lg:flex-row lg:gap-6">
    <div class="max-w-md overflow-hidden transition duration-700 ease-in-out bg-white rounded shadow-md hover:shadow-xl">
        <img src="{{ $block->image('highlight', 'desktop') }}" alt="{{ env('APP_NAME') }}"
            class="w-full h-auto max-w-xl mx-auto transition duration-700 ease-in-out max-h-fit hover:scale-110 hover:brightness-90" />
    </div>

    <span class="block mb-4 text-start max-w-[75ch] px-2">{!! $block->content['text'] !!}</span>
</div>
