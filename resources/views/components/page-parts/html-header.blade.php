<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<link href="{{ mix('css/app.css') }}" rel="stylesheet"/>
	<script src="{{ mix('js/app.js') }}"></script>
	<link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/x-icon">
	<title>Familia Tipster</title>
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 2000,
			timerProgressBar: true,
			didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		});
	</script>
</head>
<body>

@if(session("status"))
    <?php $statusMessage = session("status"); ?>
    <x-notifications.success :type="$statusMessage['type']" :message="$statusMessage['message']"/>
@endif

@if(isset($notification))
	<x-notifications.success :type="$notification['type']" :message="$notification['message']"/>
@endif
