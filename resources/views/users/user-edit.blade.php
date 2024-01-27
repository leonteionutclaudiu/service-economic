<x-layout>
    <div class="px-2 py-6 mx-auto md:px-12 lg:py-20 md:py-14 mt-5">
        <a href="{{ route('users.index') }}" class="text-sm text-gray-600 mb-2 block">
            <span class="inline-block align-middle">&larr;</span> Înapoi la Utilizatori
        </a>

        <h1 class="text-2xl font-bold mb-4 text-center">Administrare Roluri - {{ $user->name }}</h1>

        <form action="{{ route('user.update-roluri', $user->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="mb-4 w-fit mx-auto">
                <label class="block text-gray-600 font-bold">Alege rolurile:</label>
                <div class="flex flex-wrap gap-4">
                    @foreach ($roles as $role)
                        <div class="flex items-center mt-1">
                            <input type="checkbox" name="roles[]" id="{{ $role->name }}" value="{{ $role->name }}"
                                class="ring-economic-darkgreen hover:ring-2"
                                {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                            <label for="{{ $role->name }}" class="ml-2">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit"
                class="hover:bg-economic-red transition bg-economic-darkgreen text-white px-4 py-2 rounded mx-auto block text-xl">Salvează
                Rolurile</button>
        </form>
    </div>
</x-layout>
