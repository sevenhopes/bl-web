(function( $ ) {

	var	$body = $( 'body' ),
		$header = $body.find( '#masthead' ),
		$branding = $header.find( '#bl-branding' ),
		isFrontPage = $body.hasClass( 'home' ) || $body.hasClass( 'twentyseventeen-front-page' ),
		cnt = 1;	// 버튼 깜빡임 카운터

	var $slide = $header.find( '.bl-header-slides' );

	const transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd';

	var	dev = false;

	if ( dev ) {
		$body.addClass( 'bl-dev' );
	}

	// $branding.css( { 'top' : '0', 'opacity' : '1' } );

	// HTML 페이지 준비? 땅!
	$( document ).ready( function() {

		if ( isFrontPage ) {
			// 헤더에 슬라이드쇼
			// $( '.bl-header-slides' ).sss();
			$slide.sss();
		}

		// 페이지 로드 시 현재 페이지가 속한 서브메뉴(드롭다운 메뉴)를 미리 펼치고 있게 함
		// if ( $currentMenuParent.length ) {
		// 	$currentMenuParent.addClass( 'toggled-on' );
		// }

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

	// 화면이 헤더높이의 60% 이상 스크롤 되면 슬라이딩(이미지 전환) 멈춤
	// 다시 올라오면 슬라이딩 시작
	$( window ).on( 'scroll', function() {
		var scrollTop = $( window ).scrollTop(),
			pausingTop = $( '#masthead' ).height() * 0.6; // 헤더의 top은 늘 0이라고 가정

		if ( pausingTop <= scrollTop ) {
			$slide.sssPause();
		} else if ( scrollTop <= pausingTop ) {
			$slide.sssResume();
		}
	});

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

	// Add header video class after the video is loaded.
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$body.addClass( 'has-header-video' );
	});
})( jQuery );
