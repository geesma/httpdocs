<div class="relative max-w-xs overflow-hidden font-semibold bg-white border border-gray-100 rounded-md shadow-lg">
    <a href="{{ route('post.show', ['post' => $post]) }}">
        @if (isset($post->image))
            <img class="w-full h-auto mx-auto shadow-lg max-h-60 min-h-60" src="{{ asset($post->image) }}"
                alt="product designer" />
        @endif
        <div class="px-6 pt-4 pb-6">
            <h1 class="text-lg text-gray-700"> {{ $post->title ?? '' }} </h1>
            <h3 class="text-sm text-gray-400 "> {{ $post->subtitle }} </h3>
            <p class="mt-4 text-xs text-gray-300"> {{ $post->updated_at->locale('es')->diffForHumans() }} </p>
        </div>
    </a>
    @if (session()->get('user')->role == 'editor' ||
        session()->get('user')->role == 'super' ||
        session()->get('user')->role == 'moderator')
        <div class="w-full h-10"></div>
        <div class="absolute bottom-0 flex w-full px-10 py-4 justify-evenly">
            <a href="{{ route('post.edit', ['post' => $post]) }}"
                class="inline-block px-3 py-1 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full hover:bg-teal-400">
                <x-button.edit />
            </a>
            <!-- delete button with icon with javascript prompt before submit -->

            <form action="{{ route('post.destroy', ['post' => $post]) }}" method="POST"
                onsubmit="handleSubmit(event)">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-block px-3 py-1 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full hover:bg-red-400">
                    <x-button.delete />
                </button>
            </form>
        </div>
        <script>
            function handleSubmit(e) {
                if (confirm('¿Estás seguro de que quieres eliminar este post?')) {
                    e.submit();
                }
                e.preventDefault();
            }
        </script>
    @endif
</div>
