<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informatiile profilului meu') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Actualizați informațiile de profil și adresele dvs.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="flex flex-col md:flex-row gap-4">
            <div>
                <h4 class="mb-4"><i class="fa-solid fa-user"></i> Informatii profil</h4>
                <div>
                    <x-input-label for="name" :value="__('Nume')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                        :value="old('name', $user->name)" required autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                        :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Adresa ta de e-mail nu este verificată.') }}

                                <button form="send-verification"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Faceți clic aici pentru a retrimite e-mailul de verificare.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('Un nou link de verificare a fost trimis la adresa dvs. de e-mail.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            {{-- <div class="flex flex-col md:flex-row gap-4">
                <!-- câmpuri pentru adresa de livrare -->
                <div>
                    <h4 class="mb-4"><i class="fa-solid fa-truck-fast"></i> Adresa de livrare</h4>
                    <div>
                        <x-input-label for="shipping_address_line" :value="__('Adresa')" />
                        <x-text-input id="shipping_address_line" name="shipping_address_line" type="text"
                            class="mt-1 block w-full" :value="old('shipping_address_line', $user->shippingAddress->address_line ?? '')" autocomplete="shipping_address_line" />
                        <x-input-error class="mt-2" :messages="$errors->get('shipping_address_line')" />
                    </div>

                    <div>
                        <x-input-label for="shipping_city" :value="__('Orașul')" />
                        <x-text-input id="shipping_city" name="shipping_city" type="text" class="mt-1 block w-full"
                            :value="old('shipping_city', $user->shippingAddress->city ?? '')" autocomplete="shipping_city" />
                        <x-input-error class="mt-2" :messages="$errors->get('shipping_city')" />
                    </div>

                    <div>
                        <x-input-label for="shipping_state" :value="__('Județul')" />
                        <x-text-input id="shipping_state" name="shipping_state" type="text" class="mt-1 block w-full"
                            :value="old('shipping_state', $user->shippingAddress->state ?? '')" autocomplete="shipping_state" />
                        <x-input-error class="mt-2" :messages="$errors->get('shipping_state')" />
                    </div>

                    <div>
                        <x-input-label for="shipping_postal_code" :value="__('Cod poștal')" />
                        <x-text-input id="shipping_postal_code" name="shipping_postal_code" type="text"
                            class="mt-1 block w-full" :value="old('shipping_postal_code', $user->shippingAddress->postal_code ?? '')" autocomplete="shipping_postal_code" />
                        <x-input-error class="mt-2" :messages="$errors->get('shipping_postal_code')" />
                    </div>
                </div>

                <!-- câmpuri pentru adresa de facturare -->
                <div>
                    <h4 class="mb-4"><i class="fa-solid fa-map-location-dot"></i> Adresa de facturare</h4>
                    <div>
                        <x-input-label for="billing_address_line" :value="__('Adresa')" />
                        <x-text-input id="billing_address_line" name="billing_address_line" type="text"
                            class="mt-1 block w-full" :value="old('billing_address_line', $user->billingAddress->address_line ?? '')" autocomplete="billing_address_line" />
                        <x-input-error class="mt-2" :messages="$errors->get('billing_address_line')" />
                    </div>

                    <div>
                        <x-input-label for="billing_city" :value="__('Orașul')" />
                        <x-text-input id="billing_city" name="billing_city" type="text" class="mt-1 block w-full"
                            :value="old('billing_city', $user->billingAddress->city ?? '')" autocomplete="billing_city" />
                        <x-input-error class="mt-2" :messages="$errors->get('billing_city')" />
                    </div>

                    <div>
                        <x-input-label for="billing_state" :value="__('Județul')" />
                        <x-text-input id="billing_state" name="billing_state" type="text" class="mt-1 block w-full"
                            :value="old('billing_state', $user->billingAddress->state ?? '')" autocomplete="billing_state" />
                        <x-input-error class="mt-2" :messages="$errors->get('billing_state')" />
                    </div>

                    <div>
                        <x-input-label for="billing_postal_code" :value="__('Cod poștal')" />
                        <x-text-input id="billing_postal_code" name="billing_postal_code" type="text"
                            class="mt-1 block w-full" :value="old('billing_postal_code', $user->billingAddress->postal_code ?? '')" autocomplete="billing_postal_code" />
                        <x-input-error class="mt-2" :messages="$errors->get('billing_postal_code')" />
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvează') }}</x-primary-button>

            @if (session('status'))
                <x-flash-message type="status" :message="session('status')" />
            @endif
        </div>
    </form>
</section>
