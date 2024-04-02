<x-layout>
    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold mb-4 text-center">Lista Programărilor</h1>

            @if ($programari->isEmpty())
                <p class="text-center">Nu există programări.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 shadow">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable('created_at')">
                                    Data creare
                                    @if ($sortBy === 'created_at')
                                        @if ($sortOrder === 'asc')
                                            <span>&#9650;</span>
                                        @else
                                            <span>&#9660;</span>
                                        @endif
                                    @endif
                                </th>
                                <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable('nume')">
                                    Nume
                                    @if ($sortBy === 'nume')
                                        @if ($sortOrder === 'asc')
                                            <span>&#9650;</span>
                                        @else
                                            <span>&#9660;</span>
                                        @endif
                                    @endif
                                </th>
                                <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable('email')">
                                    Email
                                    @if ($sortBy === 'email')
                                        @if ($sortOrder === 'asc')
                                            <span>&#9650;</span>
                                        @else
                                            <span>&#9660;</span>
                                        @endif
                                    @endif
                                </th>
                                <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable('nr')">
                                    Telefon
                                    @if ($sortBy === 'nr')
                                        @if ($sortOrder === 'asc')
                                            <span>&#9650;</span>
                                        @else
                                            <span>&#9660;</span>
                                        @endif
                                    @endif
                                </th>
                                <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable('nr_inmatriculare')">
                                    Nr. Înmatriculare
                                    @if ($sortBy === 'nr_inmatriculare')
                                        @if ($sortOrder === 'asc')
                                            <span>&#9650;</span>
                                        @else
                                            <span>&#9660;</span>
                                        @endif
                                    @endif
                                </th>
                                <th class="py-2 px-4 border-b cursor-pointer" onclick="sortTable('data_programare')">
                                    Data dorita
                                    @if ($sortBy === 'data_programare')
                                        @if ($sortOrder === 'asc')
                                            <span>&#9650;</span>
                                        @else
                                            <span>&#9660;</span>
                                        @endif
                                    @endif
                                </th>
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
                                    <td class="py-2 px-4 border-b">{{ $programare->nr }}</td>
                                    <td class="py-2 px-4 border-b">{{ $programare->nr_inmatriculare }}</td>
                                    <td class="py-2 px-4 border-b">
                                        {{ \Carbon\Carbon::parse($programare->data_programare)->isoFormat('dddd, D MMMM YYYY') }}
                                    </td>
                                    <td class="py-2 px-4 border-b">
                                        <x-bladewind.button onclick="showModal('programare-{{ $programare->id }}')"
                                            color="green">
                                            <svg height="20px" fill="#fff" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 576 512">
                                                <path
                                                    d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                            </svg>
                                        </x-bladewind.button>

                                        <x-bladewind.modal name="programare-{{ $programare->id }}" type="info"
                                            okButtonLabel="" cancelButtonLabel="">
                                            {{ $programare->mesaj }}
                                        </x-bladewind.modal>

                                    </td>
                                    <td class="py-2 px-4 border-b">
                                        @if (auth()->user()->hasRole('admin'))
                                            <form action="{{ route('update.acceptata', $programare->id) }}"
                                                method="POST" class="space-y-2">
                                                @csrf
                                                @method('PATCH')
                                                <select name="acceptata" onchange="this.form.submit()"
                                                    class="block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:border-economic-darkgreen focus:ring focus:ring-economic-darkgreen focus:ring-opacity-50">
                                                    <option value="0"
                                                        {{ $programare->acceptata === 0 ? 'selected' : '' }}>
                                                        Neacceptată</option>
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

        <div class="my-4">
            {{ $programari->links('vendor.pagination.tailwind') }}
        </div>

    </div>

    @if (session('success'))
        <x-flash-message type="success" :message="session('success')" />
    @endif

    @if (session('error'))
        <x-flash-message type="error" :message="session('error')" />
    @endif
</x-layout>

<script defer>
    function sortTable(columnName) {
        const currentUrl = new URL(window.location.href);
        const params = new URLSearchParams(currentUrl.search);
        const sort = params.get('sort');
        const order = params.get('order');

        let newOrder;
        if (sort === columnName) {
            newOrder = order === 'asc' ? 'desc' : 'asc';
        } else {
            newOrder = 'asc';
        }

        params.set('sort', columnName);
        params.set('order', newOrder);

        currentUrl.search = params.toString();
        window.location.href = currentUrl.toString();
    }

    setInterval(function() {
        location.reload();
    }, 300000); // Actualizează pagina la fiecare 5 minute (300,000 milisecunde)
</script>
