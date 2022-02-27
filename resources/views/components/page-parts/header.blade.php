<x-page-parts.html-header/>

<nav class="bg-gray-800 z-50 fixed w-full">
  <div class="bg-gray-800 max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" id="mobile-menu-closed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="false">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg class="hidden h-6 w-6" id="mobile-menu-opened" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex-shrink-0 flex items-center">
          <img class="block lg:hidden h-8 w-auto" src="{{ asset('images/logo/logo_lliga_rectoret_no_letters.svg') }}" alt="Familia Tipster">
          <img class="hidden lg:block h-8 w-auto" src="{{ asset('images/logo/logo_lliga_rectoret_no_font.svg') }}" alt="Familia Tipster">
        </div>
        <div class="hidden sm:flex sm:ml-6">
          <div class="flex items-center space-x-4">
            @for($i = 0; $i < count($menu); $i++)
              <x-menu.desktop-link :text="$menu[$i][0]" :active="$menu[$i][1]" :link="$menu[$i][2]" :submenu="isset($menu[$i][3]) ? $menu[$i][3] : null"/>
            @endfor
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <button type="button" class="mx-1 bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
          <span class="sr-only">View notifications</span>
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </button>
        @if(session()->get('user')->role != "player")
        <div class="relative">
          <div>
            <button type="button" class="mx-1 bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="admin-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="sr-only">Manage</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </button>
          </div>
          <div id="admin-menu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none galoo-submenu" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            @for($i = 0; $i < count($admin_menu); $i++)
              <x-menu.submenu-link :link="$admin_menu[$i][1]" :text="$admin_menu[$i][0]" menuName="admin-menu" :elementId="$i" :subMenu="isset($user_menu[$i][2]) ? $user_menu[$i][2] : null"/>
            @endfor
          </div>
        </div>
        <script>
            $(document).ready(function(){
                $("#admin-menu-button").on("click", function(){
                    $(".galoo-submenu:not(#admin-menu)").hide();
                    $("#mobile-menu").hide();
                    $(".galoo-active-submenu").removeClass("galoo-active-submenu");
                    $("#admin-menu").toggle('fast');
                });
            });
        </script>
        @endif
        <div class="ml-3 relative">
          <div>
            <button type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full object-cover object-center" src="{{ isset(session()->get("user")->image) ? asset('images/uploads/profiles/'.session()->get("user")->username.'/'.session()->get("user")->image) : asset('images/uploads/profiles/no_image/no_image.jpg') }}" alt="">
            </button>
          </div>
          <div id="user-menu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none galoo-submenu" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            @for($i = 0; $i < count($user_menu); $i++)
              <x-menu.submenu-link :link="$user_menu[$i][1]" :text="$user_menu[$i][0]" menuName="user-menu" :elementId="$i" :subMenu="isset($user_menu[$i][2]) ? $user_menu[$i][2] : null"/>
            @endfor
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1">
      @for($i = 0; $i < count($menu); $i++)
        <x-menu.mobile-link :text="$menu[$i][0]" :active="$menu[$i][1]" :link="$menu[$i][2]" :submenu="isset($menu[$i][3]) ? $menu[$i][3] : null"/>
      @endfor
    </div>
  </div>
</nav>
<div class="flex items-center justify-center min-h-screen bg-cover bg-no-repeat bg-center bg-gray-600">
