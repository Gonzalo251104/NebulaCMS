<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Posts</h2>
    </x-slot>

    <div class="p-6 max-w-7xl mx-auto">
        <a href="{{ route('posts.create') }}" class="bg-black text-white px-4 py-2 rounded">
            Nuevo Post
        </a>

        <table class="mt-6 w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Título</th>
                    <th class="p-2">Estado</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr class="border-t">
                    <td class="p-2">{{ $post->title }}</td>
                    <td class="p-2">{{ $post->status }}</td>
                    <td class="p-2 flex gap-2">
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="underline">Editar</a>
                        @endcan

                        @can('delete', $post)
                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Eliminar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
