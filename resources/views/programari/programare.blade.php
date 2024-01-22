<x-layout>
    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14">

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="/programare" method="post" class="max-w-lg mx-auto bg-white p-8 rounded shadow">
            @csrf

            <div class="mb-4">
                <label for="nume" class="block text-gray-600">Nume:</label>
                <input type="text" name="nume" id="nume" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-600">Email:</label>
                <input type="email" name="email" id="email" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="telefon" class="block text-gray-600">Telefon:</label>
                <input type="text" name="telefon" id="telefon" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="nr_inmatriculare" class="block text-gray-600">Nr. Înmatriculare:</label>
                <input type="text" name="nr_inmatriculare" id="nr_inmatriculare" class="form-input mt-1 block w-full"
                    required>
            </div>

            <div class="mb-4">
                <label for="mesaj" class="block text-gray-600">Mesaj:</label>
                <textarea name="mesaj" id="mesaj" class="form-textarea mt-1 block w-full" rows="4"></textarea>
            </div>

            <button type="submit" class="bg-economic-green text-white px-4 py-2 rounded">Trimite</button>
        </form>
    </div>
    </div>
</x-layout>
