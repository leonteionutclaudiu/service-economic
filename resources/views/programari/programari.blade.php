<x-layout>
    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14">
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold mb-4 text-center">Lista Programărilor</h1>

            @if ($programari->isEmpty())
                <p class="text-center">Nu există programări.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 shadow">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Data creare</th>
                                <th class="py-2 px-4 border-b">Nume</th>
                                <th class="py-2 px-4 border-b">Email</th>
                                <th class="py-2 px-4 border-b">Telefon</th>
                                <th class="py-2 px-4 border-b">Nr. Înmatriculare</th>
                                <th class="py-2 px-4 border-b">Data dorita</th>
                                <th class="py-2 px-4 border-b">Mesaj</th>
                                <th class="py-2 px-4 border-b">Status programare</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programari as $programare)
                                <tr>
                                    @php
                                        \Carbon\Carbon::setLocale('ro');
                                    @endphp
                                    <td class="py-2 px-4 border-b">
                                        {{ \Carbon\Carbon::parse($programare->created_at)->isoFormat('dddd, D MMMM YYYY, [ora] HH:mm') }}
                                    </td>
                                    <td class="py-2 px-4 border-b">{{ $programare->nume }}</td>
                                    <td class="py-2 px-4 border-b">{{ $programare->email }}</td>
                                    <td class="py-2 px-4 border-b">{{ $programare->telefon }}</td>
                                    <td class="py-2 px-4 border-b">{{ $programare->nr_inmatriculare }}</td>
                                    <td class="py-2 px-4 border-b">
                                        {{ \Carbon\Carbon::parse($programare->data_programare)->isoFormat('dddd, D MMMM YYYY') }}
                                    </td>
                                    <td class="py-2 px-4 border-b">{{ $programare->mesaj }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @if (auth()->user()->hasRole('admin'))
                                            <form action="{{ route('update.acceptata', $programare->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="acceptata" onchange="this.form.submit()">
                                                    <option value="0"
                                                        {{ $programare->acceptata === 0 ? 'selected' : '' }}>Neacceptată
                                                    </option>
                                                    <option value="1"
                                                        {{ $programare->acceptata === 1 ? 'selected' : '' }}>Acceptată
                                                    </option>
                                                </select>
                                            </form>
                                        @else
                                            {{ $programare->acceptata ? 'Acceptată' : 'Neacceptată' }}
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @if (session('success'))
        <x-flash-message type="success" :message="session('success')" />
    @endif

    @if (session('error'))
        <x-flash-message type="error" :message="session('error')" />
    @endif
</x-layout>

<script>
    setInterval(function() {
        location.reload();
    }, 300000); // Actualizează pagina la fiecare 5 minute (300,000 milisecunde)
</script>
