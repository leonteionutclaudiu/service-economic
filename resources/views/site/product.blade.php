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

    <div class="py-6 mx-auto lg:py-20 md:py-14 max-w-[1500px]">

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
                                class="hidden md:block">Adauga in cos</span><i
                                class="fa-solid fa-cart-plus text-xl"></i>
                        </button>
                    </form>
                    @if ($favorite)
                        <form method="post" action="{{ route('favorites.destroy', $favorite->id) }}"
                            class="product-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-red text-white mx-auto transition border border-economic-red w-full addToFavoriteBtn"><span
                                    class="hidden md:block">Sterge din favorite</span><i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                    @else
                        <form method="post" action="{{ route('favorites.store') }}" class="product-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit"
                                class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-red text-white mx-auto transition border border-economic-red w-full addToFavoriteBtn"><span
                                    class="hidden md:block">Adauga la favorite</span><i class="fa-regular fa-heart"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="flex gap-2 items-center w-full md:hidden">
                <form method="post" action="{{ route('cart.store') }}" class="product-form w-full">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button
                        class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-darkgreen text-white mx-auto transition border border-economic-darkgreen w-full addToCartBtn"><span>Adauga
                            in cos</span><i class="fa-solid fa-cart-plus text-xl"></i>
                    </button>
                </form>
                @if ($favorite)
                    <form method="post" action="{{ route('favorites.destroy', $favorite->id) }}" class="product-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md bg-economic-red text-white mx-auto transition border border-economic-red w-full text-2xl hover:text-economic-red hover:bg-white addToFavoriteBtn"><i
                                class="fa-solid fa-heart"></i>
                        </button>
                    </form>
                @else
                    <form method="post" action="{{ route('favorites.store') }}" class="product-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                            class="flex items-center justify-center gap-2 mb-2 p-2 rounded-md  mx-auto transition border border-economic-red text-economic-red w-full text-2xl hover:bg-economic-red hover:text-white addToFavoriteBtn"><i
                                class="fa-regular fa-heart"></i>
                        </button>
                    </form>
                @endif
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
