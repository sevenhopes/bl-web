/*
Version: 2.0.0
*/
(function( $ ) {

	// $.blang = {}; // bl + lang
	// $.blang.ko = {
	// 	a: "",
	// 	b: "",
	// 	c: "",
	// 	d: "",
	// 	e: ""
	// };
	// $.blang.en = {
	// 	a: "",
	// 	b: "",
	// 	c: "",
	// 	d: "",
	// 	e: ""
	// };

	var	$body = $( 'body' ),
		$header = $body.find( '.site-header' ),
		header_h = $header.height(),
		is_front_page = $body.hasClass( 'home' ) || $body.hasClass( 'twentyseventeen-front-page' ),
		// lang_kor = false,	// true: Korean
		bookmark_top = 0,
		is_widescreen = ( $body.find( '#content' ).width() == 860 );	// 960 - (padding-left 50 + padding-right 50)
		// lang_val;

	const transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd';

	// 주석 제거: header.php에 있는 개발 모드 <div>를 보여주기
	// $body.addClass( 'bl-dev' );

	// function blGetLanguage() {
	// 	var nav_lang = navigator.language,
	// 		nav_ul = navigator.userLanguage;
	// 	// console.log( 'nav.lang: ' + navigator.language + '\n' + 'nav.ulang: ' + navigator.userLanguage );
	// 	return nav_lang || nav_ul;
	// }

	// lang_val = blGetLanguage();

	// console.log( 'lang_val: ' + lang_val );
	// lang_kor = (lang_val === 'ko-KR' || lang_val === 'ko');

	// 브라우저의 언어 설정을 따라 페이지 언어 선택 (CSS 클래스로 등록)
	$body.addClass( navigator.language || navigator.userLanguage );
	// $body.addClass( lang_val );

	if ( is_front_page ) {
		var	$eventBlock = $body.find( '#bl-event' ),
			$downArrow = $body.find( '.bl-down-arrow' ),
			indi_intv;

		// 아래화살표 svg 이미지를 7번 깜빡임 (250+250+750 * 7 = 8750)
		indi_intv = setInterval( function() {
			$downArrow.fadeOut( 'fast' ).fadeIn( 'fast' );
		}, 250+250+750 );
		setTimeout( function() {
			clearInterval( indi_intv );
		}, 8750+100 );

		$downArrow.on( 'click', function() {
			$( 'html, body' ).animate( {
				scrollTop: $( '#bl-news' ).offset().top - header_h - 5
			}, 400);
		});

		if ( ! $eventBlock.find( '.bl-event-item.bl-holiday' ).length ) {
			$eventBlock.find( '.bl-event-comment' ).hide();
		}

	// '왜 브릿지라잇인가' 페이지
	} else if ( $body.find( '#why-bl' ).length ) {
		// Why Bridge Light 페이지의 accordion 동작
		var $why_list = $body.find( '.bl-why-list' );

		$why_list.find( 'dt' ).on( 'click', function() {
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

	// '자주 묻는 질문' 페이지
	} else if ( $body.find( '#faq' ).length ) {
		// FAQ 페이지의 동작
		var $cat_wrap = $body.find( '.bl-faq-category' ),
			$categories = $cat_wrap.children( 'div' ),
			$chosen_cat = $cat_wrap.children( '.top-10' ),
			$faq_list = $body.find( '.bl-faq-list' ),
			$questions = $faq_list.find( 'dt' ),
			$answers = $faq_list.find( 'dd' ),
			$no_result = $faq_list.find( '.no-result' ),
			$textbox = $body.find( 'input.bl-faq-input' ),
			input = '';

		// 질문 터치 시 답변 보여줌 (accordion 방식)
		$questions.on( 'click', function() {
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
		$categories.on( 'click', function() {
			var _this = $( this ),
				clicked_cat = _this.attr( 'class' );

			$textbox.val( '' );
			$faq_list.find( 'dt.opened' ).removeClass( 'opened' );
			$answers.hide();
			// $categories.removeClass( 'selected' );
			$chosen_cat.removeClass( 'selected' );

			$.each( $questions, function() {
				if ( _this.hasClass( clicked_cat ) ) {
					_this.show();
				} else {
					_this.hide();
				}
			});

			_this.addClass( 'selected' );
			$chosen_cat = _this;

			// console.log( 'click: ' + clicked_cat );
		});

		// FAQ 페이지 텍스트 실시간 검색
		$textbox.keyup( function() {
			var _this = $( this );
			input = $textbox.val();
			$answers.hide();	// 타이핑 시 열려있는 답변 닫기
			if ( input === '' ) {
				$no_result.hide();
				$answers.hide();
				$chosen_cat.removeClass( 'selected' );
				$.each( $questions, function() {
					if ( _this.hasClass( $chosen_cat.attr( 'class' ) ) ) {
						_this.show();
					} else {
						_this.hide();
					}
				});
				$chosen_cat.addClass( 'selected' );
			} else {
				$.each( $questions, function() {
					if ( -1 < _this.text().indexOf( input ) ) {
						_this.show();
					} else {
						_this.hide();
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
				// console.log( 'enter key pressed' );
				$textbox.blur();
			}
		});

		// 처음엔 top-10 카테고리를 보여줌
		// blShowCategory( 'top-10' );
		// $chosen_cat.addClass( 'selected' );
		$chosen_cat.trigger( 'click' );

	// '미국현지체험연수' 페이지
	} else if ( $body.find( '#study-in-america' ).length ) {
		var $imgs = $body.find( '.bl-tabs .media div' ),
			$tabs = $body.find( '.bl-tabs .tabs button' ),
			$desc = $body.find( '.bl-tabs .desc div' ),
			$selected = $tabs.eq( 0 );

		$selected.addClass( 'selected' );

		// $imgs.css( 'display', 'none');
		// $imgs.eq( 0 ).css( 'display', 'block' );
		// var img_height = $imgs.eq( 0 ).css( 'height' );
		// $body.find( '.bl-tabs .media' )
			// .css( 'min-height', img_height );
			// .css( 'height' , img_height );

		$tabs.on( 'click', function() {
			var _this = $( this ),
				idx = $tabs.index( _this );

			$selected.removeClass( 'selected' );
			$selected = _this.addClass( 'selected' );

			$imgs.fadeOut();
			$imgs.eq( idx ).fadeIn();
			$desc.hide();
			$desc.eq( idx ).show();
		});

	} // end of if ( 페이지별 처리 )

	// 북마크 id로 바로 이동을 피하기 위해 URL 내의 북마크 id에 #을 하나 더 붙여서 넘어옴
	// 예: bl-course-overview.php의 ##course-basic 또는 front-page.php의 ##events
	var idx = window.location.href.search( '##' );
	if ( idx != -1 ) {
		var bookmark = window.location.href.substring( idx + 1 );
		bookmark_top = $( bookmark ).offset().top - header_h - 10;
	}

	// 페이지를 스크롤 함. (북마크 링크 대신 사용. 스크롤 거리에 따라 속도 조절)
	function scrollThePage( top ) {
		var scroll_speed = bookmark_top < 400 ? 400 : Math.ceil( bookmark_top ) > 600 ? 600 : Math.ceil( bookmark_top );
		if ( is_widescreen ) { top -= 40; }
		$( 'html, body' ).animate( { scrollTop: top }, scroll_speed );
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


	$( document ).ready( function() {

		// SVG 이미지 처리 (부모테마 Twentyseventeen에서 가져옴)
		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

		if ( bookmark_top != 0 ) {
			scrollThePage( bookmark_top );
		}

		// 지도가 있는 페이지: 네이버 지도 객체 생성
		if ( $body.find( '#bl-map').length ) {
			var map, marker, pano;
			$.getScript( 'https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=lsnb5x78u2&submodules=panorama', function() {
				naver.maps.onJSContentLoaded = function() {
					var location = new naver.maps.LatLng( 37.868950, 127.715030 );

					map = new naver.maps.Map( 'bl-map', {
						center: location,
						zoom: 11,
						minZoom: 1,
						zoomControl: true,
						zoomControlOptions: {
							style: naver.maps.ZoomControlStyle.SMALL,
							position: naver.maps.Position.TOP_RIGHT
						},
						mapDataControl: false,
						logoControl: false,
						scaleControl: false
					});

					marker = new naver.maps.Marker( {
						position: location,
						map: map
					});

					pano = new naver.maps.Panorama( 'bl-street', {
						position: new naver.maps.LatLng( 37.869003, 127.714987 ),
						// size: new naver.maps.Size('100%', '300px'),
						pov: {
							pan: 150,
							tilt: 18,
							fov: 90
						}
					});
				};
			});
		}

		if ( is_front_page ) {
			if ( 0 == $( window ).scrollTop() ) {
				$body.find( '.bl-slides' ).sss();
			} else {
				$body.find( '.bl-slides' ).sss( { autostart: false } );
			}
		}

		var scroll_timer,
			scrolling = false;

		// header의 높이를 스크롤다운 시 좀 줄였다가, top으로 스크롤업 시 다시 원래대로 만듬
		// 변하는 header 높이에 따라, 내비게이션 메뉴($navMenu)의 높이도 변함.
		$( window ).on( 'scroll', function() {
			clearTimeout( scroll_timer );
			scroll_timer = setTimeout( function() {
				controlSlide();
				// changeHeaderSize();
				// if ( is_widescreen ) {
				// 	$body.find( '.navigation-top' ).fadeOut( 200 );
				// }
				scrolling = false;
			}, 100 );

			if ( ! scrolling ) {
				scrolling = true;
				// changeHeaderSize();
			}
		});
		/*function scroll_delay() {
			controlSlide();
			// changeHeaderSize();
			if ( is_widescreen ) {
				hideWideNav();
			}
			scrolling = false;
		}*/
	}); // End of $(document).ready()

	// 스크롤다운에 의해 페이지가 조금이라도 내려가면 슬라이드 멈춤, 맨 꼭대기일 때만 재생
	function controlSlide() {
		if ( ! is_front_page ) {
			return;
		}
		if ( 0 == $( window ).scrollTop() ) {
			$body.find( '.bl-slides' ).sss( { playback: true } );
		} else {
			$body.find( '.bl-slides' ).sss( { playback: false } );
		}
	}

	// 스크롤다운 시 헤더 높이 줄임
	// 스크롤업 시 페이지 top 근처까지 올라가면 헤더 높이 복구
/*	function changeHeaderSize() {
		if ( is_widescreen ) {
			return;
		}

		var $navMenu = $body.find( '.navigation-top' ),
			$logo_link = $header.find( '.custom-logo-link' ),
			$navBtn = $header.find( '#bl-menu-toggle' ),
			scroll_top = $( window ).scrollTop(),
			short_header = false,
			nav_top = '76px', // normal
			dur = 200;

		if ( ! short_header && 0 != scroll_top ) {
			nav_top = '56px'; // scrolling
			short_header = true;

			$logo_link.animate({ top: '0px' }, dur );
			$navBtn.animate({ marginTop: '0' }, dur );
			$header.animate({ height: nav_top }, dur );
			$navMenu.css( 'top', nav_top );

		} else if ( short_header && scroll_top == 0 ) {
			short_header = false;

			$logo_link.animate({ top: '10px' }, dur, function() {
				$navMenu.css( 'top', nav_top );
			});
			$navBtn.animate({ marginTop: '10px' }, dur );
			$header.animate({ height: nav_top }, dur );
		}
	}
*/
	// Add header video class after the video is loaded. (부모테마 Twentyseventeen에서 가져옴)
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$body.addClass( 'has-header-video' );
	});
})( jQuery );
