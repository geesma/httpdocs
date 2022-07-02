<x-page-parts.center-rectangle-header page="galeria"/>
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Galeria de la {{ $temporada->nom_temporada }}</h1>
    @if(session()->get('user')->role != 'player')
    <a href="{{ route('temporada.galeria.edit', ['temporada' => $temporada]) }}"><x-button.edit/></a>
    @endif
</div>

<div id="lightgallery" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
    @foreach ($images as $image)
        <a href="{{ asset($image->filename) }}">
            <img alt="img1" src="{{ asset($image->filename) }}" />
        </a>
    @endforeach
</div>
<script type="text/javascript">

    lightGallery(document.getElementById('lightgallery'), {
        plugins: [lgZoom, lgThumbnail],
        licenseKey: 'gplv3',
        speed: 200
    });

</script>

<x-page-parts.center-rectangle-footer />
