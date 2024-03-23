<!-- Toggle button -->
<div class="fixed bottom-10 left-0 md:left-8 z-10">
    <div class="relative w-[76px]">
        <button @click="contactOpen = !contactOpen" :class="{ 'bg-stone-900 hover:bg-stone-700': contactOpen }"
            class="bg-economic-darkgreen hover:bg-economic-lightgreen active:bg-economic-red transition  text-white p-4 rounded-full focus:outline-none block mx-auto h-14 w-14 shadow-sm">
            <i class="fas fa-comment fa-lg"></i>
            <!-- Mic cerc pentru indicarea stării -->
            <div x-data="{ currentTime: new Date() }" class="absolute top-0 right-0 w-4 h-4 rounded-full border-2 border-white"></div>
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
    // Funcție pentru actualizarea culorilor în funcție de timp
    const currentTimeElement = document.querySelector('[x-data="{ currentTime: new Date() }"]');
    function updateColors() {
        console.log(currentTimeElement);
        const currentTime = new Date(new Date().toLocaleString("en-US", {timeZone: "Europe/Bucharest"}));
        const currentDay = currentTime.getDay(); // 0 = Duminică, 1 = Luni, ..., 6 = Sâmbătă
        const isWeekday = currentDay >= 1 && currentDay <= 5; // Verifică dacă este zi lucrătoare
        const isWorkHours = currentTime.getHours() >= 8 && currentTime.getHours() < 17; // Verifică dacă este în timpul programului de lucru (Luni-Vineri)
        const isSaturday = currentDay === 6; // Verifică dacă este Sâmbătă
        const isSaturdayWorkHours = isSaturday && currentTime.getHours() >= 8 && currentTime.getHours() < 14; // Verifică dacă este în timpul programului de lucru de Sâmbătă

        let isDayTime = false;

        if (isWeekday && isWorkHours) {
            isDayTime = true; // Programul de lucru de Luni-Vineri, între orele 8:00 și 17:00
        } else if (isSaturday && isSaturdayWorkHours) {
            isDayTime = true; // Programul de lucru de Sâmbătă, între orele 8:00 și 14:00
        }

        currentTimeElement.setAttribute('x-data', `{ currentTime: new Date('${currentTime.toISOString()}') }`);
        currentTimeElement.classList.toggle('bg-green-500', isDayTime);
        currentTimeElement.classList.toggle('bg-red-500', !isDayTime);
    }

    // Actualizează culorile la încărcarea completă a paginii
    window.addEventListener('DOMContentLoaded', updateColors);

    // Funcție pentru actualizarea culorilor la fiecare 30 de secunde
    setInterval(updateColors, 30000);
</script>
