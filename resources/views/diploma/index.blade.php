<x-page-parts.center-rectangle-header page="premios" />
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Diplomas de la {{ $temporada->nom_temporada }}</h1>
    @if (session()->get('user')->role != 'player')
        <a href="{{ route('temporada.diploma.edit', ['temporada' => $temporada]) }}">
            <x-button.edit />
        </a>
    @endif
</div>

@foreach ($temporada->ligas()->groupBy('liga_id')->get()
    as $liga)
    <div class="mt-10 mb-8 col-span-full">
        <h2 class="text-3xl font-medium leading-tight align-baseline">{{ $liga->name }}</h2>
    </div>
    <div id="lightgallery{{ $liga->id }}" class="grid grid-cols-2 gap-8 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($liga->diplomas()->where('temporada_id', '=', $temporada->id)->get()
    as $index => $diploma)
            <a href="{{ asset($diploma->filename) }}">
                <img alt="{{ $temporada->nom_temporada }}: {{ $index + 1 }} clasificado de la {{ $liga->name }}"
                    src="{{ asset($diploma->filename) }}" />
            </a>
        @endforeach
    </div>
    <script type="text/javascript">
        lightGallery(document.getElementById('lightgallery{{ $liga->id }}'), {
            plugins: [lgZoom, lgThumbnail],
            licenseKey: 'gplv3',
            speed: 200
        });
    </script>
@endforeach

<x-page-parts.center-rectangle-footer />
