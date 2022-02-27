<x-page-parts.header page="user"/>

<div class="max-w-7xl w-full grid center mx-auto p-2 sm:p-6 lg:p-8">
    <div class="">
        <div class="p-8 bg-white shadow-lg rounded-lg ">
            <form enctype="multipart/form-data" method="POST" action="{{route("user.update", ["id" => $user->id])}}">
                @csrf
                @method('PATCH')
                <div class="flex items-center space-x-6 mb-8">
                  <div class="shrink-0">
                    <img class="h-16 w-16 object-cover rounded-full" src="{{ isset($user->image) ? asset('images/uploads/profiles/'.$user->username.'/'.$user->image) : asset('images/uploads/profiles/no_image/no_image.jpg') }}" alt="Current profile photo" />
                  </div>
                  <label class="block">
                    <span class="sr-only">Elige la foto de perfil</span>
                    <x-input.file name="foto"/>
                  </label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <div class="">
                        <div class="w-100">
                            <label class="block ml-1 mb-3" for="nombre">Nombre</label>
                            <x-input.no-label placeholder="Nombre" id="nombre" name="nombre" :value="$user->name"/>
                        </div>
                    </div>
                    <div class="">
                        <div class="w-100">
                            <label class="block ml-1 mb-3" for="apellido">Apellido</label>
                            <x-input.no-label placeholder="Apellido" id="apellido" name="apellido" :value="$user->surname"/>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="w-100">
                            <label class="block ml-1 mb-3" for="username">Username</label>
                            <x-input.no-label placeholder="Username" id="username" name="username" :value="$user->username"/>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mb-8" role="alert">
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

<script>

$('input[name="foto"]').each(function () {
    $(this).rules('add', {
        required: true,
        accept: "image/jpeg, image/pjpeg"
    })
})

</script>

<x-page-parts.footer/>
