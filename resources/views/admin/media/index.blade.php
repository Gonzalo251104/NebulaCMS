<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Media Library</h2>
    </x-slot>

    <div class="p-6 max-w-7xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-4 rounded bg-green-100">
                {{ session('success') }}
            </div>
        @endif

        @if ($files->count() === 0)
            <div class="bg-white p-6 rounded shadow-sm">
                <p>No hay imágenes en la biblioteca (editor/).</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($files as $file)
                    @php
                        $url = asset('storage/' . $file);
                    @endphp

                    <div class="bg-white rounded shadow-sm border overflow-hidden">
                        <img src="{{ $url }}" alt="media" class="w-full h-40 object-cover">

                        <div class="p-3 text-sm">
                            <div class="truncate font-medium">{{ $file }}</div>

                            <div class="mt-2 flex gap-2">
                                <button
                                    type="button"
                                    class="px-3 py-1 border rounded"
                                    onclick="navigator.clipboard.writeText('{{ $url }}')"
                                >
                                    Copiar URL
                                </button>

                                <form method="POST" action="{{ route('admin.media.destroy') }}"
                                      onsubmit="return confirm('¿Eliminar esta imagen?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="path" value="{{ $file }}">
                                    <button class="px-3 py-1 border rounded text-red-600">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
