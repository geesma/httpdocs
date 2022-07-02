<x-page-parts.center-rectangle-header page="estatutos" />

<div class="flex flex-wrap items-baseline gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Estatuto</h1>
    <h4 class="text-xl font-medium text-gray-500 align-baseline">Última actualización {{ $estatuto->updated_at->locale('es')->diffForHumans() }}</h4>
</div>
@if(session()->get('user')->role != 'player')
    <div>
        <x-forms.tinymce-editor :text="$estatuto->content" :route="route('estatuto.update', ['estatuto' => 1])"/>
    </div>
@else
    {!! $estatuto->content !!}
@endif


<x-page-parts.center-rectangle-footer />
