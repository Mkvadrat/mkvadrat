(function($){
	$(document).ready(function(){
		$('#top-menu li').hover(
			function(){
				$(this).addClass('active');
			},
			function(){
				$(this).removeClass('active');
			}
		);
		$('#top-menu li').click(function(e){
			if($(this).hasClass('active')) return;
			e.stopPropagation();
			e.preventDefault();
			$('#top-menu li').removeClass('active');
			$(this).addClass('active');
		})
		
		$('#slider .arrow-left').click(slidePrev);
		$('#slider .arrow-right').click(slideNext);
		slideInit();
		
		$('#slider .slide-button a').hover(
			function(){
				$(this).parent('.slide-button').addClass('active');
				slidePause();
			},
			function() {
				$(this).parent('.slide-button').removeClass('active');
				slideInit();
			}
		);
		
		$('a.scroll-down').click(scrollNext);
		$('a.riel-more.scroll-down').click(scrollNext2);
$('.how-job-stepa.scroll-down').click(scrollNext2);
		$('#header #menu-btn').click(function(){
			$(this).addClass('active');
			$('#left-menu').addClass('active');
		});
		$('#left-menu #menu-btn-close').click(function(){
			$('#header #menu-btn').removeClass('active');
			$('#left-menu').removeClass('active');
		});
		
		$('#screen-4-list li a').click(function(e){
			e.stopPropagation();
			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
				$(this).parent('li').children('.person').removeClass('active');
			} else {
				$('#screen-4-list li a').removeClass('active');
				$('#screen-4-list li .person').removeClass('active');
				$(this).addClass('active');
				$(this).parent('li').children('.person').addClass('active');
			}
		});
		$('#screen-4-list').click(function(){
			$('#screen-4-list li a').removeClass('active');
			$('#screen-4-list li .person').removeClass('active');
		});
		
		$('#scrolltop').click(function(){
			$('html, body').animate({'scrollTop':0},1000);
		});
		
		$('#scrolltop').hide();
		
		$(window).scroll(function(){
			var scrollTop = $(window).scrollTop();
			if (scrollTop>500) {
				$('#scrolltop').show();
			} else {
				$('#scrolltop').hide();
			}
		});

$('.est-menu ul li a').click(function(){
 $('.est-menu ul li').removeClass("active");
 $(this).parent().toggleClass("active");
 return false;
});
 $('.est-menu ul li a').hover(function(){
 $('.est-menu ul li').removeClass("active");
});
	});
	
	function slideInterval() {
		var active = $('#slider li.active');
		var next = $(active).next('li');
		$(active).removeClass('active');
		if ($(next).length) {
			$(next).addClass('active');
		} else {
			$('#slider li:first-child').addClass('active');
		}
	}
	function slidePrev() {
		var active = $('#slider li.active');
		var prev = $(active).prev('li');
		$(active).removeClass('active');
		if ($(prev).length) {
			$(prev).addClass('active');
		} else {
			$('#slider li:last-child').addClass('active');
		}
		slideInit();
	}
	function slideNext() {
		var active = $('#slider li.active');
		var next = $(active).next('li');
		$(active).removeClass('active');
		if ($(next).length) {
			$(next).addClass('active');
		} else {
			$('#slider li:first-child').addClass('active');
		}
		slideInit();
	}

	function slideInit() {
		var time = 5000;
		try {
			window.clearInterval(main_slider_timer);
		} catch(err){}
		main_slider_timer = window.setInterval(slideInterval, time);
	}

	function slidePause() {
		try {
			window.clearInterval(main_slider_timer);
		} catch(err){}
	}

	function scrollNext() {
		var screen = $(this).parents('.scroll-screen').parents('.block');
		if (!$(screen).length) return;
		var next = $(screen).next('.block').find('.scroll-screen');
		if (!$(next).length) return;
		var top = $(next).offset().top;
		$('html, body').animate({'scrollTop': top-130}, 400);
	}


function scrollNext2() {
		
		var next2 = $('html, body').find('#content-bottom');
		if (!$(next2).length) return;
		var top = $(next2).offset().top;
		$('html, body').animate({'scrollTop': top-130}, 400);
	}
})(jQuery);

