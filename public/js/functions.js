$(document).ready(function(){
	$("button[aria-controls='mobile-menu']").on("click", function(){
		$("#admin-menu").hide();
		$("#user-menu").hide();
		$("#mobile-menu").toggle('fast');
	});

	$("#user-menu-button").on("click", function(){
		$("#admin-menu").hide();
		$("#mobile-menu").hide();
		$("#user-menu").toggle('fast');
	});

	$("#admin-menu-button").on("click", function(){
		$("#user-menu").hide();
		$("#mobile-menu").hide();
		$("#admin-menu").toggle('fast');
		
	});
});