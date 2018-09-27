$(document).ready(function(){
	$('.dot').dotdotdot({
		wrap: 'letter' 
	}); 
	
	$(".menu li").hover(function() {
		$(this).children(".submenu").slideDown(500);
	}, function() {
		$(this).children(".submenu").slideUp(0);
	});
});