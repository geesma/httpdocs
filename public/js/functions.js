$(document).ready(function () {
    $("button[aria-controls='mobile-menu']").on("click", function () {
        $(".galoo-submenu").hide();
        $(".galoo-active-submenu").removeClass("galoo-active-submenu");
        $(".galoo-submenu-submenu").hide();
        $("#mobile-menu").toggle('fast');
    });

    $("#user-menu-button").on("click", function () {
        $(".galoo-submenu:not(#user-menu)").hide();
        $(".galoo-submenu-submenu").hide();
        $(".galoo-active-submenu").removeClass("galoo-active-submenu");
        $("#mobile-menu").hide();
        $("#user-menu").toggle('fast');
    });

    $("div[aria-action='delete']").on("click", function (e) {
        e.preventDefault();
        let parent = $(this).parent();
        const route = parent.parent().attr('aria-route');
        const id = parent.attr('aria-id');
        const name = parent.attr('aria-name');
        const iterations = parent.parent().attr('aria-repeat');
        for (let i = 0; i < iterations; i++) {
            parent = parent.parent();
        }


        Swal.fire({
            title: '¿Estás seguro que desea eliminar '+name+'?',
            showDenyButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: route.replace(/\s/g, '')+'/'+id,
                    type: 'DELETE',
                    success: function () {
                        Toast.fire({
                            icon: 'success',
                            title: name+ ' se ha eliminado'
                        });
                        parent.remove();
                    },
                    statusCode: {
                        404: function () {
                            console.log('web not found');
                        },
                        409: function (response) {
                            console.log(response.responseJSON.message)
                        },
                        500: function (response) {
                            console.log(response.responseJSON.message);
                        }
                    },
                    error: function (response) {
                        Toast.fire({
                            icon: 'error',
                            title: response.responseJSON.message
                        });
                    }
                });
            } else if (result.isDenied) {
                Swal.fire(name+' no se ha eliminado', '', 'info')
            }
        })
    });
});
