/** Super Simple Slider by @intllgnt **/

;(function($, window, document, undefined ) {

	var timer,
		is_sliding = false,
		target,
		slides,
		slider,
		animating =false,
		transition,
		slide_count,
		reset_timer;

	$.fn.sss = function(options) {

		var settings = $.extend({
			slideShow : true,
			startOn : 0,
			speed : 7000,
			transition : 600,
			arrows : true
		}, options);

		return this.each(function() {

			var wrapper = $(this);

			slides = wrapper.children().attr( 'class' ) === "sss" ? wrapper.children() : wrapper.children().wrapAll('<div class="sss"/>').addClass('ssslide'),
			slider = wrapper.find('.sss'),
			slide_count = slides.length,
			transition = settings.transition,
			starting_slide = settings.startOn,
			target = starting_slide > slide_count - 1 ? 0 : starting_slide,

			// Reset Slideshow
			reset_timer = settings.slideShow ? function() {
				clearTimeout(timer);
				timer = setTimeout(next_slide, settings.speed);
			} : $.noop;

			// Start Sliding
			$(window).load(function() {

				slider.css({paddingBottom: get_height(target)});
				animate_slide(target);
				is_sliding = true;

				// 폰화면에서 왼쪽 오른쪽 쓸어넘기기 동작으로 이미지 전환 (jq-move-swipe.js)
				slider.on('swipeleft', function(e) { e.stopPropagation(); next_slide(); })
					.on('swiperight', function(e) { e.stopPropagation(); prev_slide(); });
			});

		}); // End of return
	}; // End of sss()

	// jquery 객체에 의해 호출될 수 있는 함수들 (예. obj.sssPause();)
	$.fn.sssPause = function() {
		return this.each( function() {
			if ( is_sliding ) {
				clearTimeout(timer);
				is_sliding = false;
			}
		});
	};

	$.fn.sssResume = function() {
		return this.each( function() {
			if ( !is_sliding ) {
				slider.css({paddingBottom: get_height(target)});
				animate_slide(target);
				is_sliding = true;
			}
		});
	};

	$.fn.sssIsSliding = function() {
		return is_sliding;
	};

	// 이 파일에서만 쓰는 함수들
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

})(jQuery, window, document);