@props(['type' => 'success', 'message'])

<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 7000)"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    class="fixed top-28 left-2 flex items-center p-4 mb-4 text-lg rounded-lg z-[999]"
    :class="{
        'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400': '{{ $type }}' === 'success',
        'text-red-800 bg-red-50 dark:bg-red-800 dark:text-red-400': '{{ $type }}' === 'error',
        'text-blue-800 bg-blue-50 dark:bg-blue-800 dark:text-blue-400': '{{ $type }}' === 'info',
        'text-blue-800 bg-blue-50 dark:bg-blue-800 dark:text-blue-400': '{{ $type }}' === 'status',
        'text-yellow-800 bg-yellow-50 dark:bg-yellow-800 dark:text-yellow-400': '{{ $type }}' === 'warning',
    }"
    role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="currentColor" viewBox="0 0 20 20">
        <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">Info</span>
    <div>
        {{ $message }}
    </div>
</div>
