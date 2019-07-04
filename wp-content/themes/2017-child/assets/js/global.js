(function( $ ) {

	var	$body = $( 'body' ),
		$branding = $body.find( '#bl-branding' ),
		isFrontPage = $body.hasClass( 'home' ) || $body.hasClass( 'twentyseventeen-front-page' ),
		cnt = 1;	// 버튼 깜빡임 카운터

	const transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd';

	var	dev = false;

	if ( dev ) {
		$body.addClass( 'bl-dev' );
	}

	$( document ).ready( function() {

		// SVG 이미지 처리 (부모테마 Twentyseventeen에서 가져옴)
		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

		// 지도가 있는 페이지: 네이버 지도 객체 생성
		if ( $body.find( '#bl-map').length ) {
			var location = new naver.maps.LatLng( 37.868873, 127.715002 );
			var map = new naver.maps.Map( 'bl-map', {
				center: location,
				zoom: 12
			});
			var marker = new naver.maps.Marker( {
				position: new naver.maps.LatLng( 37.868873, 127.715002 ),
				map: map
			});
		}
	}); // End of $(document).ready()

	if ( isFrontPage ) {
		var $slide = $body.find( '.bl-slides' ),
			$eventBlock = $body.find( '#bl-event' ),
			$downArrow = $body.find( 'svg.bl-indication' ),
			indi_intv;

		// Super Simple Slide by sss.js
		$slide.sss();
		// $slide.sss( { speed: 1000 } ); // 테스트용 코드

		// 아래화살표 svg 이미지를 10번 깜빡임
		indi_intv = setInterval( function() {
			$downArrow.fadeOut().fadeIn();
		}, 400+400+1000 );
		setTimeout( function() {
			clearInterval( indi_intv );
		}, 19000 );

		if ( ! $eventBlock.find( '.bl-big-day.bl-holiday' ).length ) {
			$eventBlock.find( '.bl-event-comment' ).hide();
		}

		// 스크롤다운에 의해 '헤더+슬라이더'가 35% 이하만 보이면 슬라이딩(이미지 전환) 멈춤
		// 스크롤업에 의해 65% 이상이 보이면 슬라이딩 다시 시작
		$( window ).on( 'scroll', function() {
			var scrollTop = $( window ).scrollTop(),
				pausingTop = 0.35 * ( $body.find( '#masthead' ).height() + $slide.height() );

			if ( pausingTop < scrollTop ) {
				$slide.sssPause();
			} else if ( scrollTop <= pausingTop ) {
				$slide.sssResume();
			}
		});
	} else if ( $body.find( '#why-bl' ).length ) {
		// Why Bridge Light 페이지의 accordion 동작
		var $why_list = $body.find( '.bl-why-list' );

		$why_list.find( 'dt' ).click( function() {
			var _this = $( this ),
				$open_dt = $why_list.find( 'dt.opened' );

			if ( $open_dt.length ) {
				if ( _this.get(0) !== $open_dt.get(0) ) {
					blToggleContent( _this );
				}
				blToggleContent( $open_dt );
			} else {
				blToggleContent( _this );
			}

			function blToggleContent( dt ) {
				var num = dt.children( 'div' ),
					numStyleToggle = num.css( 'opacity' ) === '1' ?
						{ opacity: '0.2', fontSize: '3rem', marginLeft: '0', marginTop: '0' } :
						{ opacity: '1', fontSize: '4rem', marginLeft: '-0.3rem', marginTop: '-0.4rem' };

				num.animate( numStyleToggle );
				dt.next( 'dd' ).slideToggle();
				dt.toggleClass( 'opened' );
				dt.find( 'button' ).toggleClass( 'opened' );
			}
		});
	} else if ( $body.find( '#faq' ).length ) {
		// FAQ 페이지의 동작
		var $cat_wrap = $body.find( '.bl-faq-category' ),
			$categories = $cat_wrap.children( 'div' ),
			$chosen_cat = $cat_wrap.children( '.top-10' ),
			$faq_list = $body.find( '.bl-faq-list' ),
			$questions = $faq_list.find( 'dt' ),
			$answers = $faq_list.find( 'dd' ),
			$no_result = $faq_list.find( '.no-result' ),
			$textbox = $body.find( 'input' ),
			input = '';

		// 질문 터치 시 답변 보여줌 (accordion 방식)
		$questions.click( function() {
			var _this = $( this ),
				$open_dt = $faq_list.find( 'dt.opened' );

			if ( $open_dt.length ) {
				if ( _this.get(0) !== $open_dt.get(0) ) {
					blToggleAnswer( _this );
				}
				blToggleAnswer( $open_dt );
			} else {
				blToggleAnswer( _this );
			}

			function blToggleAnswer( dt ) {
				dt.next( 'dd' ).slideToggle();
				dt.toggleClass( 'opened' );
			}
		});

		// 카테고리 터치 시 동작
		$categories.click( function() {
			var clicked_cat = $( this ).attr( 'class' );

			$textbox.val( '' );
			$faq_list.find( 'dt.opened' ).removeClass( 'opened' );
			$answers.hide();
			// $categories.removeClass( 'selected' );
			$chosen_cat.removeClass( 'selected' );

			$.each( $questions, function() {
				if ( $( this ).hasClass( clicked_cat ) ) {
					$( this ).show();
				} else {
					$( this ).hide();
				}
			});

			$( this ).addClass( 'selected' );
			$chosen_cat = $( this );

			// console.log( 'click: ' + clicked_cat );
		});

		// FAQ 페이지 텍스트 실시간 검색
		$textbox.keyup( function() {
			input = $textbox.val();
			$answers.hide();	// 타이핑 시 열려있는 답변 닫기
			if ( input === '' ) {
				$no_result.hide();
				$answers.hide();
				$chosen_cat.removeClass( 'selected' );
				$.each( $questions, function() {
					if ( $( this ).hasClass( $chosen_cat.attr( 'class' ) ) ) {
						$( this ).show();
					} else {
						$( this ).hide();
					}
				});
				$chosen_cat.addClass( 'selected' );
			} else {
				$.each( $questions, function() {
					if ( $( this ).text().indexOf( input ) > -1 ) {
						$( this ).show();
					} else {
						$( this ).hide();
					}

					if ( $questions.children( ':visible' ).length == 0 ) {
						$no_result.show();
					} else {
						$no_result.hide();
					}
				});
			}
			// console.log( 'input val: ' + $textbox.val() );
		});

		// 키워드 입력 후 Enter 키로 인한 페이지 새로고침 방지
		$textbox.keydown( function( key ) {
			if ( key.keyCode == 13 ) {
				console.log( 'enter key pressed' );
				$textbox.blur();
			}
		});

		// 처음엔 top-10 카테고리를 보여줌
		// blShowCategory( 'top-10' );
		// $chosen_cat.addClass( 'selected' );
		$chosen_cat.trigger( 'click' );
	} else if ( $body.find( '#study-in-america' ).length ) {
		var $tabs = $body.find( '.bl-tabs .tabs button' ),
			$media = $body.find( '.bl-tabs .media img' ),
			$desc = $body.find( '.bl-tabs .desc div' );
			// tab-array = { 'homestay' => 0, 'school' => 1, 'experience' => 2, 'travel' => 3 };

		$tabs.click( function() {
			// var id = $( this ).attr( 'id' );
			var idx = $tabs.index( $(this) );

			$media.fadeOut();
			$( $media.get( idx ) ).fadeIn();
			$desc.fadeOut();
			$( $desc.get( idx ) ).fadeIn();
		});
	}

	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 * (부모테마 Twentyseventeen에서 가져옴)
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	// Add header video class after the video is loaded. (부모테마 Twentyseventeen에서 가져옴)
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$body.addClass( 'has-header-video' );
	});
})( jQuery );
