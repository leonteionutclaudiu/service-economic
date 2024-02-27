<x-layout>
    <div class="py-6 mx-auto lg:py-20 md:py-14 max-w-7xl">
        <h2 class="px-2 mb-4 text-center text-economic-darkgreen md:px-12">Finalizare comanda</h2>
        <div class="px-4 py-6 mx-auto md:px-12 shadow-lg shadow-economic-lightgreen">
            @foreach ($cartItems as $cartItem)
                <div
                    class="flex flex-col md:flex-row items-center justify-between p-4 mb-4 bg-light rounded-lg border border-economic-darkgreen transition duration-300 text-economic-darkgreen">
                    <div class="flex flex-col md:flex-row items-center gap-2">
                        <img src="{{ $cartItem->product->image('picture') }}" alt="{{ $cartItem->product->title }}"
                            class="block w-16 md:w-24 mr-4" />
                        <p class="text-lg font-semibold">{{ $cartItem->product->title }}</p>
                    </div>
                    <div class="flex items-end flex-col gap-2">
                        @if ($cartItem->product->sale_price)
                            <div>
                                <p class="font-bold text-xl">
                                    {{ $cartItem->product->sale_price * $cartItem->quantity }} RON</p>
                                <p class="font-bold text-lg text-gray-500">
                                    <span>{{ $cartItem->quantity }} <i class="fa-solid fa-x text-xs"></i></span>
                                    {{ $cartItem->product->sale_price }}
                                    RON / buc
                                </p>
                            </div>
                        @else
                            <div>
                                <p class="font-bold text-xl">
                                    {{ $cartItem->product->price * $cartItem->quantity }} RON</p>
                                <p class="font-bold text-lg text-gray-500">
                                    <span>{{ $cartItem->quantity }} <i class="fa-solid fa-x text-xs"></i></span>
                                    {{ $cartItem->product->price }}
                                    RON / buc
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="mt-10 mb-6 flex gap-2 justify-between flex-wrap text-2xl md:text-3xl font-bold">
                <p>Pret total <span class="text-gray-500 text-lg">(TVA inclus)</span></p>
                <p>{{ $totalPrice }} RON</p>
            </div>
         {{-- Alegere adrese --}}
         <div class="flex flex-col md:flex-row gap-4">
            <!-- Radio buttons pentru adresa de livrare și facturare -->
            <div class="flex flex-col">
                <h4 class="mb-4"><i class="fa-solid fa-truck-fast"></i> Adresa de livrare</h4>
                <label>
                    <input type="radio" name="address_option" value="saved" checked>
                    Folosește adresa salvată din cont
                </label>
                <br>
                <label>
                    <input type="radio" name="address_option" value="manual">
                    Folosește altă adresă
                </label>
            </div>

            <!-- Checkbox pentru salvarea noilor adrese -->
            <div class="flex flex-col">
                <label>
                    <input type="checkbox" name="save_address">
                    Salvează aceste adrese în contul meu
                </label>
            </div>
        </div>

       <!-- câmpuri pentru adresa de livrare -->
<div id="shipping_address">
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
<div id="billing_address">
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
    </div>
</x-layout>
<script>
    $(document).ready(function(){
        // Ascunde câmpurile de adresă la început
        $('#shipping_address').hide();
        $('#billing_address').hide();

        // Afiseaza sau ascunde câmpurile în funcție de selectia utilizatorului
        $('input[name="address_option"]').change(function(){
            if($(this).val() == "manual") {
                $('#shipping_address').show();
                $('#billing_address').show();
            } else {
                $('#shipping_address').hide();
                $('#billing_address').hide();
            }
        });

        // Salvează adresele în contul utilizatorului dacă checkbox-ul este bifat
        $('input[name="save_address"]').change(function(){
            if($(this).is(':checked')) {
                // Aici poți adăuga logica pentru a trimite adresele către server pentru a fi salvate în contul utilizatorului
            }
        });
    });
</script>
