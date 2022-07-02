<x-page-parts.center-rectangle-header page="clasificacion"/>


<table class="overflow-x-scroll">
    <thead>
        <tr>
            <th>Jugador</th>
            @foreach($data[0] as $temporada)
                <th>{{ $temporada['nom_temporada'] }}</th>
            @endforeach
            <th>Puntos totales</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data[1] as $user)
            <tr style="color: {{ $user['player_data']['totals']['color'] }}">
                <td>{{ $user['player_username'] }}</td>
                @foreach ($user['player_data']['temporadas'] as $temporada)
                    <td>{{ $temporada['points'] }}</td>
                @endforeach
                <td>{{ $user['player_points'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<x-page-parts.center-rectangle-footer />
