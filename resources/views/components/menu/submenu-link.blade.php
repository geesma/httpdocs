<?php $random_id = str_replace('.', '-', $menuName) . '-' . substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5); ?>
<div class="relative">
    <div>
        <a href="{{ $link }}" class="block px-4 py-2 text-sm hover:bg-slate-200" role="menuitem" tabindex="-1"
            id="{{ $menuName }}-item-{{ $elementId }}">{{ $text }}</a>
    </div>
    @if (isset($subMenu))
        <div id="{{ $menuName }}-item-{{ $elementId }}-menu"
            class="absolute top-0 hidden w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg left-full ring-1 ring-black ring-opacity-5 focus:outline-none galoo-submenu-submenu"
            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            @for ($i = 0; $i < count($subMenu); $i++)
                <x-menu.submenu-link :link="$subMenu[$i][1]" :text="$subMenu[$i][0]" menuName="{{ $random_id }}-menu"
                    :elementId="$i" :subMenu="isset($subMenu[$i][2]) ? $subMenu[$i][2] : null" />
            @endfor
        </div>
        <script>
            $(document).ready(function() {
                $("#{{ $menuName }}-item-{{ $elementId }}").on("click", function(e) {
                    e.preventDefault();
                    $(".galoo-submenu-submenu").hide();
                    $(".galoo-active-submenu").removeClass("galoo-active-submenu");
                    $("#{{ $menuName }}-item-{{ $elementId }}").addClass("galoo-active-submenu");
                    $("#{{ $menuName }}-item-{{ $elementId }}-menu").toggle('fast');
                });
            });
        </script>
    @endif
</div>
