<x-page-parts.html-header/>

<div class="flex items-center justify-center min-h-screen bg-cover bg-no-repeat bg-center bg-[url('/images/login/background.jpg')]">
    <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg rounded-md" style="background-color: white">
        <h3 class="text-2xl font-bold text-center">Familia Tipster</h3>
        <form action="/user/login" method="POST">
		@csrf
            <div class="mt-6">
                <div>
                    <label class="block ml-1 mb-3" for="username">Nombre de usuario</label>
					<div class="flex flex-wrap items-end justify-between gap-4">
						<div>
							<x-input.no-label placeholder="Nombre de usuario" id="username" name="username" autofocus/>
						</div>
						<div class="md-w-full">
							<x-button text="Iniciar sesión" type="submit"/>
						</div>
					</div>
                </div>
			</div>
			@isset($error)
				<div class="mt-6 mx-auto max-w-xs text-center">
					<span class="text-sm text-red-800">{{ $error }}</span>				
				</div>
			@endisset
        </form>
    </div>
</div>

<x-page-parts.html-footer/>