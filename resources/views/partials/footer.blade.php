{{-- footer --}}
<footer class="px-2 py-6 mx-auto md:px-12 lg:py-10 bg-black text-center md:text-start w-full">
    <div class="max-w-7xl mx-auto flex flex-col items-center justify-evenly gap-10 mb-8 md:flex-row md:items-start">
        <div>
            <p class="mb-4 text-xl font-bold text-economic-darkgreen">Utile</p>
            <div class="flex flex-col items-center gap-2 text-gray-300 md:items-start">
                <a href="/intrebari-frecvente" class="transition w-fit hover:text-economic-darkgreen">Intrebari
                    frecvente</a>
                {{-- <a href="/produse" class="transition w-fit hover:text-economic-darkgreen">Produse</a> --}}
                <a href="/echipa" class="transition w-fit hover:text-economic-darkgreen">Echipa</a>
                <a href="/cariera" class="transition w-fit hover:text-economic-darkgreen">Cariera</a>
                <a href="/despre-noi" class="transition w-fit hover:text-economic-darkgreen">Despre noi</a>
                <p @click="contactModalForm = true"
                    class="transition w-fit hover:text-economic-darkgreen cursor-pointer">Contact</p>
                <a href="/articole" class="transition w-fit hover:text-economic-darkgreen">Articole</a>
            </div>
        </div>
        <div>
            <p class="mb-4 text-xl font-bold text-economic-darkgreen">Legal</p>
            <div class="flex flex-col items-center gap-2 text-gray-300 md:items-start">
                <a href="/termeni-si-conditii" class="transition w-fit hover:text-economic-darkgreen">Termeni si
                    conditii</a>
                <a href="/politica-de-confidentialitate" class="transition w-fit hover:text-economic-darkgreen">Politica
                    de
                    confidentialitate</a>
                <p class="text-economic-darkgray">Service Economic Trade S.R.L.
                </p>
                <p class="text-economic-darkgray">REG. COM.:
                    J40/10039/2023
                </p>
                <p class="text-economic-darkgray">CUI: RO 39431025
                </p>
            </div>
        </div>
        <div>
            <p class="mb-4 text-xl font-bold text-economic-darkgreen">
                Ne gasesti aici:</p>
            <div class="flex flex-col items-center gap-2 text-gray-300 md:items-start">
                <a class="transition w-fit hover:text-economic-darkgreen"
                    href='https://maps.app.goo.gl/WWbdhoGfniRpBjae6' target='_blank'><i class="fa fa-map-marker"></i>
                    Strada Valea Oltului 199-201 <br />
                    <span>Bucuresti

                    </span></a>
                <a href="tel:+40744322011"
                    class="flex items-center gap-1 transition w-fit hover:text-economic-darkgreen"><i
                        class="fa fa-phone"></i>
                    0744 322 011</a>
                <a href="mailto:office@serviceeconomic.ro"
                    class="flex items-center gap-1 transition w-fit hover:text-economic-darkgreen"><i
                        class="fa fa-envelope"></i>
                    office@serviceeconomic.ro</a>
                <div class="flex gap-4 justify-between items-center border rounded-2xl px-4 py-2">
                    <a href="https://www.facebook.com/profile.php?id=100090017734346" target="_blank">
                        <i
                            class="fa-brands fa-square-facebook text-2xl transition hover:scale-125 hover:text-economic-darkgreen"></i>
                    </a>
                    <a href="https://www.instagram.com/service.economic.trade/" target="_blank">
                        <i
                            class="fa-brands fa-square-instagram text-2xl transition hover:scale-125 hover:text-economic-darkgreen"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap items-center justify-center gap-2 mx-auto mb-8 w-fit">
        <a href="https://anpc.ro/ce-este-sal/" target="_blank">
            <img src="{{ asset('images/sal.png') }}"
                class="w-full max-w-[220px] transition border hover:border-economic-darkgreen rounded-2xl" />
        </a>
        <a href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home2.show&lng=RO" target="_blank">
            <img src="{{ asset('images/sol.png') }}"
                class="w-full max-w-[220px] transition border hover:border-economic-darkgreen rounded-2xl" />
        </a>
    </div>
    <div class="text-center text-gray-400">
        © Service Economic Trade <span id="currentYear">@php
            echo date('Y');
        @endphp</span>. Toate drepturile rezervate
    </div>
    <div class="text-center text-gray-400">
        Aplicatie web realizata de Leonte Ionut-Claudiu
    </div>
</footer>
