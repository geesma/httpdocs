<x-page-parts.center-rectangle-header page="clasificacion" />

<div class="flex flex-wrap items-baseline gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Clasificación histórica</h1>
</div>
<table class="overflow-x-scroll">
    <thead>
        <tr>
            <th class="px-4 py-2">Jugador</th>
            @foreach ($data[0] as $temporada)
                <th class="px-4 py-2">{{ $temporada['nom_temporada'] }}</th>
            @endforeach
            <th class="px-4 py-2">Puntos totales</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data[1] as $user)
            <tr style="color: {{ $user['player_data']['totals']['color'] }}">
                <td class="px-4 py-2">{{ $user['player_username'] }}</td>
                @foreach ($user['player_data']['temporadas'] as $temporada)
                    <td class="px-4 py-2">{{ $temporada['points'] }}</td>
                @endforeach
                <td class="px-4 py-2">{{ $user['player_points'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<x-page-parts.center-rectangle-footer />
