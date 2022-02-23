<x-page-parts.center-rectangle-header page="usuario" />

<div class="flex items-center justify-between mb-6">
  <h1 class="font-medium leading-tight text-5xl">Usuarios</h1>
  <button class="flex items-center py-2 px-3 transition rounded-full duration-150 text-white bg-black hover:opacity-100 hover:outline-none hover:ring-2 hover:ring-offset-2 hover:ring-offset-white-800 hover:ring-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white-800 focus:ring-black" id="addUser">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
    </svg>
    <span class="hidden md:block ml-2">Añadir Usuario</span>
  </button>
</div>
<div>
  <table class="table-auto" id="users-table">
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Nombre de usuario</th>
        <th>Herramientas</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <td class="flex justify-center"><img src="{{ isset($user->image) ? asset('images/uploads/profiles/'.$user->username.'/'.$user->image) : asset('images/uploads/profiles/no_image/no_image.jpg') }}" alt="" class="w-24 h-24 object-cover object-center rounded-full"></td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->surname }}</td>
          <td>{{ $user->username }}</td>
          <td>
            <div class="flex content-center justify-center gap-4">
              <a href="{{ route('user.view', ['id' => $user->id] ) }}" class="text-blue-600"><x-button.view/></a>
              <a href="{{ route('user.edit', ['id' => $user->id] ) }}" class="text-amber-600"><x-button.edit/></a>
              @if(session()->get('user')->id != $user->id && ($user->role != 'super' && $user->role != 'editor'))
              <a href="#" onClick="deleteUser(this, {{ $user->id }});" class="text-red-600"><x-button.delete/></a>
              @endif
            </div>
        </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
  let table = $('#users-table').DataTable({});

  $(document).ready(function() {
    $('#addUser').on('click', function() {
      Swal.fire({
        title: '<h1 class="font-medium leading-tight text-black text-5xl">Añadir usuario</h1>',
        icon: 'info',
        customClass: {
          confirmButton: 'flex items-center py-2 px-3 transition rounded-full duration-150 text-white bg-black hover:opacity-100 hover:outline-none hover:ring-2 hover:ring-offset-2 hover:ring-offset-white-800 hover:ring-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white-800 focus:ring-black',
        },
        html:
          '<div class="grid grid-cols-2 md:grid-cols-6 p-2 gap-4 text-left auto-cols-fr"> ' +
            '<div class="col-span-2"> ' +
              '<label class="block ml-1 mb-3" for="name">Nombre</label> ' +
              '<x-input.no-label placeholder="Nombre" id="name" name="name"/>' +
            '</div>' +
            '<div class="col-span-4"> ' +
              '<label class="block ml-1 mb-3" for="surname">Apellidos</label> ' +
              '<x-input.no-label placeholder="Apellidos" id="surname" name="surname"/>' +
            '</div>' +
            '<div class="col-span-6 mt-4">' +
              '<label class="block ml-1 mb-3" for="username">Nombre de usuario</label>' +
              '<x-input.no-label placeholder="Nombre de usuario" id="username" name="username"/>' + 
            '</div>' +
          '</div>',
        showCloseButton: true,
        focusConfirm: false,
        buttonsStyling: false,
        confirmButtonText:
          'Añadir!',
      }).then((result) => {
        if (result.isConfirmed) {
          let name = $("#name").val();
          let surname = $("#surname").val();
          let username = $("#username").val();
          $.ajax({
            url:'{{ route("user.create") }}',
            data:{'name':name, 'surname':surname, 'username':username },
            type:'POST',
            success: function (response) {
              Toast.fire({
                icon: 'success',
                title: 'Usuario creado'
              });
              let url1 = "{{ route('user.view', ['id' => 1] ) }}";
              let url2 = "{{ route('user.edit', ['id' => 1] ) }}";
              let url3 = "{{ route('user.delete', ['id' => 1] ) }}";
              let urlText= '<div class="flex content-center justify-center gap-4"><a href="'+url1.substring(0, url1.length - 1)+response+'" class="text-blue-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg></a>' +
                  '<a href="'+url2.substring(0, url2.length - 1)+response+'" class="text-amber-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" /></svg></a>' +
                  '<a href="#" onClick="deleteUser(this, '+response+');" class="text-red-600 delete-link"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg></a></div>';
              table.row.add( [
                '<img src="{{asset('images/uploads/profiles/no_image/no_image.jpg')}}" alt="" class="w-24 h-24 object-cover object-center rounded-full mx-auto">',
                name,
                surname,
                username,
                urlText
              ] ).draw( false );
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

  function deleteUser(element,id) {
    Swal.fire({
      title: '¿Estás seguro que desea eliminar el usuario?',
      showDenyButton: true,
      confirmButtonText: 'Eliminar',
      denyButtonText: `Cancelar`,
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url:'{{ route("user.delete") }}',
          data:{'id':id},
          type:'DELETE',
          success: function (response) {
            console.log(response);
            Toast.fire({
              icon: 'success',
              title: 'Usuario eliminado'
            });
            table.row( $(element).parents('tr') )
              .remove()
              .draw();
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
      } else if (result.isDenied) {
        Swal.fire('El usuario no se ha eliminado', '', 'info')
      }
    })
    
  }
</script>

<x-page-parts.center-rectangle-footer/>