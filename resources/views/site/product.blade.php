{{-- product.blade.php --}}

<title>{{ $product->title }}</title>

<x-layout>

    <style>
        swiper-container {
            width: 100%;
            height: 100%;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: block;
            width: 100%;
            /* height: 100%; */
            object-fit: cover;
        }

        swiper-container {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .mySwiper {
            height: fit-content;
            width: 100%;
        }

        .mySwiper2 {
            margin: 0 auto;
            max-width: 950px;
            height: 20vh;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .mySwiper2 swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper2 .swiper-slide-thumb-active {
            opacity: 1;
        }


        .content {
            transition: opacity 0.5s ease-in-out;
        }

        .content.opacity-0 {
            opacity: 0;
        }

        .tab-button {
            padding: 10px;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .active-button {
            color: #e45d50;
            border-bottom: 2px solid #e45d50;
        }

        .inactive-button {
            color: #000;
        }

        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            padding: 10px;
            color: #004994;
            border: 1px solid #ddd;
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>

    <div class="py-6 mx-auto lg:py-20 md:py-14">

        {{-- Breadcrumb --}}
        <nav class="flex flex-wrap gap-2 px-4 py-2 mb-4 md:px-12 text-economic-darkgray" aria-label="Breadcrumb">
            <a href="/" class="transition hover:text-black"><i class="fa fa-home" aria-hidden="true"></i>
                Pagina principala / </a>
            @foreach ($product->tags as $index => $tag)
                <a href="{{ url('/products/' . $tag->slug) }}" class="transition hover:text-black">
                    {{ $tag->name }}
                </a>

                @if ($index < count($product->tags) - 1)
                    ,
                @endif
            @endforeach
            <a href="{{ url('/products/' . $product->tags[0]->slug) }}"
                class="font-semibold transition hover:text-black">
                / {{ $product->title }}
            </a>
        </nav>

        <h2 class="mb-10 text-center text-economic-darkgreen max-w-[40ch] mx-auto px-2
        md:px-12">
            {{ $product->title }}</h2>

        <div class="justify-center px-2 md:px-12 max-w-[1500px] mx-auto relative">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 md:col-span-10">
                    <swiper-container class="mySwiper" thumbs-swiper=".mySwiper2" space-between="10">
                        @foreach ($product->medias as $index => $imagine)
                            <swiper-slide>
                                <div {{-- href="/img/{{ $imagine->uuid }}" class="full-screen-image"
                                    data-caption="{{ $product->title }}" --}}>
                                    <img style="width: 100vw; max-height: 60vh; object-fit: contain; display: block;"
                                        src="/img/{{ $imagine->uuid }}" alt="{{ $product->title }}" />
                                </div>
                            </swiper-slide>
                        @endforeach

                    </swiper-container>

                    <swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true"
                        watch-slides-progress="true" scrollbar-hide="false">
                        @foreach ($product->medias as $imagine)
                            <swiper-slide>
                                <img style="width: 100vw; height:100%; max-height: 60vh; object-fit: contain; display: block; cursor:pointer;"
                                    src="/img/{{ $imagine->uuid }}" alt="{{ $product->title }}" />
                            </swiper-slide>
                        @endforeach
                    </swiper-container>
                </div>
                <div class="hidden md:block sticky right-0 top-[100px] h-fit col-span-2">
                    <form method="post" action="{{ route('cart.store') }}" class="product-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button
                            class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-darkgreen text-white mx-auto transition border border-economic-darkgreen w-full addToCartBtn"><span
                                class="hidden md:block">Adauga in cos</span><svg height="26px"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path
                                    d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20h44v44c0 11 9 20 20 20s20-9 20-20V180h44c11 0 20-9 20-20s-9-20-20-20H356V96c0-11-9-20-20-20s-20 9-20 20v44H272c-11 0-20 9-20 20z" />

                            </svg>
                        </button>
                    </form>
                    @if ($favorite)
                    <form method="post" action="{{ route('favorites.destroy', $favorite->id) }}" class="product-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-red text-white mx-auto transition border border-economic-red w-full addToFavoriteBtn"><span
                                class="hidden md:block">Șterge din favorite</span><svg height="26px"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                            </svg>
                        </button>
                    </form>
                @else
                    <form method="post" action="{{ route('favorites.store') }}" class="product-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                            class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-red text-white mx-auto transition border border-economic-red w-full addToFavoriteBtn"><span
                                class="hidden md:block">Adauga la favorite</span><svg height="26px"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                            </svg>
                        </button>
                    </form>
                @endif
                </div>
            </div>

            <div class="block md:hidden">
                <form method="post" action="{{ route('cart.store') }}" class="product-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button
                        class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-darkgreen text-white mx-auto transition border border-economic-darkgreen w-full addToCartBtn"><span>Adauga
                            in cos</span><svg height="26px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path
                                d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20h44v44c0 11 9 20 20 20s20-9 20-20V180h44c11 0 20-9 20-20s-9-20-20-20H356V96c0-11-9-20-20-20s-20 9-20 20v44H272c-11 0-20 9-20 20z" />

                        </svg>
                    </button>
                </form>
                <button
                    class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-red text-white mx-auto transition border border-economic-red w-full addToFavoriteBtn"><span>Adauga
                        la favorite</span><svg height="26px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                    </svg>
                </button>
            </div>

            <div class="mx-auto mt-10 text-lg max-w-[75ch] md:text-xl">{!! $product->description !!}</div>
            <a href="/contact"
                class="block px-8 py-4 mx-auto mt-6 font-semibold text-white uppercase transition duration-500 ease-in-out transform rounded-full cursor-pointer w-fit bg-economic-red hover:scale-105 hover:bg-black hover:border-economic-green">
                Vreau o oferta
            </a>

            <div class="px-2 divide-y divide-economic-red md:px-12">
                <div
                    class="flex flex-col items-center justify-center mx-auto mt-10 text-xl border border-b-0 border-l-0 border-r-0 divide-x-0 lg:divide-x lg:flex-row border-economic-red divide-economic-red w-fit">
                    @php
                        $modeleContent = strip_tags($product->modele);
                    @endphp
                    @if (!empty($modeleContent) && trim($modeleContent) !== '')
                        <button onclick="showContent('modele', this)"
                            class="p-2 font-bold text-black transition ease-in-out hover:text-economic-red tab-button active-button">Modele
                            si specificatii tehnice</button>
                    @endif
                    @php
                        $caracteristiciContent = strip_tags($product->caracteristici);
                    @endphp
                    @if (!empty($caracteristiciContent) && trim($caracteristiciContent) !== '')
                        <button onclick="showContent('caracteristici', this)"
                            class="p-2 font-bold text-black transition duration-500 ease-in-out hover:text-economic-red tab-button inactive-button">Caracteristici</button>
                    @endif
                    @php
                        $avantajeContent = strip_tags($product->avantaje);
                    @endphp
                    @if (!empty($avantajeContent) && trim($avantajeContent) !== '')
                        <button onclick="showContent('avantaje', this)"
                            class="p-2 font-bold text-black transition duration-500 ease-in-out hover:text-economic-red tab-button inactive-button">Avantaje</button>
                    @endif
                    @if ($product->files->isNotEmpty())
                        <button onclick="showContent('brosuri', this)"
                            class="p-2 font-bold text-black transition duration-500 ease-in-out hover:text-economic-red tab-button inactive-button">Documente</button>
                    @endif

                </div>
                <div class="text-xl text-economic-darkgreen">
                    <div id="modele" class="hidden pt-6 mx-auto overflow-x-auto w-fit max-w-[90vw] content">
                        {!! $product->modele !!}</div>

                    <div id="caracteristici" class="hidden pt-6 mx-auto overflow-x-auto w-fit max-w-[90vw] content">
                        {!! $product->caracteristici !!}</div>

                    <div id="avantaje" class="hidden pt-6 mx-auto overflow-x-auto w-fit max-w-[90vw] content">
                        {!! $product->avantaje !!}</div>

                    <div id="brosuri" class="hidden pt-6 mx-auto overflow-x-auto w-fit max-w-[90vw] content">
                        <div class="flex flex-wrap items-center justify-center gap-10">
                            @foreach ($product->files as $file)
                                @php
                                    $fileInfo = pathinfo($file->filename);
                                    $fileExtension = strtolower($fileInfo['extension']);
                                @endphp

                                @if (
                                    !in_array($fileExtension, [
                                        'mp4',
                                        'webm',
                                        'ogg',
                                        'avi',
                                        'mov',
                                        'flv',
                                        'mkv',
                                        'wmv',
                                        'mpeg',
                                        'mpg',
                                        '3gp',
                                        'asf',
                                        'm4v',
                                        'm2v',
                                    ]))
                                    <a href="{{ asset('storage/uploads/' . $file->uuid) }}" download
                                        class="block mb-2 transition text-economic-darkgreen hover:text-economic-green hover:underline">
                                        <i class="mr-2 fas fa-download"></i>{{ $file->filename }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            <div class="px-2 mx-auto mt-14 md:px-12 w-fit">
                @foreach ($product->files as $file)
                    @php
                        $fileInfo = pathinfo($file->filename);
                        $fileExtension = strtolower($fileInfo['extension']);
                    @endphp

                    @if (in_array($fileExtension, [
                            'mp4',
                            'webm',
                            'ogg',
                            'avi',
                            'mov',
                            'flv',
                            'mkv',
                            'wmv',
                            'mpeg',
                            'mpg',
                            '3gp',
                            'asf',
                            'm4v',
                            'm2v',
                        ]))
                        <div class="video-container w-full max-w-[1500px]">
                            <video width="100%" height="auto" controls>
                                <source src="{{ asset('storage/uploads/' . $file->uuid) }}"
                                    type="video/{{ $fileExtension }}">
                                Browser-ul tau nu suporta elementul video.
                            </video>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="px-2 mx-auto mt-14 md:px-12">
                <p class="font-semibold text-center">Din categoriile:</p>
                <div class="flex flex-wrap items-center justify-center gap-2 mt-2">
                    @foreach ($product->tags as $tag)
                        <a href="{{ url('/products/' . $tag->slug) }}"
                            class="p-2 mb-2 mr-2 text-white transition rounded bg-economic-darkgreen hover:bg-economic-red">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>

            @if (session('success'))
                <x-flash-message type="success" :message="session('success')" />
            @endif
            @if (session('error'))
                <x-flash-message type="error" :message="session('error')" />
            @endif
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const firstButton = document.querySelector('.tab-button:first-child');

                if (firstButton) {
                    firstButton.click();
                }
            });

            function showContent(contentId, buttonElement) {
                const allContents = document.querySelectorAll('.content');
                const allButtons = document.querySelectorAll('.tab-button');

                allContents.forEach(content => {
                    content.classList.remove('active');
                    content.classList.add('hidden');
                    content.classList.add('opacity-0');
                });

                allButtons.forEach(button => {
                    button.classList.remove('active-button');
                    button.classList.add('inactive-button');
                });

                const activeContent = document.getElementById(contentId);

                if (activeContent) {
                    activeContent.classList.remove('hidden');
                    activeContent.classList.add('active');

                    void activeContent.offsetWidth;
                    activeContent.classList.remove('opacity-0');

                    buttonElement.classList.remove('inactive-button');
                    buttonElement.classList.add('active-button');
                }
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const firstButton = document.querySelector('.tab-button:first-child');

                if (firstButton) {
                    firstButton.click();
                }

                baguetteBox.run('.full-screen-image', {
                    captions: true,
                    noScrollbars: true,
                });

                document.addEventListener('baguetteBox:afterShow', function() {
                    swiper.autoplay.stop();
                });

                document.addEventListener('baguetteBox:afterHide', function() {
                    swiper.autoplay.start();
                });
            });
        </script>


</x-layout>
