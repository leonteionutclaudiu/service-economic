<x-layout>
    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14">

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center gap-10 flex-col lg:flex-row w-fit mx-auto">

            <div class="text-center max-w-[75ch] w-fit mx-auto flex items-center flex-col gap-4">
                <h5>Simplificați-vă viața programând service-ul auto online! Completați formularul nostru rapid și ușor
                    pentru a asigura îngrijirea optimă a vehiculului dvs. Echipa noastră calificată este pregătită să vă
                    ofere servicii de înaltă calitate.</h5>
                <img src="{{ asset('images/programare.jpeg') }}" alt="Logo" class="h-auto" />
            </div>

            <form action="/programare" method="post"
                class="max-w-lg mx-auto bg-white p-8 rounded shadow flex-grow w-full">
                @csrf

                <h4 class="text-center mb-4">Formular programare service</h4>

                <div class="mb-4">
                    <label for="nume" class="block text-gray-600 font-bold">Nume:</label>
                    <input type="text" name="nume" id="nume"
                        class="mt-1 block w-full ring-economic-darkgreen hover:ring-2" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-600 font-bold">Email:</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full ring-economic-darkgreen hover:ring-2" required>
                </div>

                <div class="mb-4">
                    <label for="telefon" class="block text-gray-600 font-bold">Telefon:</label>
                    <input type="text" name="telefon" id="telefon"
                        class="mt-1 block w-full ring-economic-darkgreen hover:ring-2" required>
                </div>

                <div class="mb-4">
                    <label for="nr_inmatriculare" class="block text-gray-600 font-bold">Nr. Înmatriculare:</label>
                    <input type="text" name="nr_inmatriculare" id="nr_inmatriculare"
                        class="mt-1 block w-full ring-economic-darkgreen hover:ring-2" required>
                </div>

                <div class="mb-4">
                    <label for="mesaj" class="block text-gray-600 font-bold">Mesaj:</label>
                    <textarea name="mesaj" id="mesaj" class="mt-1 block w-full ring-economic-darkgreen hover:ring-2" rows="4"></textarea>
                </div>

                <button type="submit"
                    class="hover:bg-economic-red transition bg-economic-darkgreen text-white px-4 py-2 rounded w-full text-xl">Solicit
                    programare nouă</button>
            </form>
        </div>
    </div>
    </div>
</x-layout>
