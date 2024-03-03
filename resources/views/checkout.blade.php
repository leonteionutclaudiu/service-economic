<x-layout>
    {{-- @php
        dd($addressesCompleted);
    @endphp --}}
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
            <p class="text-right text-3xl font-bold text-economic-darkgreen">Pret total <span
                    class="text-gray-500 text-lg">(TVA inclus)</span> {{ $totalPrice }} RON</p>
            {{-- Alegere adrese --}}
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Radio buttons pentru adresa de livrare și facturare -->
                <div class="flex flex-col">
                    <label>
                        <input type="radio" name="address_option" value="saved"
                            {{ !$addressesCompleted ? 'disabled' : '' }}
                            class="{{ !$addressesCompleted ? 'pointer-events-none opacity-50' : '' }}">
                        <span class="{{ !$addressesCompleted ? 'text-gray-500' : '' }}">Folosește adresele salvate
                            în cont
                            {{ !$addressesCompleted ? '(nu ai toate campurile adreselor salvate)' : '' }}</span>
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="address_option" value="manual">
                        Folosește adresă de livrare si adresă de facturare nouă
                    </label>
                    <label>
                        <input type="checkbox" id="same_address" name="same_address">
                        Adresa de livrare este aceeași cu adresa de facturare
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
                <h4 class="my-4"><i class="fa-solid fa-truck-fast"></i> Adresa de livrare</h4>
                <div>
                    <x-input-label for="shipping_address_line" :value="__('Adresa')" />
                    <x-text-input id="shipping_address_line" name="shipping_address_line" type="text"
                        class="mt-1 block w-full" autocomplete="shipping_address_line" />
                    <x-input-error class="mt-2" :messages="$errors->get('shipping_address_line')" />
                </div>

                <div>
                    <x-input-label for="shipping_city" :value="__('Orașul')" />
                    <x-text-input id="shipping_city" name="shipping_city" type="text" class="mt-1 block w-full"
                        autocomplete="shipping_city" />
                    <x-input-error class="mt-2" :messages="$errors->get('shipping_city')" />
                </div>

                <div>
                    <x-input-label for="shipping_state" :value="__('Județul')" />
                    <x-text-input id="shipping_state" name="shipping_state" type="text" class="mt-1 block w-full"
                        autocomplete="shipping_state" />
                    <x-input-error class="mt-2" :messages="$errors->get('shipping_state')" />
                </div>

                <div>
                    <x-input-label for="shipping_postal_code" :value="__('Cod poștal')" />
                    <x-text-input id="shipping_postal_code" name="shipping_postal_code" type="text"
                        class="mt-1 block w-full" autocomplete="shipping_postal_code" />
                    <x-input-error class="mt-2" :messages="$errors->get('shipping_postal_code')" />
                </div>
            </div>

            <!-- câmpuri pentru adresa de facturare -->
            <div id="billing_address">
                <h4 class="my-4"><i class="fa-solid fa-map-location-dot"></i> Adresa de facturare</h4>
                <div>
                    <x-input-label for="billing_address_line" :value="__('Adresa')" />
                    <x-text-input id="billing_address_line" name="billing_address_line" type="text"
                        class="mt-1 block w-full" autocomplete="billing_address_line" />
                    <x-input-error class="mt-2" :messages="$errors->get('billing_address_line')" />
                </div>

                <div>
                    <x-input-label for="billing_city" :value="__('Orașul')" />
                    <x-text-input id="billing_city" name="billing_city" type="text" class="mt-1 block w-full"
                        autocomplete="billing_city" />
                    <x-input-error class="mt-2" :messages="$errors->get('billing_city')" />
                </div>

                <div>
                    <x-input-label for="billing_state" :value="__('Județul')" />
                    <x-text-input id="billing_state" name="billing_state" type="text" class="mt-1 block w-full"
                        autocomplete="billing_state" />
                    <x-input-error class="mt-2" :messages="$errors->get('billing_state')" />
                </div>

                <div>
                    <x-input-label for="billing_postal_code" :value="__('Cod poștal')" />
                    <x-text-input id="billing_postal_code" name="billing_postal_code" type="text"
                        class="mt-1 block w-full" autocomplete="billing_postal_code" />
                    <x-input-error class="mt-2" :messages="$errors->get('billing_postal_code')" />
                </div>
            </div>
        </div>
    </div>
    </div>
