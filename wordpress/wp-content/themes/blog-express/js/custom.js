( function( $ ) {

	'use strict';

	$( document ).ready(function( $ ) {

		$('#search-button, .search-box-blur').on('click', function( e ) {
			e.preventDefault();
			$('#search-button, .search-box-blur, .custom-search-container, #page.site').toggleClass('search-open');
		});

		// Featured slider.
		$( '.blog-express-featured-slider' ).slick();

		// Sidebar trigger.
		$( '#sidebar-trigger' ).sidr({
			timing: 'ease-in-out',
			speed: 300,
			side: 'right',
			source: '#pull-sidebar',
			name: 'sidr-pull-sidebar',
			renaming: false
		});

		$('.btn-close-sidebar').on('click',function(e){
			e.preventDefault();
			$.sidr('close', 'sidr-pull-sidebar');
		});

		// Mobile menu.
		$( '#mobile-trigger' ).sidr({
			timing: 'ease-in-out',
			speed: 300,
			source: '#mob-menu',
			name: 'sidr-main',
			renaming: false
		});

		$('#sidr-main').find( '.sub-menu' ).before( '<span class="item-toggle"><strong class="icon-dropdown"></strong></span>' );

		$('#sidr-main').find( '.item-toggle').on('click',function(e){
			e.preventDefault();
			$(this).next('.sub-menu').slideToggle();
			$(this).toggleClass( 'toggle-on' );
		});

		// Masonry grid.
		if ( $('body').hasClass('archive-layout-grid') && $('#masonry-main').length > 0 ) {
			var $blocks = $('#main');

			$blocks.imagesLoaded(function(){
				$blocks.masonry({
					'columnWidth': '.hentry',
					'itemSelector': '.hentry',
					'percentPosition': true
				});

				$('.hentry').fadeIn();
			});

			$(window).on('resize', function() {
				$blocks.masonry();
			});
		}

		// Implement go to top.
		var $scrollup_object = $( '#btn-scrollup' );
		if ( $scrollup_object.length > 0 ) {
			$( window ).on( 'scroll', function() {
				if ( $( this ).scrollTop() > 100 ) {
					$scrollup_object.fadeIn();
				} else {
					$scrollup_object.fadeOut();
				}
			});

			$scrollup_object.on('click', function() {
				$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
				return false;
			});
		}

	});

} )( jQuery );
