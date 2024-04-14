{{-- Twill consider empty image field with this value : data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7 --}}

{{-- For image --}}
@if (
    $block->image('highlight', 'desktop') !=
        'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7')
    <a href="{{ $block->image('highlight', 'desktop') }}" data-ngthumb="{{ $block->image('highlight', 'desktop') }}">
    </a>
@endif

{{-- For video with thumbnail --}}
@if (
    $block->image('highlight', 'desktop') ==
        'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' &&
        $block->image('1', '1') != 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7')
    <a href="{{ asset('storage/uploads/' . $block->files[0]->uuid) }}" data-ngthumb="{{ $block->image('1', '1') }}">

    </a>
@endif

{{-- For video without thumbnail --}}
@if (
    $block->image('highlight', 'desktop') ==
        'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' &&
        $block->image('1', '1') == 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7')
    <a href="{{ asset('storage/uploads/' . $block->files[0]->uuid) }}"
        data-ngthumb="{{ asset('images/video placeholder.png') }}">

    </a>
@endif
