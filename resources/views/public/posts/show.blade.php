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
