<x-page-parts.center-rectangle-header page="galeria" />
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Crear una galeria para la temporada</h1>
</div>
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" aria-route="{{ route('temporada.index') }}">
    @foreach ($temporadas as $temporada)
        <x-temporada.card :id="$temporada->id" :delete=false :link="route('temporada.galeria.create', ['temporada' => $temporada])" title="{{ $temporada->nom_temporada }}"
            subtitle="{{ $temporada->content }}" :elements="$temporada
                ->galleries()
                ->take(3)
                ->get() ?? null" />
    @endforeach
</div>

<x-page-parts.center-rectangle-footer />
