@extends('layouts.public')

@section('content')
<div class="py-12">
    <div class="max-w-5xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Publicaciones</h1>

        @if ($posts->count() === 0)
            <div class="bg-white p-6 rounded shadow-sm">
                <p>No hay posts publicados todavía.</p>
            </div>
        @endif

        <div class="space-y-4">
            @foreach ($posts as $post)
                <article class="bg-white p-6 rounded shadow-sm">
                    <h2 class="text-2xl font-semibold">
                        <a class="underline" href="{{ route('public.posts.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <p class="text-sm text-gray-600 mt-1">
                        Publicado: {{ optional($post->published_at)->format('d/m/Y H:i') ?? '—' }}
                    </p>

                    @if ($post->excerpt)
                        <p class="mt-3 text-gray-800">{{ $post->excerpt }}</p>
                    @endif

                    <div class="mt-4">
                        <a class="underline" href="{{ route('public.posts.show', $post->slug) }}">
                            Leer más →
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
