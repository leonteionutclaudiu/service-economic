<x-layout>

    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14 max-w-[1500px]">
        {!! $item->renderBlocks() !!}

        @if (session('success'))
            <x-flash-message type="success" :message="session('success')" />
        @endif
    </div>

</x-layout>
