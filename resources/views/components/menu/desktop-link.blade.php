<?php
$random_id = str_replace('.','-',$link) . "-" . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
?>
<div class="relative">
<div>
@if($active)
    <a href="{{ route($link) }}" id="{{$random_id}}-menu-button" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">
        {{$text}}
        {{-- @if(isset($submenu))
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        @endif --}}
    </a>

@else
    <a href="{{ route($link) }}" id="{{$random_id}}-menu-button" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
        {{ $text }}
        {{-- @if(isset($submenu))
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
        @endif --}}
    </a>
@endif
</div>
@if(isset($submenu))
<div id="{{$random_id}}-menu" class="hidden origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none galoo-submenu" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
    @for($i = 0; $i < count($submenu); $i++)
        <x-menu.submenu-link :link="$submenu[$i][1]" :text="$submenu[$i][0]" menuName="{{$random_id}}-menu" :elementId="$i" :subMenu="isset($submenu[$i][2])? $submenu[$i][2] : null" />
    @endfor
</div>
<script>
$(document).ready(function(){
    $("#{{$random_id}}-menu-button").on("click", function(e){
        e.preventDefault();
        $(".galoo-submenu:not(#{{$random_id}}-menu)").hide();
        $(".galoo-submenu-submenu").hide();
        $(".galoo-active-submenu").removeClass("galoo-active-submenu");
        $(".galoo-active-menu").removeClass("galoo-active-menu");
        $("#{{$random_id}}-menu-button").addClass("galoo-active-menu");
        $("#mobile-menu").hide();
		$("#{{$random_id}}-menu").toggle('fast');
	});
});

</script>
@endif
</div>
