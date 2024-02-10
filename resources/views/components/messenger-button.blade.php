@php
    $userVerified = Auth::user() ? Auth::user()->email_verified_at : null;
    $bottomClass = Auth::check() ? ($userVerified !== null ? 'bottom-0' : 'bottom-28 md:bottom-24') : 'bottom-12';
@endphp

<a class="block fixed left-2 {{ $bottomClass }} w-10 hover:scale-110 transition duration-300"
    href="https://m.me/232322009963477" target="_blank">
    <img src="{{ asset('images/messenger logo.png') }}" alt="messenger logo" /></a>
