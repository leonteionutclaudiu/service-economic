<button
    class="fixed z-50 flex items-center justify-center w-8 h-8 p-2 text-white transition rounded-full shadow-md bg-economic-darkgreen lg:w-10 lg:h-10 bottom-8 right-8 hover:bg-economic-lightgreen"
    x-show="isVisible" x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-full" x-on:click="scrollToTop">
    <i class="fas fa-chevron-up"></i>
</button>
