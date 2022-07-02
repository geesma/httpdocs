window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

import $ from 'jquery';
global.$ = global.jQuery = $;

window.Swal = require('sweetalert2');

window.dt = require('datatables.net-responsive');

$.extend($.fn.dataTable.defaults, {
	language: {
		"decimal":        ",",
		"emptyTable":     "La tabla no contiene datos",
		"info":           "Mostrando _START_ de _END_ of _TOTAL_ entradas",
		"infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
		"infoFiltered":   "(Filtrado de un total de _MAX_ entradas)",
		"infoPostFix":    "",
		"thousands":      ".",
		"lengthMenu":     "Mostrar _MENU_ entradas",
		"loadingRecords": "Cargando...",
		"processing":     "Procesando...",
		"search":         "Buscar:",
		"zeroRecords":    "La busqueda no tiene resultados",
		"paginate": {
			"first":      "Primero",
			"last":       "Último",
			"next":       "Siguente",
			"previous":   "Anterior"
		},
		"aria": {
			"sortAscending":  ": activar para ordenar la columna ascendente",
			"sortDescending": ": activar para ordenar la columna descendente"
		}
	},
	responsive: true,
});

import Dropzone from "dropzone";
global.Dropzone = Dropzone;

import lightGallery from 'lightgallery';
global.lightGallery = lightGallery;

import lgThumbnail from 'lightgallery/plugins/thumbnail'
global.lgThumbnail = lgThumbnail
import lgZoom from 'lightgallery/plugins/zoom'
global.lgZoom = lgZoom
