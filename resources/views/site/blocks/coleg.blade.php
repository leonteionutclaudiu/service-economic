<div
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
</style>
