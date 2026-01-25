@extends('layouts.public')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto px-4">
        <a class="underline" href="{{ route('public.home') }}">← Volver</a>

        <article class="bg-white p-6 rounded shadow-sm mt-4">
            <h1 class="text-3xl font-bold">{{ $post->title }}</h1>

            <p class="text-sm text-gray-600 mt-2">
                Publicado: {{ optional($post->published_at)->format('d/m/Y H:i') ?? '—' }}
            </p>

            {{-- Imagen destacada --}}
            @if ($post->featured_image)
                <img
                    class="w-full rounded mt-4 mb-6 border"
                    src="{{ asset('storage/' . $post->featured_image) }}"
                    alt="{{ $post->title }}"
                >
            @endif

            @if ($post->excerpt)
                <p class="mt-4 text-gray-800">{{ $post->excerpt }}</p>
            @endif

            <hr class="my-6">

            {{-- contenido HTML del editor --}}
            <div class="prose max-w-none">
                {!! $post->content !!}
            </div>
        </article>
    </div>
</div>
@endsection
