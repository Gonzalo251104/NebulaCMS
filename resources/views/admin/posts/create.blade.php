<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Crear Post</h2>
    </x-slot>

    <div class="p-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <input class="w-full mb-4 p-2 border" name="title" placeholder="Título">

            <textarea class="w-full mb-4 p-2 border" name="excerpt" placeholder="Extracto"></textarea>

            <textarea class="w-full mb-4 p-2 border" name="content" rows="8" placeholder="Contenido"></textarea>

            <select name="status" class="mb-4 p-2 border">
                <option value="draft">Borrador</option>
                <option value="published">Publicado</option>
            </select>

            <button class="bg-black text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
