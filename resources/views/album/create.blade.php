<x-page-parts.center-rectangle-header page="album" />

<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Crear una album para la temporada
        {{ $temporada->id }}</h1>
</div>
<div class="">
    <form enctype="multipart/form-data" method="POST" action="{{ route('temporada.album.save', ['temporada' => $temporada]) }}">
        @csrf
        <div class="flex items-center mb-8 space-x-6">
            <label class="block">
                <span class="sr-only">Importa el pd del album</span>
                <x-input.file name="album" />
            </label>
        </div>
        <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2">
            <div class="">
                <div class="w-100">
                    <label class="block mb-3 ml-1" for="titulo">Titulo<x-asterisk/></label>
                    <x-input.no-label placeholder="Titulo" id="titulo" name="titulo" />
                </div>
            </div>
            <div class="">
                <div class="w-100">
                    <label class="block mb-3 ml-1" for="subtitulo">Subtitulo</label>
                    <x-input.no-label placeholder="Subtitulo" id="subtitulo" name="subtitulo" />
                </div>
            </div>
            <div class="col-span-2">
                <div class="w-100">
                    <label class="block mb-3 ml-1" for="content">Content</label>
                    <x-input.textarea name="content" id="content" />
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="p-4 mb-8 text-orange-700 bg-orange-100 border-l-4 border-orange-500" role="alert">
                <p class="font-bold">Ha habido un error</p>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="flex ">
            <x-button type="submit" text="Guardar" />
        </div>
    </form>
</div>

<x-page-parts.center-rectangle-footer />
