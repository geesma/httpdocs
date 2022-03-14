<x-page-parts.html-header/>

<div class="flex items-center justify-center min-h-screen bg-gray-600 bg-center bg-no-repeat bg-cover"> <!-- bg-[url('/images/login/background.jpg')] -->
    <div class="px-8 py-6 mt-4 text-left bg-white rounded-md shadow-lg">
        <div class="flex items-center flex-shrink-0">
            <img class="w-auto h-12 mx-auto" src="{{ asset('images/logo/logo_lliga_rectoret_no_font_black.svg') }}" alt="Familia Tipster">
        </div>
        <form action="{{ route("user.login.password") }}" method="POST">
		@csrf
            <div class="mt-6">
                <div>
                    <label class="block mb-3 ml-1" for="username">Contraseña de "{{ $user }}"</label>
					<div class="flex flex-wrap items-end justify-between gap-4">
						<div>
							<x-input.no-label type="password" placeholder="Contraseña" id="password" name="password" autofocus/>
							<input type="hidden" name="username" value="{{ $user }}" >
						</div>
						<div class="md-w-full">
							<x-button text="Iniciar sesión" type="submit"/>
						</div>
					</div>
                </div>
			</div>
			@isset($error)
				<div class="max-w-xs mt-6 text-center">
					<span class="text-sm text-red-800">{{ $error }}</span>
				</div>
			@endisset
        </form>
    </div>
</div>

<x-page-parts.html-footer/>
