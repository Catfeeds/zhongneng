$(document).ready(function() {
	(function(){
		var $html=$('html');
		var $window=$(window);
		var $body=$("body");
		var psdsize=840;
		var htmlfont=$body.width()/psdsize*100+'px';
		$html.css('font-size',htmlfont);
		$body.css('opacity',1);
		$window.resize(function () {
			htmlfont=$body.width()/psdsize*100+'px';
			$html.css('font-size',htmlfont)
		});
	})();
	$('.dot').dotdotdot({
		wrap: 'letter' 
	});
	$('.menubtn').toggle(function(){
		$(this).parents('.header').addClass('header2');
		$(this).addClass('close');
        $('.menu').fadeIn(100);
        $('body').css('overflow-y','hidden');
    }, function() {
		$(this).parents('.header').removeClass('header2');
		$(this).removeClass('close');
    	$('.menu').fadeOut(0);
        $('body').css('overflow-y','auto');
    });
	$('.menu p').on('click',function(){
		$(this).siblings().stop(false,true).slideToggle().parents('li').toggleClass('on');
		$(this).parents('li').siblings().removeClass('on').find('dl').slideUp();
	});
	
	if($('.nav .swiper-slide').length>0){
		var nav = new Swiper('.nav',{
			slidesPerView : "auto"
	  	});
	  	var navto=$('.nav .on').index();
	  	nav.slideTo(navto);
	};
	
});