<x-page-parts.header page="user"/>

<div class="grid w-full p-2 mx-auto max-w-7xl center sm:p-6 lg:p-8">
    <div class="">
        <div class="p-8 bg-white rounded-lg shadow-lg ">
            <form method="POST" action="{{route("user.update", ["id" => $user->id])}}">
                @csrf
                @method('PATCH')
                <div class="grid items-center grid-cols-3 mb-8 space-x-6 md:grid-cols-6">
                    @foreach($user->userImages as $image)
                        <div>
                            <input type="radio" id="image-{{$image->id}}" name="profile_image" {{ $user->image == $image->filename ? "checked" : "" }} value="{{$image->filename}}">
                            <label for="image-{{$image->id}}">
                                <img src="{{ asset($image->filename) }}" class="h-32 rounded-lg aspect-square" alt="">
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2">
                    <div class="">
                        <div class="w-100">
                            <label class="block mb-3 ml-1" for="nombre">Nombre</label>
                            <x-input.no-label placeholder="Nombre" id="nombre" name="nombre" :value="$user->name"/>
                        </div>
                    </div>
                    <div class="">
                        <div class="w-100">
                            <label class="block mb-3 ml-1" for="apellido">Apellido</label>
                            <x-input.no-label placeholder="Apellido" id="apellido" name="apellido" :value="$user->surname"/>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="w-100">
                            <label class="block mb-3 ml-1" for="username">Username</label>
                            <x-input.no-label placeholder="Username" id="username" name="username" :value="$user->username"/>
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

<style>
    /* HIDE RADIO */
[type=radio] {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + label {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + label > img {
  outline: 4px solid black;
}
</style>

<x-page-parts.footer/>
