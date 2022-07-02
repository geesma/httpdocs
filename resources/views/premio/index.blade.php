<x-page-parts.center-rectangle-header page="ligas" />
<?php $i = 0; ?>
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Galas de premios</h1>
</div>
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" aria-route="{{ route('premio.index') }}">
    @foreach ($premios as $premio)
        <?php $i++; ?>
        <x-temporada.card :id="$premio->id" :link="route('premio.show', ['premio' => $premio])" title="{{ $premio->title }}"
            subtitle="{{ $premio->temporada->nom_temporada }}" :elements="null" />
    @endforeach
    @if (session()->get('user')->role != 'player')
        <a href="#" id="addSeason"
            class="grid max-w-sm p-6 text-gray-200 bg-white border-4 border-gray-200 border-dashed rounded-lg place-items-center hover:bg-gray-100">
            <div>
                <p class="mb-2 text-gray-300">Añadir premio</p>
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
                title: '<h1 class="text-5xl font-medium leading-tight text-black">Añadir gala de premios</h1>',
                icon: 'info',
                customClass: {
                    confirmButton: 'flex items-center py-2 px-3 transition rounded-full duration-150 text-white bg-black hover:opacity-100 hover:outline-none hover:ring-2 hover:ring-offset-2 hover:ring-offset-white-800 hover:ring-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white-800 focus:ring-black',
                },
                html: `<div class="grid grid-cols-2 gap-4 p-2 text-left">
                    <div class="col-span-2">
                    <label class="block mb-3 ml-1" for="name">Nombre</label>
                    <x-input.no-label placeholder="Nombre" id="name" name="name"/>
                    </div>
                    <div class="col-span-2">
                    <label class="block mb-3 ml-1" for="temporada">Temporda</label>
                    <select id="temporada">
                        @foreach ($temporadas as $temporada)
                            <option value="{{ $temporada->id }}">{{ $temporada->nom_temporada }}</option>
                        @endforeach
                    </select>
                    </div>
                    </div>`,
                showCloseButton: true,
                focusConfirm: false,
                buttonsStyling: false,
                confirmButtonText: 'Añadir!',
            }).then((result) => {
                if (result.isConfirmed) {
                    const name = $("#name").val();
                    const temporada = $("#temporada").val();
                    const temporada_name = $("#temporada option:selected").text();
                    const content = "Cambia el texto";
                    $.ajax({
                        url: '{{ route('premio.store') }}',
                        data: {
                            'title': name,
                            'temporada_id': temporada,
                            'content': content,
                        },
                        type: 'POST',
                        success: function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Temporada creada'
                            });
                            console.log({ response });
                            const content = '<a href="{{ route('premio.index') }}/'+ response.id +'" aria-id="' + response.id +
                                '" aria-name="' + response.title +
                                '" class="relative block max-w-sm p-6 bg-white border border-gray-100 rounded-lg shadow-md hover:bg-gray-100">' +
                                '<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">' +
                                response.title + '</h5>' +
                                '<p class="font-normal text-gray-700">' + temporada_name + '</p>' +
                                '</a>';
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
