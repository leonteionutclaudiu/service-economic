<x-layout>
    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14">

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex gap-10 flex-col items-center lg:flex-row w-fit mx-auto">

            <div class="w-full text-justify max-w-[75ch] mx-auto flex items-center flex-col gap-4">
                <h5>Completați formularul nostru de mai jos
                    pentru a asigura îngrijirea optimă a vehiculului dvs. Echipa noastră calificată este pregătită să vă
                    ofere servicii de înaltă calitate.</h5>
                <img src="{{ asset('images/programare.jpg') }}" alt="Logo" class="rounded-md max-h-[768px]" />
            </div>

            <form action="/programare" method="post"
                class="max-w-lg mx-auto bg-white p-2 md:p-8 rounded shadow-md hover:shadow-lg transition hover:shadow-economic-darkgreen shadow-economic-darkgreen flex-grow w-full programare-form">
                @csrf

                <h4 class="text-center mb-4">Formular programare service</h4>

                <div class="mb-4">
                    <label for="nume" class="block text-gray-600 font-bold">Nume:</label>
                    <input type="text" name="nume" id="nume" data-programare-form-name='nume'
                        class="@error('nume') bg-red-50 @enderror ring-economic-darkgreen focus:ring-economic-darkgreen"
                        placeholder="Popescu" value="{{ old('nume') }}">
                    @error('nume')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-600 font-bold">Email:</label>
                    <input type="email" name="email" id="email" data-programare-form-name='email'
                        class="@error('email') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"
                        placeholder="Alexandru" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nr" class="block text-gray-600 font-bold">Telefon:</label>
                    <input type="text" name="nr" id="nr" data-programare-form-name='nr'
                        class="@error('nr') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"
                        placeholder="0712345678" value="{{ old('nr') }}">
                    @error('nr')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nr_inmatriculare" class="block text-gray-600 font-bold">Nr. Înmatriculare:</label>
                    <input type="text" name="nr_inmatriculare" id="nr_inmatriculare"
                        data-programare-form-name='nr_inmatriculare'
                        class="@error('nr_inmatriculare') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"placeholder="B183ARJ"
                        value="{{ old('nr_inmatriculare') }}">
                    @error('nr_inmatriculare')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="data_programare" class="block text-gray-600 font-bold">Ziua dorita pentru
                        programare:</label>
                    <input type="date" name="data_programare" id="data_programare"
                        data-programare-form-name='data_programare'
                        class="@error('data_programare') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen"
                        min="{{ date('Y-m-d') }}" value="{{ old('data_programare') }}">
                    <span id="date_error" class="text-red-500 hidden">Programul nostru este de luni până sâmbătă.</span>
                    @error('data_programare')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="mesaj" class="block text-gray-600 font-bold">Lasa-ne un mesaj:</label>
                    <textarea name="mesaj" id="mesaj" data-programare-form-name='mesaj'
                        class="@error('mesaj') bg-red-50 @enderror focus:ring-economic-darkgreen ring-economic-darkgreen" rows="4"
                        placeholder="Doresc o revizie tehnica pentru un VW Polo din anul 2017." value="{{ old('mesaj') }}"></textarea>
                    @error('mesaj')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- GOOGLE RECAPTCHA --}}
                @if (config('services.recaptcha.key'))
                    <div>
                        <div class="flex items-center justify-center mb-4 g-recaptcha"
                            data-programare-form-name='g-recaptcha-response'
                            data-sitekey="{{ config('services.recaptcha.key') }}">
                        </div>
                    </div>
                @endif

                <button type="submit"
                    class="hover:bg-economic-red transition bg-economic-darkgreen text-white px-4 py-2 rounded w-full text-xl"
                    id='trimitebtnprogramare'>Solicit
                    programare noua</button>
            </form>
        </div>
    </div>
    </div>
</x-layout>

<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        let dataProgramareInput = document.getElementById('data_programare');
        let dateError = document.getElementById('date_error');

        // Function to check if a given date is Sunday
        function isSunday(date) {
            return date.getDay() === 0; // 0 represents Sunday
        }

        // Function to handle input event on date input
        dataProgramareInput.addEventListener('input', function(event) {
            let selectedDate = new Date(event.target.value);

            // If the selected date is Sunday, show the error message
            if (isSunday(selectedDate)) {
                dateError.classList.remove('hidden');
                event.target.setCustomValidity('Programul nostru este: luni-vineri orele 08:00 - 17:00 si sambata orele 08:00 - 14:00.');
            } else {
                dateError.classList.add('hidden');
                event.target.setCustomValidity('');
            }
        });

        let form = document.querySelector('.programare-form');
        let submitBtnProgramare = document.getElementById('trimitebtnprogramare');
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
            submitBtnProgramare.setAttribute('disabled', true);
            submitBtnProgramare.innerHTML =
                '<span class="mr-2"><i class="fas fa-spinner animate-spin"></i></span> Se trimite...';

            // Get form data
            let formData = new FormData(form);

            // Make an Axios POST request
            axios.post('{{ route('programare') }}', formData)
                .then(function(response) {
                    // Handle success
                    submitBtnProgramare.setAttribute('disabled', true);
                    submitBtnProgramare.classList.add('bg-green-200');
                    submitBtnProgramare.innerHTML = 'Solicit programare noua';

                    // Display success message above the submit button
                    let successMessage = document.createElement('div');
                    successMessage.classList.add('bg-green-200', 'text-green-800', 'p-2', 'rounded',
                        'mb-4', 'text-lg', 'text-center');
                    successMessage.innerHTML = response.data.message;
                    form.insertBefore(successMessage, submitBtnProgramare);

                    // Remove the success message after a delay
                    setTimeout(function() {
                        successMessage.remove();
                        submitBtnProgramare.removeAttribute('disabled');
                        submitBtnProgramare.innerHTML = 'Solicit programare noua';
                        submitBtnProgramare.classList.remove('bg-green-200');

                        // Reset all input fields
                        form.reset();
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
                                '[data-programare-form-name="' + key + '"]');
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
                    submitBtnProgramare.removeAttribute('disabled');
                    submitBtnProgramare.innerHTML = 'Solicit programare noua';
                });
        });
    });
</script>
