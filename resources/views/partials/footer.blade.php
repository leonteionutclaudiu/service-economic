{{-- footer --}}
<style>
    .max-width-1500 {
        max-width: 1500px;
    }
</style>

<footer
    class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14 bg-black text-center md:text-start w-full">
    <div
        class="max-w-[1500px] mx-auto flex flex-col items-center justify-evenly gap-10 mb-8 md:flex-row md:items-start">
        <div>
            <p class="mb-4 text-xl font-bold text-economic-darkgreen">Utile</p>
            <div class="flex flex-col items-center gap-2 text-gray-300 md:items-start">
                <a href="/articole" class="transition w-fit hover:text-economic-darkgreen">Articole</a>
                <a href="/produse" class="transition w-fit hover:text-economic-darkgreen">Produse</a>
                <a href="/despre-noi" class="transition w-fit hover:text-economic-darkgreen">Despre noi</a>
                <a href="/contact" class="transition w-fit hover:text-economic-darkgreen">Contact</a>
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
            </div>
        </div>
        <div>
            <p class="mb-4 text-xl font-bold text-economic-darkgreen">
                Ne găsești aici:</p>
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
        © Service Economic Trade <span id="currentYear"></span>. Toate drepturile rezervate
    </div>
    <div class="text-center text-gray-400">
        Aplicatie web realizata de Leonte Ionut-Claudiu
    </div>
</footer>

<script>
    // Get the current year and update the footer
    let currentYear = new Date().getFullYear();
    document.getElementById('currentYear').textContent = currentYear;
</script>
