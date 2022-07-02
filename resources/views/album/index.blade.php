<x-page-parts.center-rectangle-header page="album"/>
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Crear una album para la temporada</h1>
</div>
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" aria-route="{{ route("temporada.index") }}">
    @foreach ($temporadas as $temporada)
        @if(count($temporada->albums) == 0)
            <x-temporada.card :id="$temporada->id" :delete=false :link='route("temporada.album.create", ["temporada" => $temporada])' title="{{$temporada->nom_temporada}}" subtitle="{{$temporada->content}}" :elements="null"/>
        @endif
    @endforeach
</div>

<x-page-parts.center-rectangle-footer />
