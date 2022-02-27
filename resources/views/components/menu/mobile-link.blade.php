<div class="p-2">

    @if($active)
        <a href="{{ route($link) }}"  class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">{{$text}}</a>
    @else
        <a href="{{ route($link) }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{ $text }}</a>
    @endif
</div>
