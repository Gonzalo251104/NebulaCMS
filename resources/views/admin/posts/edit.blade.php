<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Editar Post</h2>
    </x-slot>

    <div class="p-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf @method('PUT')

            <input class="w-full mb-4 p-2 border" name="title" value="{{ $post->title }}">

            <textarea class="w-full mb-4 p-2 border" name="excerpt">{{ $post->excerpt }}</textarea>

            <textarea class="w-full mb-4 p-2 border" name="content" rows="8">{{ $post->content }}</textarea>

            <select name="status" class="mb-4 p-2 border">
                <option value="draft" @selected($post->status==='draft')>Borrador</option>
                <option value="published" @selected($post->status==='published')>Publicado</option>
            </select>

            <button class="bg-black text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
