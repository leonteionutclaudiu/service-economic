    <!-- Modal -->
    <div x-show="contactModalForm" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in lg:duration-300 duration-500" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black-0.5 z-[999] backdrop-blur-md flex items-center justify-center py-4">
        <form
            class='contact-form overflow-y-auto bg-black-0.75 w-full h-full max-h-[820px] md:w-fit max-w-7xl mx-auto transition duration-300 p-10 xl:p-16 border bg-[#ffffffda] border-economic-darkgray rounded-md shadow-lg text-black relative'
            action="{{ route('send_contact_mail') }}" method="post" @click.away="contactModalForm = false">
            @csrf

            {{-- Take current URL --}}
            <input type="hidden" name="current_url" value="{{ request()->url() }}">

            {{-- Close button --}}
            <button @click="contactModalForm = false" type="button"
                class="absolute block top-1 right-1 ml-auto h-9 w-9 rounded-full border border-economic-darkgray transition text-black hover:bg-red-700 hover:text-white hover:border-red-700 bg-white">&#x2715;</button>

            <div class="text-center">
                <div class='mb-6 font-bold'>
                    <p class="text-lg md:text-xl">Ne puteti contacta la numarul de telefon:</p>
                    <a href="tel:+40744322011"
                        class='flex items-center gap-1 mx-auto transition w-fit hover:text-gray-100 hover:underline text-lg md:text-2xl'>
                        0744 322 011
                    </a>
                    <p class="text-lg md:text-xl">sau completand formularul de mai jos</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2">
                <div class='control_group'>
                    <label class='label' for='nume'>Nume*</label>
                    <input type='text' data-modal-form-name='nume' name='nume' placeholder='Ion Popescu'
                        id='nume'
                        class="@error('nume') bg-red-50 @enderror ring-economic-darkgreen focus:ring-economic-darkgreen"
                        value="{{ old('nume') }}">
                </div>

                <div class='control_group'>
                    <label class='label' for='nr'>Telefon*</label>
                    <input type='tel' data-modal-form-name='nr' name='nr' placeholder='0737600600'
                        id='nr'
                        class="@error('nr') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"
                        value="{{ old('nr') }}">
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
                    <input type='text' data-modal-form-name='judet' name='judet' placeholder='Judetul'
                        id='judet'
                        class="@error('judet') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"
                        value="{{ old('judet') }}">
                </div>

                <div class='control_group'>
                    <label class='label' for='email'>Email*</label>
                    <input type='text' data-modal-form-name='email' name='email'
                        placeholder='popescu.ion@gmail.com' id='email'
                        class="@error('email') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"
                        value="{{ old('email') }}">
                </div>
            </div>

            <div class="control_group">
                <label class='label' for='mesaj'>Mesaj*</label>
                <textarea name='mesaj' data-modal-form-name='mesaj' rows="4" id='mesaj'
                    class="@error('mesaj') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen">{{ old('mesaj') }}</textarea>
            </div>

            <div class="flex items-center justify-center gap-2 control_group">
                <input type="checkbox" data-modal-form-name='privacy_policy' name="privacy_policy" id="privacy_policy"
                    class="@error('privacy_policy') bg-red-50 @enderror focus:ring-economic-darkgreen"
                    {{ old('privacy_policy') ? 'checked' : '' }}>
                <label class="m-0 text-economic-gri" for="privacy_policy">Am citit și sunt de acord cu <a
                        href="/politica-de-confidentialitate" target="_blank" class="font-bold underline">Politica de
                        confidențialitate</a></label>
            </div>

            {{-- GOOGLE RECAPTCHA --}}
            @if (config('services.recaptcha.key'))
                <div>
                    <div class="flex items-center justify-center mb-4 g-recaptcha"
                        data-modal-form-name='g-recaptcha-response'
                        data-sitekey="{{ config('services.recaptcha.key') }}">
                    </div>
                </div>
            @endif

            <button type='submit' id='trimitebtnblock' class='uppercase feedback_button'>Trimite mesajul</button>
        </form>
    </div>

    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            let form = document.querySelector('.contact-form');
            let submitBtn = document.getElementById('trimitebtnblock');
            let successFlashMessage = document.getElementById('successFlashMessage');
            let errorFlashMessage = document.getElementById('errorFlashMessage');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Clear all previous error styles and messages
                let errorFields = form.querySelectorAll('.bg-red-50');
                errorFields.forEach(function(field) {
                    field.classList.remove('bg-red-50');
                });

                let errorMessages = form.querySelectorAll('.text-red-500');
                errorMessages.forEach(function(message) {
                    message.remove();
                });

                // Disable the submit button and show a spinner
                submitBtn.setAttribute('disabled', true);
                submitBtn.innerHTML =
                    '<span class="mr-2"><i class="fas fa-spinner animate-spin"></i></span> Se trimite...';

                // Get form data
                let formData = new FormData(form);

                // Make an Axios POST request
                axios.post('{{ route('send_contact_mail') }}', formData)
                    .then(function(response) {
                        // Handle success
                        submitBtn.setAttribute('disabled', true);
                        submitBtn.classList.add('bg-green-200');
                        submitBtn.innerHTML = 'TRIMITE MESAJ';

                        // Display success message above the submit button
                        let successMessage = document.createElement('div');
                        successMessage.classList.add('bg-green-200', 'text-green-800', 'p-2', 'rounded',
                            'mb-4', 'text-lg', 'text-center');
                        successMessage.innerHTML = response.data.message;
                        form.insertBefore(successMessage, submitBtn);

                        // Remove the success message after a delay
                        setTimeout(function() {
                            successMessage.remove();
                            submitBtn.removeAttribute('disabled');
                            submitBtn.innerHTML = 'Trimite mesaj';
                            submitBtn.classList.remove('bg-green-200');

                            // Reset all input fields
                            form.reset();
                            // Reset reCAPTCHA
                            grecaptcha.reset();
                        }, 10000);
                    })
                    .catch(function(error) {
                        // Handle error
                        if (error.response && error.response.data && error.response.data.errors) {
                            // Reset reCAPTCHA
                            grecaptcha.reset();
                            // Update the UI to display validation errors
                            Object.keys(error.response.data.errors).forEach(function(key) {
                                let inputField = document.querySelector(
                                    '[data-modal-form-name="' + key + '"]');
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
                        submitBtn.removeAttribute('disabled');
                        submitBtn.innerHTML = 'Trimite mesaj';
                    });
            });
        });
    </script>
