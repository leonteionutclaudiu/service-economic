{{-- layout.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Service Economic Trade</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    @vite('resources/js/app.js')
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('preloader').style.display = 'none';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.1/dist/baguetteBox.min.js" async></script>
    <link href="
https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.1/dist/baguetteBox.min.css
" rel="stylesheet">
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" /> --}}
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>

</head>

<body x-data="{ isVisible: false, scrollToTop: function() { window.scrollTo({ top: 0, behavior: 'smooth' }); } }" @scroll.window="isVisible = window.scrollY > 100">
    <!-- header/navigation -->
    <div class="min-h-screen flex flex-col justify-between">

        @include('partials.header')

        <main class="mt-20 lg:mt-12 md:mt-14">

            {{--  preloader --}}
            <div class="fixed top-0 left-0 w-full h-full bg-white flex justify-center items-center z-[9999]"
                id="preloader">
                <img src="{{ asset('images/preloader.gif') }}" alt="Preloader">
            </div>

            {{ $slot }}
        </main>

        {{-- footer --}}
        @include('partials.footer')

        {{-- scroll to top button --}}
        @include('components.scrollToTopBtn')
    </div>

    {{-- VANILLA TILT JS IMPORT CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"
        integrity="sha512-wC/cunGGDjXSl9OHUH0RuqSyW4YNLlsPwhcLxwWW1CR4OeC2E1xpcdZz2DeQkEmums41laI+eGMw95IJ15SS3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.babel.js"
        integrity="sha512-ZAvevQxALZBNwEI5fZU3eeyF/GkebNgShMzzHELv8zG/Jk19BlgdLhSl3N8VU11O8epHBrOizz64OFbYDGGlaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.babel.min.js"
        integrity="sha512-DQKpLk1v945t4NI9BtySf4X0WijLvw9HsX7Le0aFkJd9rF+Rz8Dua+ItWSzs2hf/LHAxlH4MKVYoRRjuHiBOgg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.js"
        integrity="sha512-0eckjEcIDNlyXFNRAL2Kecw71G5Df+nI2kazjvQrH/DZEHYOdy0UnP0gAlQGZMq4ZOOHpc2eYG15N3JZDA6pGg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src='https://www.google.com/recaptcha/api.js'></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

</body>

</html>
