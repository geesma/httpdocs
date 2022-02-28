<x-page-parts.center-rectangle-header page="clasificacion"/>
<?php $i = 0; ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" aria-route="{{ route("temporada.index") }}">
    @foreach ($temporades as $temporada)
        <?php $i++; ?>
        <x-temporada.card :id="$temporada->id" :link='route("temporada.show", ["temporada" => $temporada])' title="{{$temporada->nom_temporada}}" subtitle="{{$temporada->content}}" elements="no"/>
    @endforeach
    @if(session()->get('user')->role != "player")
        <a href="#" id="addSeason" class="grid place-items-center p-6 max-w-sm bg-white rounded-lg border-4 border-dashed border-gray-200 text-gray-200 hover:bg-gray-100">
            <div>
                <p class="mb-2 text-gray-300">Añadir Temporada</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </a>
    @endif
</div>

<script>

$(document).ready(function() {
    let order = {{$i}};
    console.log(order);


    $('#addSeason').on('click', function() {
      Swal.fire({
        title: '<h1 class="font-medium leading-tight text-black text-5xl">Añadir usuario</h1>',
        icon: 'info',
        customClass: {
          confirmButton: 'flex items-center py-2 px-3 transition rounded-full duration-150 text-white bg-black hover:opacity-100 hover:outline-none hover:ring-2 hover:ring-offset-2 hover:ring-offset-white-800 hover:ring-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white-800 focus:ring-black',
        },
        html:
          '<div class="grid grid-cols-2 p-2 gap-4 text-left"> ' +
            '<div class=""> ' +
              '<label class="block ml-1 mb-3" for="nom_temporada">Nombre</label> ' +
              '<x-input.no-label placeholder="Nombre" id="nom_temporada" name="nom_temporada"/>' +
            '</div>' +
            '<div class=""> ' +
              '<label class="block ml-1 mb-3" for="nom_any">Número año inicial</label> ' +
              '<x-input.no-label placeholder="Año inicial" id="nom_any" name="nom_any"/>' +
            '</div>' +
            '<div class="col-span-2 mt-4">' +
              '<label class="block ml-1 mb-3" for="content">Text</label>' +
              '<textarea placeholder="Text" id="content" name="content" class="w-full px-4 py-2 transition rounded-2xl border border-black duration-150 hover:outline-none hover:ring-2 hover:ring-offset-2 hover:ring-offset-white-800 hover:ring-black focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-offset-white-800 focus:ring-black"></textarea>'+
            '</div>' +
          '</div>',
        showCloseButton: true,
        focusConfirm: false,
        buttonsStyling: false,
        confirmButtonText:
          'Añadir!',
      }).then((result) => {
        if (result.isConfirmed) {
          const nom_temporada = $("#nom_temporada").val();
          const nom_any = $("#nom_any").val();
          const content = $("#content").val();

          $.ajax({
            url:'{{ route("temporada.store") }}',
            data:{'nom_temporada':nom_temporada, 'nom_any':nom_any, 'content':content, 'order': order},
            type:'POST',
            success: function (response) {
              Toast.fire({
                icon: 'success',
                title: 'Temporada creada'
              });
                const content = '<a href="#" aria-id="'+response.id+'" aria-name="'+response.nom_temporada+'" class="relative block p-6 max-w-sm bg-white rounded-lg border border-gray-100 shadow-md hover:bg-gray-100">'+
                    '<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">'+response.nom_temporada+'</h5>'+
                    '<p class="font-normal text-gray-700">'+response.content+'</p>'+
                    '<div class="absolute right-4 bottom-4 text-red-200 hover:text-red-500" aria-action="delete">'+
                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />'+
                        '</svg>'+
                    '</div>'+
                '</a>';
                $("#addSeason").before(content);
                console.log(order)
                order++;
                console.log(order)
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
  });

</script>

<x-page-parts.center-rectangle-footer />
