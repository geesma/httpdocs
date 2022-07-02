<a href="{{ $link }}" aria-id="{{ $id }}" aria-name="{{ $title }}"
    class="relative grid content-between max-w-sm p-10 bg-white border border-gray-100 rounded-lg shadow-md md:p-6 hover:bg-gray-100">
    <?php $i = 0; ?>
    <div>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $title }}</h5>
        <p class="font-normal text-gray-700">{{ $subtitle }}</p>
    </div>
    @if (!is_null($elements) > 0)
        <div class="flex self-end mt-4 -space-x-3 font-mono text-sm font-bold leading-6 text-white">
            @foreach ($elements as $element)
                @if (isset($element->color))
                    <div class="flex items-center justify-center w-12 h-12 rounded-full shadow-lg ring-2 ring-white"
                        style="z-index: {{ (5 - $i) * 10 }}; background-color: {{ $element->color }};">
                        {{ $element->initials }}</div>
                @elseif (isset($element->image))
                    <div class="flex items-center justify-center w-12 h-12 rounded-full shadow-lg ring-2 ring-white"
                        style="z-index: {{ (5 - $i) * 10 }}; background-image: url('{{ asset($element->image) }}'); background-position: center; background-size:cover;"></div>
                @elseif (isset($element->filename))
                    <div class="flex items-center justify-center w-12 h-12 rounded-full shadow-lg ring-2 ring-white"
                        style="z-index: {{ (5 - $i) * 10 }}; background-image: url('{{ asset($element->filename) }}'); background-position: center; background-size:cover;"></div>
                @else
                    <div class="flex items-center justify-center w-12 h-12 text-xs rounded-full shadow-lg ring-2 ring-white"
                    style="background-color: #3498db;">Album</div>
                @endif
                <?php $i++; ?>
            @endforeach
        </div>
        @if ($delete && (session()->get('user')->role == 'super' || session()->get('user')->role == 'editor') && $elements->count() == 0)
            <x-button.card-delete />
        @endif
    @endif
</a>
