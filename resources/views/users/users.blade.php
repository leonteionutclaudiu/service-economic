<x-layout>
    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14 mt-5">
        <h1 class="text-2xl font-bold mb-4 text-center">Utilizatori Înregistrați</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 shadow">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-start">Nume</th>
                        <th class="py-2 px-4 border-b text-start">Email</th>
                        <th class="py-2 px-4 border-b text-start">Rol</th>
                        <th class="py-2 px-4 border-b text-start">Administrare utilizator</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b">{{ implode(', ', $user->roles->pluck('name')->toArray()) }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('user.edit', $user->id) }}"
                                    class="block w-fit transition hover:text-economic-darkgreen hover:fill-economic-darkgreen"><svg
                                        height="26px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                    </svg></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (session('success'))
        <x-flash-message type="success" :message="session('success')" />
    @endif
</x-layout>
