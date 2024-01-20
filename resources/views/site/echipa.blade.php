<title>Service Economic Trade - Echipa</title>

<x-layout>

    <style>
        .card-container:hover .name,
        .card-container:hover .function {
            display: none;
        }
    </style>

    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14 shadow-md">
        {!! $item->renderBlocks() !!}
    </div>

</x-layout>
