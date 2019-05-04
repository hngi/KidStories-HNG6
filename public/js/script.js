(function($) {

	"use strict";


	//Update Header Style and Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var scrollLink = $('.scroll-to-top');
			if (windowpos >= 20) {
				siteHeader.addClass('fixed-header');
				scrollLink.fadeIn(300);
			} else {
				siteHeader.removeClass('fixed-header');
				scrollLink.fadeOut(300);
			}
		}
	}

	headerStyle();


	//Submenu Dropdown Toggle
	if($('.main-header .navigation li.dropdown ul').length){
		$('.main-header .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');

		//Dropdown Button
		$('.main-header .navigation li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('ul').slideToggle(500);
		});

		//Disable dropdown parent link
		$('.navigation li.dropdown > a').on('click', function(e) {
			e.preventDefault();
		});
	}




	// Faq Carousel
	if ($('.faq-carousel').length) {
		$('.faq-carousel').owlCarousel({
			loop:true,
			margin:50,
			nav:true,
			smartSpeed: 500,
			autoplay: 4000,
			navText: [ '<span class="flaticon-back-5"></span>', '<span class="flaticon-next-7"></span>' ],
			responsive:{
				0:{
					items:1,
					margin:30
				},
				480:{
					items:1,
					margin:30
				},
				600:{
					items:2,
					margin:30
				},
				800:{
					items:2,
					margin:30
				},
				1024:{
					items:3,
					margin:30
				},
				1200:{
					items:3
				}
			}
		});
	}





	// Scroll to a Specific Div
	if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			 }, 1000);

		});
	}

	// Paroller
	if($('.paroller').length){
		$('.paroller').paroller();
	}


	// Elements Animation
	if($('.wow').length){
		var wow = new WOW(
		  {
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       false,       // trigger animations on mobile devices (default is true)
			live:         true       // act on asynchronously loaded content (default is true)
		  }
		);
		wow.init();
	}

/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */

	$(window).on('scroll', function() {
		headerStyle();
	});

/* ==========================================================================
   When document is loaded, do
   ========================================================================== */


})(window.jQuery);
