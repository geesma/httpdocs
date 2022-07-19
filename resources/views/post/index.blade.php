<x-page-parts.center-rectangle-header page="post" class="relative" />

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Resumenes de la jornada</h1>
    <div>
        <a href="{{ route('post.create') }}"
            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            Crear nuevo resumen
        </a>
    </div>
</div>
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" aria-route="{{ route('temporada.index') }}">
    @foreach ($posts as $post)
        <x-noticia-card :post="$post" />
    @endforeach
</div>

<x-page-parts.center-rectangle-footer />
