{{-- dropdown.blade.php --}}

<div x-data="{ open: false }" class="relative inline-block text-left transition duration-300 transform"
    @mouseleave="open = false">
    <button @mouseenter="open = true"
        class="inline-flex items-center justify-center space-x-2 focus:outline-none {{ in_array(request()->path(), $toPages) ? 'border-b-2 border-black' : 'custom-link' }} text-black hover:text-economic-darkgreen">
        <span class="block py-3 transition duration-300 hover:text-economic-darkgreen">{{ $title }}</span>
        <svg :class="{ 'transform rotate-180': open }" class="w-4 h-4 transition-transform"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="open" @mouseenter="open = true" @mouseleave="open = false"
        class="left-0 z-50 w-full md:w-[350px] lg:w-[200px] origin-top-right lg:bg-white lg:shadow-xl lg:absolute rounded-md"
        x-show="isOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in lg:duration-300 duration-500"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
        @click.away="open = false">
        {{ $slot }}
    </div>
</div>
