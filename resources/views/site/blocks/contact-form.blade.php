<!-- contact-form.blade.php -->

<form
    class='w-full max-w-5xl p-5 mx-auto transition duration-300 contact_form_block wow animate__animated animate__fadeIn'
    action="/send-mail" method="post">
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
                <a href="tel:+40746050608"
                    class='flex items-center gap-1 mx-auto text-lg transition w-fit text-economic-darkgreen hover:text-economic-lightgreen hover:underline'>
                    0746 050 608
                    <i class="fa fa-phone text-economic-darkgreen"></i>
                </a>
                <a href="tel:+40742223007"
                    class='flex items-center gap-1 mx-auto text-lg transition w-fit text-economic-darkgreen hover:text-economic-lightgreen hover:underline'>
                    0742 223 007
                    <i class="fa fa-phone text-economic-darkgreen"></i>
                </a>
            </div>
            <div class="mt-4 mb-6 text-economic-red text-start"><span class="font-bold">PROGRAM <i
                        class="fa fa-clock"></i>
                </span><br /> Luni - Vineri ->
                08:00 - 17:00 <br /> Sâmbătă -> 08:00 - 14:00<br /> Duminică -> Închis</div>
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
            <input type='text' data-modal-form_block-name='nume' name='nume' placeholder='Ion Popescu'
                id='nume'
                class="@error('nume') bg-red-50 @enderror ring-economic-darkgreen focus:ring-economic-darkgreen"
                value="{{ old('nume') }}">
            @error('nume')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class='control_group'>
            <label class='label' for='nr'>Telefon*</label>
            <input type='tel' data-modal-form_block-name='nr' name='nr' placeholder='0737600600' id='nr'
                class="@error('nr') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"
                value="{{ old('nr') }}">
            @error('nr')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        {{-- <div class='control_group'>
            <label class='label' for='companie'>Companie*</label>
            <input type='text' name='companie' placeholder='Numele Companiei' id='companie'
                class="@error('companie') bg-red-50 @enderror focus:ring-economic-darkgreen  ring-economic-darkgreen"
                value="{{ old('companie') }}">
            @error('companie')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div> --}}
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2">

        <div class='control_group'>
            <label class='label' for='judet'>Judet*</label>
            <input type='text' data-modal-form_block-name='judet' name='judet' placeholder='Judetul' id='judet'
                class="@error('judet') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"
                value="{{ old('judet') }}">
            @error('judet')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class='control_group'>
            <label class='label' for='email'>Email*</label>
            <input type='text' data-modal-form_block-name='email' name='email' placeholder='popescu.ion@gmail.com'
                id='email'
                class="@error('email') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"
                value="{{ old('email') }}">
            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="control_group">
        <label class='label' for='mesaj'>Mesaj*</label>
        <textarea data-modal-form_block-name='mesaj' name='mesaj' rows="4" id='mesaj'
            class="@error('mesaj') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen">{{ old('mesaj') }}</textarea>
        @error('mesaj')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex items-center justify-center gap-2 control_group">
        <input type="checkbox" data-modal-form_block-name='privacy_policy' name="privacy_policy" id="privacy_policy"
            class="@error('privacy_policy') bg-red-50 @enderror focus:ring-economic-darkgreen"
            {{ old('privacy_policy') ? 'checked' : '' }}>
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

    <button type='submit' id='trimitebtnblock_twill' class='uppercase feedback_button'>Trimite mesajul</button>
</form>

@if (session('success'))
    <x-flash-message type="success" :message="session('success')" />
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let form_block = document.querySelector('.contact_form_block');
        let submitBtnBlock = document.getElementById('trimitebtnblock_twill');

        form_block.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Clear all previous error styles and messages
            let errorFields = form_block.querySelectorAll('.bg-red-50');
            errorFields.forEach(function(field) {
                field.classList.remove('bg-red-50');
            });

            let errorMessages = form_block.querySelectorAll('.text-red-500');
            errorMessages.forEach(function(message) {
                message.remove();
            });

            // Disable the submit button and show a spinner
            submitBtnBlock.setAttribute('disabled', true);
            submitBtnBlock.innerHTML =
                '<span class="mr-2"><i class="fas fa-spinner animate-spin"></i></span> Se trimite...';

            // Get form data
            let formData = new FormData(form_block);

            // Make an Axios POST request
            axios.post('{{ route('send_contact_mail') }}', formData)
                .then(function(response) {
                    // Handle success
                    submitBtnBlock.setAttribute('disabled', true);
                    submitBtnBlock.classList.add('bg-green-200');
                    submitBtnBlock.innerHTML = 'TRIMITE MESAJUL';

                    // Display success message above the submit button
                    let successMessage = document.createElement('div');
                    successMessage.classList.add('bg-green-200', 'text-green-800', 'p-2', 'rounded',
                        'mb-4', 'text-lg', 'text-center');
                    successMessage.innerHTML = response.data.message;
                    form_block.insertBefore(successMessage, submitBtnBlock);

                    // Remove the success message after a delay
                    setTimeout(function() {
                        successMessage.remove();
                        submitBtnBlock.removeAttribute('disabled');
                        submitBtnBlock.innerHTML = 'Trimite mesajul';
                        submitBtnBlock.classList.remove('bg-green-200');

                        // Reset all input fields
                        form_block.reset();
                        // Reset reCAPTCHA
                        grecaptcha.reset(1);
                    }, 10000);
                })
                .catch(function(error) {
                    // Handle error
                    if (error.response && error.response.data && error.response.data.errors) {
                        // Reset reCAPTCHA
                        grecaptcha.reset(1);
                        // Update the UI to display validation errors
                        Object.keys(error.response.data.errors).forEach(function(key) {
                            let inputField = document.querySelector(
                                '[data-modal-form_block-name="' + key + '"]');
                            if (inputField) {
                                // Update the UI to highlight the error
                                inputField.classList.add('bg-red-50');
                                // Display the error message next to the input field
                                let errorElement = document.createElement('span');
                                errorElement.classList.add('text-red-500', 'block', 'mt-1',
                                    'mb-1',
                                    'text-sm', 'text-center');
                                errorElement.innerHTML = error.response.data.errors[key][0];
                                inputField.parentNode.appendChild(errorElement);
                            }
                        });
                    }
                    // Enable the submit button and display an error message
                    submitBtnBlock.removeAttribute('disabled');
                    submitBtnBlock.innerHTML = 'Trimite mesajul';
                });
        });
    });
</script>
