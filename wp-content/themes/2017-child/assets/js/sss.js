/** Super Simple Slider by @intllgnt **/

;(function($, window, document, undefined ) {

	var timer;
	var isSliding = false;

	$.fn.sss = function(options) {

	// Options

		var settings = $.extend({
			slideShow : true,
			startOn : 0,
			speed : 7000,
			transition : 600,
			arrows : true
		}, options);

		return this.each(function() {

	// Variables

			var
			wrapper = $(this),
			// slides = wrapper.children().wrapAll('<div class="sss"/>').addClass('ssslide'),
			slides = wrapper.children().attr( 'class' ) === "sss" ? wrapper.children() : wrapper.children().wrapAll('<div class="sss"/>').addClass('ssslide'),
			slider = wrapper.find('.sss'),
			slide_count = slides.length,
			transition = settings.transition,
			starting_slide = settings.startOn,
			target = starting_slide > slide_count - 1 ? 0 : starting_slide,
			animating = false,
			clicked,
			// timer,
			key,
			prev,
			next;

		// Reset Slideshow

			reset_timer = settings.slideShow ? function() {
				clearTimeout(timer);
				timer = setTimeout(next_slide, settings.speed);
			} : $.noop;

		// Animate Slider

			function get_height(target) {
				return ((slides.eq(target).height() / slider.width()) * 100) + '%';
			}

			function animate_slide(target) {
				if (!animating) {
					animating = true;
					var target_slide = slides.eq(target);

					target_slide.fadeIn(transition);
					slides.not(target_slide).fadeOut(transition);

					slider.animate({paddingBottom: get_height(target)}, transition, function() {
						animating = false;
					});

					reset_timer();

				}
			};

		// Next Slide

			function next_slide() {
				target = target === slide_count - 1 ? 0 : target + 1;
				animate_slide(target);
			}

		// Prev Slide

			function prev_slide() {
				target = target === 0 ? slide_count - 1 : target - 1;
				animate_slide(target);
			}

			// if (settings.arrows) {
			// 	slider.append('<div class="sssprev"/>', '<div class="sssnext"/>');
			// }

			// next = slider.find('.sssnext'),
			// prev = slider.find('.sssprev');

		// Start Sliding

			$(window).load(function() {
				// slider.click(function(e) {
				// 	e.stopPropagation();
				// 	clicked = $(e.target);
				// 	if (clicked.is(next)) { next_slide() }
				// 	else if (clicked.is(prev)) { prev_slide() }
				// });

				// next.click(function(e) {
				// 	e.stopPropagation();
				// 	next_slide();
				// });
				// prev.click(function(e) {
				// 	e.stopPropagation();
				// 	prev_slide();
				// });
				
				// animate_slide(target);

				// $(document).keydown(function(e) {
				// 	key = e.keyCode;
				// 	if (key === 39) { next_slide() }
				// 	else if (key === 37) { prev_slide() }
				// });

				slider.css({paddingBottom: get_height(target)});
				animate_slide(target);
				isSliding = true;

				// 폰화면에서 왼쪽 오른쪽 쓸어넘기기 동작으로 이미지 전환 (jq-move-swipe.js)
				slider.on('swipeleft', function(e) { e.stopPropagation(); next_slide(); })
					.on('swiperight', function(e) { e.stopPropagation(); prev_slide(); });
			});

			// 화면이 헤더높이의 60% 이상 스크롤 되면 슬라이딩(이미지 전환) 멈춤
			// 다시 올라오면 슬라이딩 시작
			$( window ).on( 'scroll', function() {
				var scrollTop = $( window ).scrollTop(),
					pausingTop = $( '#masthead' ).height() * 0.6; // 헤더의 top은 늘 0이라고 가정

				if ( isSliding && pausingTop <= scrollTop ) {
					clearTimeout(timer);
					isSliding = false;
				} else if ( !isSliding && scrollTop <= pausingTop ) {
					slider.css({paddingBottom: get_height(target)});
					animate_slide( target );
					isSliding = true;
				}
			});

		}); // End of return

	};
})(jQuery, window, document);
