<a href="{{ route('post.show', ['post' => $post]) }}" class="max-w-xs overflow-hidden font-semibold bg-white border border-gray-100 rounded-md shadow-lg">
    <img class="w-full h-auto mx-auto shadow-lg max-h-60 min-h-60"
        src="{{asset($post->image ?? '')}}"
        alt="product designer">
    <div class="px-6 pt-4 pb-6">
        <h1 class="text-lg text-gray-700"> {{ $post->title ?? '' }} </h1>
        <h3 class="text-sm text-gray-400 "> {{ $post->subtitle }} </h3>
        <p class="mt-4 text-xs text-gray-300"> {{ $post->updated_at->locale('es')->diffForHumans() }} </p>
    </div>
</a>
