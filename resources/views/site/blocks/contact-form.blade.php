<!-- contact-form.blade.php -->

<form class='w-full max-w-5xl p-5 mx-auto transition duration-300 contact_form' action="/send-mail" method="post">
    @csrf

    <div class="text-center">
        <h4 class="text-economic-darkgreen">
            Vă invităm să ne contactați prin intermediul datelor de contact furnizate sau să utilizați formularul de
            contact de mai jos.</h4>
        <div class="flex flex-wrap items-center justify-center gap-10">
            <div>
                <a class='text-lg transition text-economic-darkgreen w-fit hover:text-economic-lightgreen hover:underline'
                    href='https://maps.app.goo.gl/134TeRLiA8Jed8N27' target='_blank'>
                    Strada Valea Oltului 199-201, București 061992
                    <i class="fa fa-map-marker text-economic-darkgreen"></i>
                </a>
                <a href="mailto:office@serviceeconomic.ro"
                    class='flex items-center gap-1 mx-auto text-lg transition w-fit text-economic-darkgreen hover:text-economic-lightgreen hover:underline'>
                    office@serviceeconomic.ro
                    <i class="fa fa-envelope text-economic-darkgreen"></i>
                </a>
                <a href="tel:+40744322011"
                    class='flex items-center gap-1 mx-auto text-lg transition w-fit text-economic-darkgreen hover:text-economic-lightgreen hover:underline'>
                    0744 322 011
                    <i class="fa fa-phone text-economic-darkgreen"></i>
                </a>
            </div>
            <div class="mt-4 mb-6 text-economic-red"><span class="font-bold">PROGRAM <i class="fa fa-clock"></i>
                </span><br /> Luni - Vineri ->
                08:00 - 17:00</div>
        </div>

        @php
            $errorCount = count($errors->all());
        @endphp

        @if ($errorCount > 0)
            <p class="text-red-500">Ai {{ $errorCount }} {{ $errorCount === 1 ? 'eroare' : 'erori' }} in formular. Te
                rugam sa verifici toate campurile.</p>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2">
        <div class='control_group'>
            <label class='label' for='nume'>Nume*</label>
            <input type='text' name='nume' placeholder='Ion Popescu' id='nume'
                class="@error('nume') bg-red-50 @enderror ring-economic-darkgreen hover:ring-2"
                value="{{ old('nume') }}">
            @error('nume')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class='control_group'>
            <label class='label' for='nr'>Telefon*</label>
            <input type='tel' name='nr' placeholder='0737600600' id='nr'
                class="@error('nr') bg-red-50 @enderror ring-economic-darkgreen hover:ring-2"
                value="{{ old('nr') }}">
            @error('nr')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class='control_group'>
            <label class='label' for='companie'>Companie*</label>
            <input type='text' name='companie' placeholder='Numele Companiei' id='companie'
                class="@error('companie') bg-red-50 @enderror ring-economic-darkgreen hover:ring-2"
                value="{{ old('companie') }}">
            @error('companie')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class='control_group'>
            <label class='label' for='judet'>Judet*</label>
            <input type='text' name='judet' placeholder='Judetul' id='judet'
                class="@error('judet') bg-red-50 @enderror ring-economic-darkgreen hover:ring-2"
                value="{{ old('judet') }}">
            @error('judet')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class='control_group'>
        <label class='label' for='email'>Email*</label>
        <input type='text' name='email' placeholder='popescu.ion@gmail.com' id='email'
            class="@error('email') bg-red-50 @enderror ring-economic-darkgreen hover:ring-2"
            value="{{ old('email') }}">
        @error('email')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="control_group">
        <label class='label' for='mesaj'>Mesaj*</label>
        <textarea name='mesaj' rows="4" id='mesaj'
            class="@error('mesaj') bg-red-50 @enderror ring-economic-darkgreen hover:ring-2">{{ old('mesaj') }}</textarea>
        @error('mesaj')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex items-center justify-center gap-2 control_group">
        <input type="checkbox" name="privacy_policy" id="privacy_policy"
            class="@error('privacy_policy') bg-red-50 @enderror" {{ old('privacy_policy') ? 'checked' : '' }}>
        <label class="m-0 text-economic-gri" for="privacy_policy">Am citit și sunt de acord cu <a
                href="/politica-de-confidentialitate" target="_blank" class="font-bold underline">Politica de
                confidențialitate</a></label>
    </div>
    @error('privacy_policy')
        <span class="block mx-auto mb-4 text-center text-red-500">{{ $message }}</span>
    @enderror


    {{-- GOOGLE RECAPTCHA --}}
    @if (config('services.recaptcha.key'))
        <div class="flex items-center justify-center mb-4 g-recaptcha"
            data-sitekey="{{ config('services.recaptcha.key') }}">
        </div>
    @endif

    @error('g-recaptcha-response')
        <span class="block mx-auto mb-4 text-center text-red-500">{{ $message }}</span>
    @enderror

    <button type='submit' id='trimitebtnblock' class='uppercase feedback_button'>Trimite mesajul</button>
</form>

@if (session('success'))
    <x-flash-message type="success" :message="session('success')" />
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let form = document.querySelector('.contact_form');
        let submitBtn = document.getElementById('trimitebtnblock');

        form.addEventListener('submit', function() {
            submitBtn.setAttribute('disabled', true);
            submitBtn.innerHTML =
                '<span class="mr-2">  <i class="fas fa-cog fa-spin"></i></span> Se trimite...';
        });

        let flashMessage = document.getElementById('flashMessage');

        if (flashMessage) {
            flashMessage.style.opacity = 1;
            setTimeout(function() {
                flashMessage.style.opacity = 0;

                setTimeout(function() {
                    flashMessage.remove();
                }, 1000);
            }, 8000);
        }

    });
</script>
