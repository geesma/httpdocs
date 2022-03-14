<x-page-parts.center-rectangle-header page="ligas"/>
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Ligas de la {{ $temporada->nom_temporada }}</h1>
</div>
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
    @for ($i=0; $i < count($ligas); $i++)
        <x-temporada.card :id="$ligas[$i]->id" :link='route("temporada.liga.edit", ["temporada" => $temporada, "liga" => $ligas[$i]->id])' :title="$ligas[$i]->name" :subtitle="$ligas[$i]->content" :elements="null"/>
    @endfor
</div>

<x-page-parts.center-rectangle-footer />
