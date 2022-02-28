<x-page-parts.header page="user"/>

<div class="max-w-7xl w-full grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-4 mx-auto p-2 sm:p-6 lg:p-8">
    <div class="">
        <div class="p-8 bg-white shadow-lg rounded-lg text-center">
            <img src="{{ isset($user->image) ? asset($user->image) : asset('images/uploads/profiles/no_image/no_image.jpg') }}" alt="" class="w-full rounded-lg mb-4">
            <h3 class="text-xl font-bold mb-2">{{ $user->name . " " . $user->surname }}</h3>
            <h4 class="font-bold text-sm opacity-50 italic">{{ $user->username }}</h4>
            @if((session()->get('user')->role != "player" && session()->get('user')->role != "moderator") || session()->get('user')->id == $user->id)
                <div class="mt-8">
                    <x-elements.link :href="route('user.update', ['id' => $user->id])" text="Editar"/>
                </div>
            @endif
        </div>
    </div>
    <div class="md:col-span-2 p-10 text-left bg-white shadow-lg rounded-lg" id="bioContainer">
        @foreach($user_bios as $user_bio)
            <div class="mb-8">
                <div class="w-full mb-4 flex items-end items-baseline gap-2"
                    {{ (session()->get("user")->role != "player") ? "aria-route=". route("user.bio.get") :"" }}
                    {{ (session()->get("user")->role != "player") ? "aria-repeat=2":"" }} >
                    <h3 class="font-bold text-xl align-baseline">{{ $user_bio->title }}</h3>
                    <h4 class="font-bold text-sm text-gray-500 align-baseline">{{ $user_bio->subtitol }}</h4>
                    @if(session()->get('user')->role != "player")
                        <div class="justify-self-end" aria-id="{{$user_bio->id}}" aria-name="{{$user_bio->title}}">
                            <x-button.inline-delete />
                        </div>
                    @endif
                </div>
                <div class="text-justify">
                    {{ $user_bio->text }}
                </div>
            </div>
        @endforeach
        </div>
        @if(session()->get('user')->role != "player")
            <div class="md:col-span-2 md:col-start-2 p-10 text-left bg-white shadow-lg rounded-lg" id="bioContainer">
                <div>
                    <form id="addBioForm">
                        <div class="mb-4">
                            <h3 class="font-bold text-xl">Añadir nuevo apartado</h3>
                        </div>
                        <div class="flex flex-wrap gap-4 mb-4">
                            <div class="grow">
                                <div class="w-100">
                                    <label class="block ml-1 mb-3" for="title">Título</label>
                                    <x-input.no-label placeholder="Título" id="title" name="title"/>
                                </div>
                            </div>
                            <div class="grow">
                                <label class="block ml-1 mb-3" for="subtitle">Subtítulo</label>
                                <x-input.no-label placeholder="Subtítulo" id="subtitle" name="subtitle"/>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block ml-1 mb-3" for="text">Texto</label>
                            <x-input.textarea name="text" id="text" rows="5" placeholder="Texto"></x-input>
                        </div>
                        <div class="flex ">
                            <x-button type="submit" text="Añadir" />
                        </div>
                    </form>
                </div>
                <script>
                    document.querySelector("#addBioForm").addEventListener("submit", (e) => {
                        e.preventDefault();
                        const form = new FormData(e.target);
                        const title = form.get("title");
                        const subtitle = form.get("subtitle");
                        const text = form.get("text");
                        const bio = document.getElementById("bioContainer");

                        Swal.fire({
                            title: '<h1 class="font-medium leading-tight text-black text-4xl">Quieres añadir esta descripcion?</h1>',
                            icon: 'info',
                            customClass: {
                            confirmButton: 'flex items-center py-2 px-3 transition rounded-full duration-150 text-white bg-black hover:opacity-100 hover:outline-none hover:ring-2 hover:ring-offset-2 hover:ring-offset-white-800 hover:ring-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white-800 focus:ring-black',
                            },
                            html:
                            `<div class="w-full mb-4 flex items-end gap-2">` +
                                `<h3 class="font-bold text-xl">${title}</h3>` +
                                `<h4 class="font-bold text-sm opacity-50 italic leading-6" style="line-height: 1.3rem;">${subtitle}</h4>` +
                            `</div>` +
                            `<div class="text-justify">${text}</div>`,
                            showCloseButton: true,
                            focusConfirm: false,
                            buttonsStyling: false,
                            confirmButtonText:
                            'Añadir!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url:'{{ route("user.bio.add", ["id" => $user->id]) }}',
                                    data:{'title':title, 'subtitle':subtitle, 'text':text },
                                    type:'POST',
                                    success: function (response) {
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Apartado creado'
                                        });
                                        bio.innerHTML += `<div class="mb-8"><div class="w-full mb-4 flex items-end gap-2">` +
                                            `<h3 class="font-bold text-xl">${title}</h3>` +
                                            `<h4 class="font-bold text-sm opacity-50 italic leading-6" style="line-height: 1.3rem;">${subtitle}</h4>` +
                                        `</div>` +
                                        `<div class="text-justify">${text}</div></div>`;
                                        document.getElementById("addBioForm").reset();
                                    },
                                    statusCode: {
                                        404: function() {
                                            console.log('web not found');
                                        },
                                        409: function(response) {
                                            console.log(response.responseJSON.message)
                                        },
                                        500: function(response) {
                                            console.log(response.responseJSON.message);
                                        }
                                    },
                                    error:function(response){
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.responseJSON.message
                                    });
                                    }
                                });
                            }
                        })
                    });
                </script>
            </div>
        @endif
</div>

<x-page-parts.footer/>
