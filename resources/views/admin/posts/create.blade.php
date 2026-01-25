<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Crear Post</h2>
    </x-slot>

    <div class="p-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            {{-- Título --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Título</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="w-full p-2 border rounded"
                    placeholder="Título del post"
                    required
                >
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Extracto --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Extracto</label>
                <textarea
                    name="excerpt"
                    class="w-full p-2 border rounded"
                    rows="3"
                    placeholder="Resumen corto del post"
                >{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contenido --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Contenido</label>
                <textarea
                    id="content-editor"
                    name="content"
                    class="w-full p-2 border rounded"
                    rows="12"
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Estado --}}
            <div class="mb-6">
                <label class="block font-medium mb-1">Estado</label>
                <select name="status" class="p-2 border rounded">
                    <option value="draft" @selected(old('status') === 'draft')>Borrador</option>
                    <option value="published" @selected(old('status') === 'published')>Publicado</option>
                </select>
            </div>

            {{-- Botón --}}
            <button type="submit" class="bg-black text-white px-4 py-2 rounded">
                Guardar Post
            </button>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/6/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: '#content-editor',
                height: 420,
                menubar: false,
                plugins: 'lists link image code table',
                toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image table | code',
            });
        </script>
    @endpush
</x-app-layout>
