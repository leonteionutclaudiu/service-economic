<x-layout>

    <x-guest-layout>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <img src="{{ asset('images/logo.png') }}" alt="logo" class="block mx-auto w-full max-w-64 mb-4" />

            <h3 class="text-center text-economic-darkgray">Vreau un cont nou</h3>

            <h6>De ce sa iti faci un cont la noi ?</h6>
            <p class="mx-1 my-2 text-green-900"><i class="fa-solid fa-wand-sparkles"></i> Poti plasa comenzi si sa urmaresti statusul lor</p>
            <p class="mx-1 my-2 text-green-900"><i class="fa-solid fa-wand-sparkles"></i> Salvezi produse in lista de favorite si faci liste de cumparaturi</p>
            <p class="mx-1 my-2 text-green-900"><i class="fa-solid fa-wand-sparkles"></i> Salvezi in contul tau adresa de livrare si adresa de facturare</p>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nume')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Parola')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmă parola')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-economic-darkgreen"
                    href="{{ route('login') }}">
                    {{ __('Ai deja un cont?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Înregistrează-mă') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>


</x-layout>
