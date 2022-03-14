<x-page-parts.center-rectangle-header page="ligas" class="relative" />

<div class="flex flex-wrap items-baseline gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">{{ $liga->name }}</h1>
    <h2 class="text-xl font-medium text-gray-500 align-baseline">{{ $temporada->nom_temporada }}</h2>
</div>
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" aria-route="{{ route('temporada.index') }}">
    @foreach ($players as $player)
        <a href="{{ route('user.view', ['id' => $player->id]) }}"
            class="relative flex flex-col items-center content-center max-w-sm px-10 bg-white border border-gray-100 rounded-lg shadow-md py-14 md:px-6 md:py-10 hover:bg-gray-100">
            <img src="{{ isset($player->image) ? asset($player->image) : asset('images/uploads/profiles/no_image/no_image.jpg') }}" alt="profile pic"
                class="object-cover object-center w-32 h-32 mb-8 rounded-full" />
            <h3 class="mb-2 text-xl font-bold">{{ $player->name . " " . $player->surname }}</h3>
            <h4 class="text-sm italic font-bold opacity-50">{{ $player->username }}</h4>
        </a>
    @endforeach
    @if (session()->get('user')->role == 'super' || session()->get('user')->role == 'editor')
        <div class="absolute top-10 right-10">
            <a href="{{ route('temporada.liga.edit', ['liga' => $liga, 'temporada' => $temporada]) }}">
                <x-button.edit />
            </a>
        </div>
    @endif
</div>

<x-page-parts.center-rectangle-footer />
