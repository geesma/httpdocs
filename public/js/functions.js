$(document).ready(function(){
	$("button[aria-controls='mobile-menu']").on("click", function(){
		$(".galoo-submenu").hide();
        $(".galoo-active-submenu").removeClass("galoo-active-submenu");
        $(".galoo-submenu-submenu").hide();
		$("#mobile-menu").toggle('fast');
	});

	$("#user-menu-button").on("click", function(){
		$(".galoo-submenu:not(#user-menu)").hide();
        $(".galoo-submenu-submenu").hide();
        $(".galoo-active-submenu").removeClass("galoo-active-submenu");
        $("#mobile-menu").hide();
		$("#user-menu").toggle('fast');
	});
});
