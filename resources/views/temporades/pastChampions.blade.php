<x-page-parts.center-rectangle-header page="premios" />
<div class="flex flex-wrap items-center gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Past Champions</h1>
</div>
@foreach ($ligas as $liga)
    <div id="lightgallery" class="grid grid-cols-1 gap-4 mb-12 md:grid-cols-2 lg:grid-cols-4">
        <div class="my-4 col-span-full">
            <h2 class="text-3xl font-medium leading-tight align-baseline">{{ $liga->name }}</h2>
        </div>
        @foreach ($liga->temporadas()->groupBy('temporada_id')->get() as $temporada)
        <?php
            $winner = $temporada->get_winner($temporada->id, $liga->id);
            $player = $temporada->get_user($winner->user_id);
        ?>
            <a href="{{ route('user.view', ['id' => $player->id]) }}"
                class="relative flex flex-col items-center content-center max-w-sm px-10 bg-white border border-gray-100 rounded-lg shadow-md py-14 md:px-6 md:py-10 hover:bg-gray-100">
                <img src="{{ isset($player->image) ? asset($player->image) : asset('images/uploads/profiles/no_image/no_image.jpg') }}"
                    alt="profile pic" class="object-cover object-center w-32 h-32 mb-8 rounded-full" />
                <h3 class="mb-2 text-xl font-bold">{{ $player->name . ' ' . $player->surname }}</h3>
                <h4 class="text-sm italic font-bold opacity-50">{{ $temporada->nom_temporada }}</h4>
            </a>
        @endforeach
    </div>
@endforeach

<x-page-parts.center-rectangle-footer />
