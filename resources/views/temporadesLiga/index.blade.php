<x-page-parts.center-rectangle-header page="clasificacion"/>
<?php $i = 0; ?>
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Ligas de la {{ $temporada->nom_temporada }}</h1>
</div>
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" aria-route="{{ route("liga.index") }}">
    @foreach ($temporada->ligas()->groupBy('name')->orderBy('liga_id')->get() as $liga)
        <?php $i++; ?>
        <x-temporada.card :id="$liga->id" :link='route("temporada.liga.show", ["liga" => $liga, "temporada" => $temporada])' title="{{$liga->name}}" subtitle="{{$liga->content}}" :elements="$temporada->users($liga->id)->orderBy('points', 'desc')->take(3)->get()"/>
    @endforeach
    @if(session()->get('user')->role != "player" && $i < 3)
        <a href="{{ route('temporada.liga.create', ['temporada' => $temporada]) }}" id="addSeason" class="grid max-w-sm p-6 text-gray-200 bg-white border-4 border-gray-200 border-dashed rounded-lg place-items-center hover:bg-gray-100">
            <div>
                <p class="mb-2 text-gray-300">Añadir Liga</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </a>
    @endif
</div>

<x-page-parts.center-rectangle-footer />
