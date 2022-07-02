<x-page-parts.center-rectangle-header page="premios" />

<div class="flex flex-wrap items-baseline gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">{{ $premio->title }}</h1>
    <h4 class="text-xl font-medium text-gray-500 align-baseline">Última actualización {{ $premio->updated_at->locale('es')->diffForHumans() }}</h4>
</div>
@if(session()->get('user')->role != 'player')
    <div>
        <x-forms.tinymce-editor :text="$premio->content" :route="route('premio.update', ['premio' => 1])"/>
    </div>
@else
    {!! $premio->content !!}
@endif


<x-page-parts.center-rectangle-footer />
