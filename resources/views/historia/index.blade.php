<x-page-parts.center-rectangle-header page="historia" />

<div class="flex flex-wrap items-baseline gap-4 mb-6">
    <h1 class="text-5xl font-medium leading-tight align-baseline">Historia</h1>
    <h4 class="text-xl font-medium text-gray-500 align-baseline">Última actualización {{ $historia->updated_at->locale('es')->diffForHumans() }}</h4>
</div>
@if(session()->get('user')->role != 'player')
    <div>
        <x-forms.tinymce-editor :text="$historia->content" :route="route('historia.update', ['historium' => 1])"/>
    </div>
@else
    {!! $historia->content !!}
@endif


<x-page-parts.center-rectangle-footer />
