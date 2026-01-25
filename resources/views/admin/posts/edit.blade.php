<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Post</h2>
    </x-slot>

    <div class="p-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Título --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Título</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $post->title) }}"
                    class="w-full p-2 border rounded"
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
                >{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Imagen destacada</label>

                @if ($post->featured_image)
                    <img class="mb-3 rounded border max-h-56" src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured image">
                @endif

                <input type="file" name="featured_image" class="w-full p-2 border rounded" accept="image/*">
                @error('featured_image')
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
                    required
                >{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Estado --}}
            <div class="mb-6">
                <label class="block font-medium mb-1">Estado</label>
                <select name="status" class="p-2 border rounded">
                    <option value="draft" @selected($post->status === 'draft')>Borrador</option>
                    <option value="published" @selected($post->status === 'published')>Publicado</option>
                </select>
            </div>

            {{-- Botón --}}
            <button type="submit" class="bg-black text-white px-4 py-2 rounded">
                Actualizar Post
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
