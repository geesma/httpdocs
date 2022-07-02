<?php
$random_id = str_replace('.', '-', $link) . '-' . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);
?>
<div class="p-2">

    @if ($active)
        <a href="{{ route($link) }}" id="{{ $random_id }}-menu-button"
            class="px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-md" aria-current="page">
            {{ $text }}</a>
    @else
        <a href="{{ route($link) }}" id="{{ $random_id }}-menu-button"
            class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">
            {{ $text }}</a>
    @endif
    @if (isset($submenu))
        <div id="{{ $random_id }}-menu"
            class="left-0 hidden w-full py-1 mt-4 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none galoo-submenu"
            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            @for ($i = 0; $i < count($submenu); $i++)
                <x-menu.submenu-link :link="$submenu[$i][1]" :text="$submenu[$i][0]" menuName="{{ $random_id }}-menu"
                    :elementId="$i" :subMenu="isset($submenu[$i][2]) ? $submenu[$i][2] : null" />
            @endfor
        </div>
        <script>
            $(document).ready(function() {
                $("#{{ $random_id }}-menu-button").on("click", function(e) {
                    e.preventDefault();
                    $(".galoo-submenu:not(#{{ $random_id }}-menu)").toggle(false);
                    $(".galoo-submenu-submenu").hide();
                    $(".galoo-active-submenu").removeClass("galoo-active-submenu");
                    $(".galoo-active-menu").removeClass("galoo-active-menu");
                    $("#{{ $random_id }}-menu-button").addClass("galoo-active-menu");
                    $("#{{ $random_id }}-menu").toggle('fast');
                });
            });
        </script>
    @endif
</div>
