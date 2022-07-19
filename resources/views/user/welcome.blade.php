<x-page-parts.center-rectangle-header page="users" class="relative" />

<div class="flex flex-wrap items-baseline gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">{{ $user->name }}</h1>
    <h2 class="text-xl font-medium text-gray-500 align-baseline">Bienvenido</h2>
</div>
<div class="w-full mb-6 bg-white bg-center bg-cover border border-gray-100 rounded-lg shadow-md md:h-80 h-60 xl:h-128"
    style="background-image: url('{{ asset($user->image) }}')">

</div>
<h2 class="mb-6 text-2xl font-bold align-baseline">Resumen de la jornada</h2>
<div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2 lg:grid-cols-4" aria-route="{{ route('user.welcome') }}">
    @foreach ($posts as $post)
        <x-noticia-card :post="$post" />
    @endforeach
</div>
<h2 class="mb-6 text-2xl font-bold align-baseline">Classificación histórica</h2>
<table class="w-full mb-6 text-left">
    <thead>
        <tr>
            <th class="px-4 py-2">Temporada</th>
            <th class="px-4 py-2">Liga</th>
            <th class="px-4 py-2">Posición</th>
            <th class="px-4 py-2">Puntos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user_leagues as $liga)
            <tr class="cursor-pointer" onClick="gotoLeague({{ $liga['temporada_id'] }},{{ $liga['liga_id'] }})">
                <td class="px-4 py-2">{{ $liga['temporada_name'] }}</td>
                <td class="px-4 py-2">{{ $liga['liga_name'] }}</td>
                <td class="px-4 py-2">{{ $liga['position'] }}</td>
                <td class="px-4 py-2">{{ $liga['points'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    const gotoLeague = (temporada, liga) => {
        location.href = `/temporada/${temporada}/liga/${liga}`
    }
</script>

<x-elements.link :href="route('post.index')" text="Ver todos los resumenes" />

<x-page-parts.center-rectangle-footer />
