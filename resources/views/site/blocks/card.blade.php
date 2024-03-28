<div
    class="flex flex-col justify-between w-full p-4 mb-6 transition duration-500 ease-in-out bg-white rounded-md shadow-lg hover:shadow-2xl wow animate__animated animate__fadeIn">
    <div>
        <h4 class="mb-2 font-semibold text-center">{{ $block->content['description'] }}</h4>
        <img src="{{ $block->image('highlight', 'desktop') }}" alt="{{ env('APP_NAME') }}"
            class="object-contain w-full h-48 mb-2" />
    </div>
    <a href="{{ $block->content['link'] }}"
        class="inline-block px-4 py-2 mt-auto font-semibold transition duration-500 ease-in-out rounded-md w-fit hover:text-economic-orange text-economic-darkgreen">Mai
        multe &rarr;</a>
</div>
