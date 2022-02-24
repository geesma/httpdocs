<x-page-parts.center-rectangle-header page="historia" />

<div class="flex items-center gap-4 items-baseline flex-wrap mb-6">
    <h1 class="font-medium leading-tight align-baseline text-5xl">Historia</h1>
    <h4 class="font-medium opacity-50 align-baseline text-xl">Última actualización {{ $historia->updated_at }}</h4>
</div>
@if(session()->get('user')->role != 'player')
    <div>
        <x-forms.tinymce-editor :text="$historia->content" :route="route('historia.update', ['historium' => 1])"/>
    </div>
@else
    {!! $historia->content !!}
@endif


<x-page-parts.center-rectangle-footer />
