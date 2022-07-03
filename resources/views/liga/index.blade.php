<x-page-parts.center-rectangle-header page="ligas" />
<?php $i = 0; ?>
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Ligas</h1>
</div>
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" aria-route="{{ route('liga.index') }}">
    @foreach ($ligas as $liga)
        <?php $i++; ?>
        <x-temporada.card :id="$liga->id" :link="route('liga.show', ['liga' => $liga])" title="{{ $liga->name }}"
            subtitle="{{ $liga->content }}" :elements="null" />
    @endforeach
    @if (session()->get('user')->role != 'player')
        <a href="#" id="addSeason"
            class="grid max-w-sm p-6 text-gray-200 bg-white border-4 border-gray-200 border-dashed rounded-lg place-items-center hover:bg-gray-100">
            <div>
                <p class="mb-2 text-gray-300">Añadir Liga</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </a>
    @endif
</div>

<script>
    $(document).ready(function() {
        let order = {{ $i }};

        $('#addSeason').on('click', function() {
            Swal.fire({
                title: '<h1 class="text-5xl font-medium leading-tight text-black">Añadir usuario</h1>',
                icon: 'info',
                customClass: {
                    confirmButton: 'flex items-center py-2 px-3 transition rounded-full duration-150 text-white bg-black hover:opacity-100 hover:outline-none hover:ring-2 hover:ring-offset-2 hover:ring-offset-white-800 hover:ring-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white-800 focus:ring-black',
                },
                html: `<div class="grid grid-cols-2 gap-4 p-2 text-left">
            <div>
              <label class="block mb-3 ml-1" for="name">Nombre</label>
              <x-input.no-label placeholder="Nombre" id="name" name="name"/>
            </div>
            <div>
              <label class="block mb-3 ml-1" for="subname">Subtítulo</label>
              <x-input.no-label placeholder="Subtítulo" id="subname" name="subname"/>
            </div>
            <div>
              <label class="block mb-3 ml-1" for="color">Color</label>
              <x-input.no-label placeholder="Color" id="color" name="color"/>
            </div>
            <div>
              <label class="block mb-3 ml-1" for="initials">Iniciales</label>
              <x-input.no-label placeholder="Iniciales" id="initials" name="initials"/>
            </div>
            <div class="col-span-2">
              <label class="block mb-3 ml-1" for="content">Text</label>
              <textarea placeholder="Text" id="content" name="content" class="w-full px-4 py-2 transition duration-150 border border-black rounded-2xl hover:outline-none hover:ring-2 hover:ring-offset-2 hover:ring-offset-white-800 hover:ring-black focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-offset-white-800 focus:ring-black"></textarea>
            </div>
          </div>`,
                showCloseButton: true,
                focusConfirm: false,
                buttonsStyling: false,
                confirmButtonText: 'Añadir!',
            }).then((result) => {
                if (result.isConfirmed) {
                    const name = $("#name").val();
                    const subname = $("#subname").val();
                    const content = $("#content").val();
                    const color = $("#color").val();
                    const initials = $("#initials").val();

                    $.ajax({
                        url: '{{ route('liga.store') }}',
                        data: {
                            'name': name,
                            'subname': subname,
                            'content': content,
                            'color': color,
                            'order': order,
                            'initials': initials
                        },
                        type: 'POST',
                        success: function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Temporada creada'
                            });
                            const content = `<a href="#" aria-id="${response.id}" aria-name="${response.name}" class="relative block max-w-sm p-6 bg-white border border-gray-100 rounded-lg shadow-md hover:bg-gray-100">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">${response.name}</h5>
                                <p class="font-normal text-gray-700">${response.content}</p>
                                <div class="absolute text-red-200 right-4 bottom-4 hover:text-red-500" aria-action="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                </div>
                                </a>`;
                            $("#addSeason").before(content);
                            order++;
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
                        error: function(response) {
                            Toast.fire({
                                icon: 'error',
                                title: response.responseJSON.message
                            });
                        }
                    });
                }
            })
        });
    });
</script>

<x-page-parts.center-rectangle-footer />
