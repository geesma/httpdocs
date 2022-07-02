<x-page-parts.header page="post"/>

<div class="grid w-full p-2 mx-auto max-w-7xl center sm:p-6 lg:p-8">
    <div class="">
        <div class="p-8 bg-white rounded-lg shadow-lg ">
            <form enctype="multipart/form-data" method="POST" action="{{route("post.store")}}">
                @csrf
                <div class="flex items-center mb-8 space-x-6">
                  <label class="block">
                    <span class="sr-only">Elige la foto de portada</span>
                    <x-input.file name="image"/>
                  </label>
                </div>
                <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2">
                    <div class="">
                        <div class="w-100">
                            <label class="block mb-3 ml-1" for="titulo">Titulo</label>
                            <x-input.no-label placeholder="Titulo" id="titulo" name="titulo"/>
                        </div>
                    </div>
                    <div class="">
                        <div class="w-100">
                            <label class="block mb-3 ml-1" for="subtitulo">Subtitulo</label>
                            <x-input.no-label placeholder="Subtitulo" id="subtitulo" name="subtitulo"/>
                        </div>
                    </div>
                    <div class="">
                        <div class="w-100">
                            <label class="block mb-3 ml-1" for="liga">Liga</label>
                            <select name="liga" id="liga">
                                <option value="0" selected="selected">Ninguna liga</option>
                                @foreach ($ligas as $liga)
                                    <option value="{{ $liga->id }}">{{ $liga->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div class="w-100">
                            <label class="block mb-3 ml-1" for="temporada">Temporada</label>
                            <select name="temporada" id="Liga"> --}}
                                <option value="0" selected="selected">Ninguna temporada</option>
                                @foreach ($temporadas as $liga)
                                    <option value="{{ $liga->id }}">{{ $liga->nom_temporada }}</option>
                                @endforeach
                            </select>
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
    </div>
</div>

<x-page-parts.footer/>
