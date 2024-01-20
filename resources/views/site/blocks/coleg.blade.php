{{-- <div
    class="shadow-md transition ease-in-out duration-300 hover:shadow-2xl max-w-64 w-fit rounded-md inline-block hover-effect">
    <div class="mb-6 overflow-hidden">
        <img src="{{ $block->image('1', '1') }}" alt="{{ env('APP_NAME') }}" style="width:256px;" class="transition duration-300 ease-in-out"/>
    </div>
    <div class="p-5">
        <p class="text-center font-bold text-xl text-economic-darkgreen">{!! $block->content['nume'] !!}</p>
        <p class="text-center text-economic-gri">{!! $block->content['functie'] !!}</p>
    </div>
</div>

<style>
    .hover-effect:hover img {
        transform: scale(1.05);
    }
</style> --}}

    <div class="group h-96 w-80 card-container mb-20">
        <div
            class="relative h-full w-full rounded-xl transition-all duration-500 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
            <div class="absolute inset-0">
                <img class="h-full w-full rounded-xl object-cover shadow-xl shadow-black/40"
                    src={{ $block->image('1','1') }}
                    alt="{{ env('APP_NAME') }}" />
                <p class="pt-2 name font-bold text-xl text-economic-darkgreen">{!! $block->content['nume'] !!}</p>
                <p class="text-lg function text-economic-gri">{!! $block->content['functie'] !!}</p>
            </div>
            <div
                class="h-full w-full rounded-xl bg-black/80 px-12 text-center text-slate-200 [transform:rotateY(180deg)] [backface-visibility:hidden]">
                <div class="flex min-h-full flex-col items-center justify-center">
                    <p class="text-base">{!! $block->content['descriere'] !!}</p>
                </div>
            </div>
        </div>
    </div>
