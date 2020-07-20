/** Super Simple Slider by @intllgnt **/

;(function($, window, document, undefined ) {

	var target,
		slides,
		slider,
		transition,
		slide_count,
		timer;

	$.fn.sss = function(options) {

		var settings = $.extend({
			playback : true,
			autostart : true,	// window.load()에서만 사용
			startOn : 0,
			speed : 7000,
			transition : 600,
			indicator : true
		}, options);

		return this.each(function() {

			var wrapper = $(this),
				is_setup = wrapper.children().attr( 'class' ) === "sss",
				animating = false;

			if ( ! is_setup ) {
				setup_slide();
			} else {
				if ( settings.playback ) {
					reset_timer();
				} else {
					clear_timer();
				}
			}

			function setup_slide() {
				slides = is_setup ? wrapper.children() : wrapper.children().wrapAll('<div class="sss"/>').addClass('ssslide'),
				slider = wrapper.find('.sss'),
				slide_count = slides.length,
				transition = settings.transition,
				starting_slide = settings.startOn,
				target = starting_slide > slide_count - 1 ? 0 : starting_slide;

				slider.css({paddingBottom: get_height(target)});
				
				if ( settings.indicator ) {
					// slider.append( '' );
				}
			}
			function reset_timer() {
				clearTimeout(timer);
				timer = setTimeout(next_slide, settings.speed);
			}
			function clear_timer() {
				clearTimeout( timer );
			}

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
			}
			function next_slide() {
				target = target === slide_count - 1 ? 0 : target + 1;
				animate_slide(target);
			}
			function prev_slide() {
				target = target === 0 ? slide_count - 1 : target - 1;
				animate_slide(target);
			}

			// Start Sliding
			$(window).load(function() {
				if ( settings.autostart ) {
					animate_slide(target);
				}
				// slider.css({paddingBottom: get_height(target)});

				// 폰화면에서 왼쪽 오른쪽 쓸어넘기기 동작으로 이미지 전환 (jq-move-swipe.js)
				slider.on('swipeleft', function(e) { e.stopPropagation(); next_slide(); })
					.on('swiperight', function(e) { e.stopPropagation(); prev_slide(); });
			});

		}); // End of return
	}; // End of sss()

})(jQuery, window, document);