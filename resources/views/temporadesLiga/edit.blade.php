<x-page-parts.center-rectangle-header page="ligas" class="relative" />

<div class="flex items-center justify-between mb-12">
    <div class="flex items-baseline gap-4">
        <h1 class="text-5xl font-medium leading-tight align-baseline">Editar {{ $liga->name }}</h1>
        <h2 class="text-xl font-medium text-gray-500 align-baseline">{{ $temporada->nom_temporada }}</h2>
    </div>
    <div id="searchBox"
        class="relative right-0 top-3 focus-within:shadow-md focus-within:rounded-t-full focus-within:rounded-b-full">
        <input type="text" autocomplete="off" name="search" id="search" placeholder="Buscar"
            class="w-32 px-4 py-2 text-right transition-all border border-gray-100 rounded-full shadow-md focus:border focus:border-gray-200 focus:shadow-none focus:w-56" />
        <div class="absolute z-50 hidden w-full py-2 text-right bg-white shadow-md rounded-b-2xl" id="searchMenu">
            <ul class="divide-y divide-gray-100 " id="searchResults">
            </ul>
        </div>
    </div>
</div>
<div class="flex flex-col items-center gap-4 mb-12" id="players-container" aria-route="{{ route('temporada.index') }}"></div>
<div class="flex flex-row-reverse">
    <x-button id="sendNewPlayers" text="Guardar" />
</div>



<script>
    const players = @json($players);
    const allUsers = @json($allUsers);
    const deletePlayers = [];
    let searchResult;

    const playersContainer = $('#players-container');
    let menuOpened = false;
    let inputField = document.querySelectorAll(".points")
    const menu = $('#searchMenu');
    const search = $('#search');
    const searchResults = $('#searchResults')
    const sendButton = $('#sendNewPlayers')
    let searching = false;

    const printPlayers = () => {
        playersContainer.html('')
        players.forEach((player, index) => {
            const content =
                `<div class='flex items-center w-full gap-4 px-6 py-2 bg-white border border-gray-100 rounded-lg shadow-md md:w-4/6 hover:bg-gray-100'>` +
                `<div>` +
                `<img src='` + ((player.image) ? `{{ asset('') }}` + player.image :
                    `{{ asset('images/uploads/profiles/no_image/no_image.jpg') }}`) +
                `' alt='profile pic'` +
                ` class='object-cover object-center w-10 h-10 rounded-full' />` +
                `</div>` +
                `<div class="grow">` +
                `<h3 class="text-lg font-bold">${player.username}</h3>` +
                `</div>` +
                `<div>` +
                `<input type="text" name="points" id="points-${player.id}" data-type="points" data-id="${player.id}" value="${player.points}" class="block w-full px-4 py-2 text-right border-gray-300 rounded-md shadow-sm points focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">` +
                `</div>` +
                `<div class="text-red-200 cursor-pointer hover:text-red-500" onClick="deletePlayer(${index})">` +
                `<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">` +
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />` +
                `</svg>` +
                `</div>` +
                `</div>`

            playersContainer.append(content);
        })
        inputField = document.querySelectorAll(".points")

        inputField.forEach(input => {
            input.addEventListener('input', (target) => {
                const value = target.target.value
                const id = target.target.getAttribute("data-id")
                players[players.findIndex(user => user.id == id)].points = value
            })
        })

    }

    const addPlayerToArray = (player) => {
        allUsers.push({
            id: player.id,
            name: player.name,
            surname: player.surname,
            username: player.username,
            image: player.image
        })
    }

    const deletePlayerFromArray = (id) => {
        allUsers.splice(allUsers.findIndex(user => user.id == id), 1)
    }

    const deletePlayer = (id) => {
        Swal.fire({
            title: '¿Estás seguro que desea eliminar el usuario?',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                playerToDelete = players[id]
                players.splice(id, 1)
                printPlayers()
                addPlayerToArray(playerToDelete)
                deletePlayers.push(playerToDelete.id)
            } else if (result.isDenied) {
                Swal.fire('El usuario no se ha eliminado', '', 'info')
            }
        })
    }

    const addPlayer = (player) => {
        players.push({
            ...allUsers.find(user => user.id == player),
            points: 0
        })
        deletePlayerFromArray(player)
        printPlayers()
        hideMenu()
    }

    const showMenu = () => {
        menu.show()
        $('#searchBox').removeClass("focus-within:rounded-b-full")
    }

    const hideMenu = () => {
        menu.hide()
        $('#searchBox').addClass("focus-within:rounded-b-full")
    }

    const printResults = (val, results) => {
        searchResults.html('')

        results.forEach((user, index) => {
            let text = user.name + " " + user.surname

            const content =
                `<li class="px-4 py-2 cursor-pointer hover:bg-slate-200" onclick="addPlayer('${user.id}')">${text.replace(val, `<span class="font-bold">${val}</span>`)}</li>`

            searchResults.append(content);
        })

        if (results.length == 0) {
            const content = `<li class="px-4 py-2">No hay resultados</li>`
            searchResults.append(content);
        }

        showMenu()
    }


    $(document).ready(function() {
        printPlayers()
    });

    search.on('input', function() {
        const input = $(this)
        const val = input.val()

        searchResult = allUsers.filter(element => {
            return element.name.toUpperCase().includes(val.toUpperCase()) || element.surname
                .toUpperCase().includes(val.toUpperCase()) || element.username.toUpperCase().includes(
                    val.toUpperCase())
        })

        searching = true
        printResults(val, searchResult.slice(0, 6))
    })

    $(document).on('keypress', (e) => {
        if(e.which == 13) {
            if (search.is(':focus') && searchResult && searchResult.length == 1) {
                addPlayer(searchResult[0].id)
                search.blur();
            } else if (search.is(':focus') && (searchResult == 0 || !searchResult)) {
                search.blur();
            } else {
                document.getElementById('search').focus()
                $("html, body").animate({ scrollTop: 0 }, "fast");
                search.select();
            }
        }
    })

    $(document).mouseup(function(e) {
        var container = $("#searchBox");

        if (!container.is(e.target) && container.has(e.target).length === 0) {
            hideMenu()
        }
        searching = false
    });

    sendButton.on('click', () => {
        console.log(deletePlayers)
        Swal.fire({
            title: '¿Estás seguro que desea guardar los cambios de la liga?',
            showDenyButton: true,
            confirmButtonText: 'Guardar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('temporada.liga.update', ["temporada" => $temporada, "liga" => $liga]) }}",
                    data: {
                        'players': players,
                        'deletePlayers': deletePlayers
                    },
                    type: 'PUT',
                    success: function(response) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Temporada actualizada'
                        });
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
            } else if (result.isDenied) {
                Swal.fire('La liga no se ha guardado', '', 'info')
            }
        })
    })
</script>

<x-page-parts.center-rectangle-footer />
