<x-page-parts.header page="post" />

<div class="w-full p-2 mx-auto max-w-7xl sm:p-6 lg:p-8">
    <div class="mb-8 overflow-hidden rounded-lg">
        <img src="{{ asset($post->image) }}" class="object-cover w-full min-h-96 max-h-[32rem]" alt="">
    </div>
    <div class="px-8 py-6 text-left bg-white rounded-lg shadow-lg">
        <div class="flex flex-col flex-wrap items-baseline gap-4 mb-6">
            <h1 class="text-5xl font-medium leading-tight align-baseline">{{ $post->title }}</h1>
            <h4 class="text-xl font-medium text-gray-500 align-baseline">{{ $post->subtitle ?? '' }}</h4>
            <h5 class="text-gray-300">Escrito por {{ $post->user->name . ' ' . $post->user->surname }} |
                {{ $post->updated_at->locale('es')->diffForHumans() }}</h5>
            <div class="mt-4">
                {!! $post->content !!}
            </div>
            @if (isset($post->qualification))
                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Posición</th>
                            <th class="px-4 py-2">Jugador</th>
                            <th class="px-4 py-2">Puntos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($post->qualification) as $position => $qualification)
                            <tr class="cursor-pointer" onClick="gotoUser({{ $qualification->id }})">
                                <td class="px-4 py-2">{{ $position + 1 }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('user.view', $qualification->id) }}">
                                        <div class="flex items-center gap-2">
                                            <img src="{{ asset($qualification->image) }}"
                                                alt="imagen de {{ $qualification->name }}" class="w-8 rounded-full" />
                                            {{ $qualification->name }}
                                        </div>
                                    </a>
                                </td>
                                <td class="px-4 py-2">{{ $qualification->points }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
                    const gotoUser = (id) => {
                        window.location.href = `/user/${id}`
                    }
                </script>
            @endif
        </div>
    </div>
</div>



<x-page-parts.footer />
