jQuery(document).ready(function ($) {
	'use strict';

	$('.demo-filter a').on('click', function (e) {
		e.preventDefault();
		var filter = $(this).attr('href').replace('#', '');
		$('.demos').isotope({ filter: '.' + filter });
		$(this).addClass('active').siblings().removeClass('active');
	});


	// Mobile Menu Toggle - Show & Hide
	$('.mobile-menu-toggler').on('click', function (e) {
		$('body').toggleClass('mmenu-active');
		$(this).toggleClass('active');
		e.preventDefault();
	});

	$('.mobile-menu-overlay, .mobile-menu-close').on('click', function (e) {
		$('body').removeClass('mmenu-active');
		$('.menu-toggler').removeClass('active');
		e.preventDefault();
	});

	$('.goto-demos').on('click', function (e) {
		e.preventDefault();
		$('html, body').animate({ scrollTop: $('.row.demos').offset().top }, 600);
	});

	$('.goto-features').on('click', function (e) {
		e.preventDefault();
		$('html, body').animate({ scrollTop: $('.section-features').offset().top }, 800);
	});

	$('.goto-elements').on('click', function (e) {
		e.preventDefault();
		$('html, body').animate({ scrollTop: $('.section-elements').offset().top }, 1000);
	});

	$('.goto-support').on('click', function (e) {
		e.preventDefault();
		$('html, body').animate({ scrollTop: $('.section-support').offset().top }, 1200);
	});

	$('.products-slider-home').owlCarousel({
		"nav": false,
		"dots": false,
		"margin": 20,
		"loop": true,
		"responsive": {
			"0": {
				"items": 2
			},
			"480": {
				"items": 2
			},
			"768": {
				"items": 3
			},
			"992": {
				"items": 4
			},
			"1280": {
				"items": 5,
				"nav": true
			}
		}
	});

	$('.products-slider').owlCarousel({
		"nav": false,
		"dots": true,
		"margin": 20,
		"loop": true,
		"responsive": {
			"0": {
				"items": 2
			},
			"480": {
				"items": 2
			},
			"768": {
				"items": 3
			},
			"992": {
				"items": 4
			},
			"1280": {
				"items": 5,
				"nav": true
			}
		}
	})

	$('.brands-slider').owlCarousel({
		"nav": false,
		"dots": true,
		"margin": 30,
		"loop": false,
		"responsive": {
			"0": {
				"items": 2
			},
			"420": {
				"items": 3
			},
			"600": {
				"items": 4
			},
			"900": {
				"items": 5
			},
			"1024": {
				"items": 6
			},
			"1280": {
				"items": 6,
				"nav": true,
				"dots": false
			}
		}
	})

	$('.intro-slider').owlCarousel({
		"nav": false,
		"autoplay":true,
		"items": 1,
		"responsive": {
			"992": {
				"nav": true,
			}
		}
	})
});
