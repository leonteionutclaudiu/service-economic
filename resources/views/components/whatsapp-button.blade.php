@php
    $userVerified = Auth::user() ? Auth::user()->email_verified_at : null;
    $bottomClass = Auth::check() ? ($userVerified !== null ? 'bottom-0' : 'bottom-16 md:bottom-10') : 'bottom-0';
@endphp

<a class="block fixed left-2 {{ $bottomClass }} w-10 hover:scale-105 transition duration-300"
    href=" https://wa.me/40726631691" target="_blank">
    <img src="{{ asset('images/whatsapp logo.png') }}" alt="whatsapp logo" /></a>
</a>
