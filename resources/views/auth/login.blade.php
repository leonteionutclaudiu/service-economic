<x-layout>

    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <img src="{{ asset('images/logo.png') }}" alt="logo" class="block mx-auto w-full max-w-64 mb-4" />

            <h3 class="text-center text-economic-darkgray">Salut!</h3>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Parola')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-economic-darkgreen shadow-sm focus:ring-economic-darkgreen"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Reține-mă') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <div class="flex flex-col gap-2">

                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-economic-darkgreen"
                            href="{{ route('password.request') }}">
                            {{ __('Ți-ai uitat parola?') }}
                        </a>
                    @endif

                    {{-- <a class="underline  text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-economic-darkgreen"
                        href="{{ route('register') }}">
                        {{ __('Creeaza un cont nou') }}
                    </a> --}}
                </div>


                <x-primary-button class="ms-3">
                    {{ __('Autentifică-mă') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>

</x-layout>