</x-layout>

<script>
  $(document).ready(function() {
    // Funcție pentru a completa inputurile cu adresele salvate
    function completeSavedAddresses() {
        var shippingAddressLine = "{{ $shippingAddress ? $shippingAddress->address_line : '' }}";
        var shippingCity = "{{ $shippingAddress ? $shippingAddress->city : '' }}";
        var shippingState = "{{ $shippingAddress ? $shippingAddress->state : '' }}";
        var shippingPostalCode = "{{ $shippingAddress ? $shippingAddress->postal_code : '' }}";

        var billingAddressLine = "{{ $billingAddress ? $billingAddress->address_line : '' }}";
        var billingCity = "{{ $billingAddress ? $billingAddress->city : '' }}";
        var billingState = "{{ $billingAddress ? $billingAddress->state : '' }}";
        var billingPostalCode = "{{ $billingAddress ? $billingAddress->postal_code : '' }}";

        $("#shipping_address_line").val(shippingAddressLine).prop("readonly", true);
        $("#shipping_city").val(shippingCity).prop("readonly", true);
        $("#shipping_state").val(shippingState).prop("readonly", true);
        $("#shipping_postal_code").val(shippingPostalCode).prop("readonly", true);

        $("#billing_address_line").val(billingAddressLine).prop("readonly", true);
        $("#billing_city").val(billingCity).prop("readonly", true);
        $("#billing_state").val(billingState).prop("readonly", true);
        $("#billing_postal_code").val(billingPostalCode).prop("readonly", true);
    }

    // Verifică dacă primul radio button este dezactivat
    if ($("input[name='address_option']:first").is(":disabled")) {
        // Dacă este dezactivat, selectează al doilea radio button
        $("input[name='address_option']:last").prop("checked", true);
    } else {
        // Dacă nu este dezactivat, selectează primul radio button
        $("input[name='address_option']:first").prop("checked", true);
        // Completează inputurile cu adresele salvate la încărcarea paginii
        completeSavedAddresses();
    }

    // Ascultă schimbările în radio buttons
    $("input[name='address_option']").change(function() {

        if ($(this).val() === "saved") {
            // Completează inputurile cu adresele salvate
            completeSavedAddresses();
        } else {
            // Golește câmpurile și le face editabile
            $("#shipping_address input, #billing_address input").val("").prop("readonly", false);
        }
    });

    $("#same_address").change(function() {
        if ($(this).is(":checked")) {
            // Dacă checkbox-ul este bifat, sincronizează adresa de facturare cu adresa de livrare
            var billingAddressLine = $("#billing_address_line").val();
            var billingCity = $("#billing_city").val();
            var billingState = $("#billing_state").val();
            var billingPostalCode = $("#billing_postal_code").val();

            // Completează adresa de livrare cu valorile adresei de facturare
            $("#shipping_address_line").val(billingAddressLine);
            $("#shipping_city").val(billingCity);
            $("#shipping_state").val(billingState);
            $("#shipping_postal_code").val(billingPostalCode);
        } else if (!$(this).is(":checked") && $("input[name='address_option']:checked").val() === "saved") {
            // Completează inputurile cu adresele salvate dacă nu este bifat și primul radio button este selectat
            completeSavedAddresses();
        } else {
            // Dacă checkbox-ul nu este bifat, golește câmpurile adresei de livrare
            $("#shipping_address_line").val("");
            $("#shipping_city").val("");
            $("#shipping_state").val("");
            $("#shipping_postal_code").val("");
        }
    });
});
</script>
