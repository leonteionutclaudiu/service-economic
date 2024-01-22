<x-layout>
    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14">
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-4">Lista Programărilor</h1>

            @if ($programari->isEmpty())
                <p>Nu există programări.</p>
            @else
                <table class="min-w-full bg-white border border-gray-300 shadow">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Nume</th>
                            <th class="py-2 px-4 border-b">Email</th>
                            <th class="py-2 px-4 border-b">Telefon</th>
                            <th class="py-2 px-4 border-b">Nr. Înmatriculare</th>
                            <th class="py-2 px-4 border-b">Mesaj</th>
                            <th class="py-2 px-4 border-b">Data Creare</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programari as $programare)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $programare->nume }}</td>
                                <td class="py-2 px-4 border-b">{{ $programare->email }}</td>
                                <td class="py-2 px-4 border-b">{{ $programare->telefon }}</td>
                                <td class="py-2 px-4 border-b">{{ $programare->nr_inmatriculare }}</td>
                                <td class="py-2 px-4 border-b">{{ $programare->mesaj }}</td>
                                <td class="py-2 px-4 border-b">{{ $programare->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-layout>

<script>
    setInterval(function() {
        location.reload();
    }, 300000); // Actualizează pagina la fiecare 5 minute (300,000 milisecunde)
</script>
