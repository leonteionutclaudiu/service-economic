<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Mulțumesc pentru înscriere! Înainte de a începe, ați putea să vă verificați adresa de e-mail făcând clic pe linkul pe care tocmai vi l-am trimis prin e-mail? Dacă nu ați primit e-mailul, vă vom trimite cu plăcere un altul.') }}
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Un nou link de verificare a fost trimis la adresa de e-mail pe care ați furnizat-o în timpul înregistrării.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Retrimite email-ul de verificare') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Ieși din cont') }}
            </button>
        </form>
    </div>
</x-guest-layout>
