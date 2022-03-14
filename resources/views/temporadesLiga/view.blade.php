<x-page-parts.center-rectangle-header page="clasificacion" class="relative"/>
<?php $i = 0; ?>

<div class="flex flex-wrap items-baseline gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">{{ $liga->name }}</h1>
    <h2 class="text-xl font-medium text-gray-500 align-baseline">{{ $temporada->nom_temporada }}</h2>
</div>
<div class="flow-root">
    <ul role="list" class="">
        @foreach ($users as $user)
            <li class="
                    <?php
                        if($i == 0) {
                            ?> shadow-lg rounded-xl <?php
                        } elseif($i == 1) {
                            ?> scale-[0.97] shadow-lg <?php
                        } elseif($i == 2) {
                            ?> scale-[0.95] shadow-md <?php
                        } else {
                            ?> scale-[0.9] mb-1 <?php
                        } ?> border border-gray-100 mb-2 p-6 cursor-pointer rounded-md hover:bg-gray-100"
                onclick="location.href = '{{ route('user.view', ['id' => $user->id]) }}'">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center flex-shrink-0 gap-4">
                        <?php if($i == 0) {
                                ?> <span class="text-3xl font-extrabold text-transparent bg-gradient-to-tr from-[#bf953f] via-[#FCF6BA] to-[#B38728] bg-clip-text" > #1 </span><?php
                            } elseif($i == 1) {
                                ?> <span class="text-2xl font-bold text-transparent bg-gradient-to-tr from-[#454545] via-[#dedede] to-[#ffffff] bg-clip-text"> #2 </span> <?php
                            } elseif($i == 2) {
                                ?>  <span class="text-xl font-semibold text-transparent bg-gradient-to-tr from-[#ffdeca] via-[#ca7345] to-[#ffdeca] bg-clip-text"> #3 </span><?php
                            } else echo $i +1; ?>

                        <img class="object-cover object-center w-20 h-20 rounded-full"
                            src="{{ isset($user->image) ? asset($user->image) : asset('images/uploads/profiles/no_image/no_image.jpg') }}" alt="user picture">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            {{ $user->name . " " . $user->surname}}
                        </p>
                        <p class="text-sm text-gray-500 truncate ">
                            {{ $user->username }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                        {{ $user->points }}
                    </div>
                </div>
            </li>
            <?php $i++; ?>
        @endforeach
        @if (session()->get('user')->role == 'super' || session()->get('user')->role == 'editor')
            <div class="absolute top-10 right-10">
                <a href="{{ route('temporada.liga.edit', ['liga' => $liga, 'temporada' => $temporada]) }}">
                    <x-button.edit />
                </a>
            </div>
        @endif
    </ul>

    <x-page-parts.center-rectangle-footer />
