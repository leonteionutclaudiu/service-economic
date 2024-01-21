<div class="keen-slider__slide">
    <blockquote class="flex h-full flex-col justify-between bg-white p-6 shadow-sm sm:p-8 lg:p-12">
        <div>
            <div class="mt-4">
                <p class="text-2xl font-bold italic text-economic-darkgreen sm:text-3xl">&#8220; {!! $block->content['title'] !!} &#8220;</p>

                <p class="mt-4 leading-relaxed italic text-gray-700">
                    {!! $block->content['content'] !!}
                </p>
            </div>
        </div>

        <footer class="mt-4 text-sm font-medium text-gray-700 sm:mt-6">
            - {!! $block->content['name'] !!}
        </footer>
    </blockquote>
</div>
