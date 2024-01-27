<x-layout>
    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14">

        {{-- <x-slot name="header"> --}}
        <h2 class="text-2xl font-bold text-center md:text-4xl text-economic-darkgreen">
            {{ __('Profilul meu') }}
        </h2>
        <h4 class="text-center">Bine ai venit, <em>{{ $user->name }}</em> !</h4>
        {{-- </x-slot> --}}

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <x-flash-message type="success" :message="session('success')" />
    @endif
</x-layout>
