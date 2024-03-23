<!-- Toggle button -->
<div class="fixed bottom-10 left-0 md:left-8">
    <div class="relative w-[76px]">
        <button @click="contactOpen = !contactOpen"
            class="bg-economic-darkgreen hover:bg-economic-lightgreen active:bg-economic-red transition  text-white p-4 rounded-full shadow-lg focus:outline-none block mx-auto h-14 w-14">
            <i class="fas fa-comment fa-lg"></i>
            <!-- Mic cerc pentru indicarea stării -->
            <div x-data="{ currentTime: new Date() }" :class="{ 'bg-green-500': currentTime.getHours() >= 8 && currentTime.getHours() < 18, 'bg-red-500': currentTime.getHours() < 8 || currentTime.getHours() >= 18 }" class="absolute top-0 right-0 w-4 h-4 rounded-full border-2 border-white"></div>
        </button>

        <!-- Dropdown content -->
        <div x-show="contactOpen" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-[25%]" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-[25%]"
            @click.away="contactOpen = false" class="absolute bottom-full w-20 mt-2 mb-2">
            <div class="flex flex-col items-center gap-1 bg-gray-200 p-2 rounded-lg shadow-xl">
                <!-- WhatsApp button -->
                <a class="w-10 hover:scale-105 transition duration-300" href="https://wa.me/40726631691"
                    target="_blank">
                    <img src="{{ asset('images/whatsapp logo.png') }}" alt="whatsapp logo" />
                </a>
                <!-- Messenger button -->
                <a class="w-10 hover:scale-105 transition duration-300" href="https://m.me/232322009963477"
                    target="_blank">
                    <img src="{{ asset('images/messenger logo.png') }}" alt="messenger logo" />
                </a>
            </div>
        </div>
    </div>
</div>

<script defer>
    const currentTimeElement = document.querySelector('[x-data="{ currentTime: new Date() }"]');

    setInterval(() => {
        const currentTime = new Date(new Date().toLocaleString("en-US", {timeZone: "Europe/Bucharest"}));
        currentTimeElement.setAttribute('x-data', `{ currentTime: new Date('${currentTime.toISOString()}') }`);
        const isDayTime = currentTime.getHours() >= 8 && currentTime.getHours() < 18;
        currentTimeElement.classList.toggle('bg-green-500', isDayTime);
        currentTimeElement.classList.toggle('bg-red-500', !isDayTime);
    }, 30000); // Actualizează timpul la fiecare 30 secunde
</script>
