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
				position: location.destinationPoint(90, 15),
				map: map,
				icon: {
					url: 'http://www.bridgelightels.com/m/wp-content/themes/2017-child/assets/images/map-marker.png',
					size: new naver.maps.Size( 100, 100 ),
					// origin: new naver.maps.Point( 0, 0 ),
					anchor: new naver.maps.Point( 50, 50 )
			    }
			} );
		}
	}); // End of $(document).ready()

	if ( isFrontPage ) {
		// 페이지 로드 시 현재 페이지가 속한 서브메뉴(드롭다운 메뉴)를 미리 펼치고 있게 함
		// if ( $currentMenuParent.length ) {
		// 	$currentMenuParent.addClass( 'toggled-on' );
		// }

		var $slide = $body.find( '.bl-header-slides' );

		// Super Simple Slide by sss.js
		$slide.sss();
		// $slide.sss( { speed: 1000 } ); // 테스트용 코드

		var $eventBlock = $body.find( '#bl-event' );

		if ( ! $eventBlock.find( '.bl-big-day.bl-holiday' ).length ) {
			$eventBlock.find( '.bl-red-desc' ).hide();
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
	}

	// Why Bridge Light 페이지의 accordion 동작
	if ( $body.find( '#why-bl' ).length ) {
		var $blAccord = $body.find( '.bl-accordion' );

		$blAccord.find( 'dd' ).hide();

		$blAccord.find( 'dt' ).click( function() {
			var $dd = $( this ).next( 'dd' ),
				$open_dd = $blAccord.find( 'dd.opened' );

			var $accNum = $( this ).children( 'div' ),
				$open_accNum = $open_dd.prev( 'dt ').children( 'div' );

			if ( $open_dd.length ) {
				if ( $dd.get(0) !== $open_dd.get(0) ) {
					blOpenAccItem( $dd, $accNum );
				}
				blCloseAccItem( $open_dd, $open_accNum );
			} else {
				blOpenAccItem( $dd, $accNum );
			}

			function blOpenAccItem( fdd, fnum ) {
				fdd.slideToggle().toggleClass( 'opened' );
				fnum.animate( { opacity: 1, fontSize: '4rem', marginLeft: '-0.3rem', marginTop: '-0.4rem' } );
			}
			
			function blCloseAccItem( fdd, fnum ) {
				fdd.slideToggle().toggleClass( 'opened' );
				fnum.animate( { opacity: 0.2, fontSize: '3rem', marginLeft: 0, marginTop: 0 } );
			}
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
