(function( $ ) {

	var	$body = $( 'body' ),
		$header = $body.find( '#masthead' ),
		$branding = $header.find( '#bl-branding' ),
		$heroText = $header.find( '#bl-hero-text' ),
		$heroButton = $header.find( '#bl-hero-button' ),
		$heroLink = $header.find( '#bl-hero-button a' ),
		isFrontPage = $body.hasClass( 'home' ) || $body.hasClass( 'twentyseventeen-front-page' ),
		cnt = 1;	// 버튼 깜빡임 카운터

	const transitionEnd = 'transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd';

	var	dev = false;

	if ( dev ) {
		$body.addClass( 'bl-dev' );
	}

	// 프론트 페이지
	if ( isFrontPage ) {
		// 헤더이미지 위에 1상단 로고(branding), 2히어로텍스트(heroText), 3히어로버튼(heroButton)을 차례로 애니메이션으로 보여줌
		setTimeout(
			function() {
				$branding.addClass( 'bl-fade-in' );
				$heroText.addClass( 'bl-fade-in' );
				setTimeout( function() { $heroButton.addClass( 'bl-fade-in' ); }, 600 );
				setTimeout( blinkHeroButton, 600 );
			},
			600
		);

		// 버튼을 일정 간격으로 깜박이다가 특정 횟수 후에 멈춤
		// 예) 2초 간격으로 깜빡임을 원할 때는 2000 + 1200으로 설정
		function blinkHeroButton() {
			var intv = setInterval( function() {
				if ( 3 <= cnt++ ) {
					clearInterval( intv );
				}

				$heroButton.removeClass( 'bl-fade-in');
				$heroButton.one( transitionEnd, function() { // CSS trasition이 끝나면 콜백 실행
					$( this ).addClass( 'bl-fade-in' );
				});
			}, 2500 );
		}

		// 히어로 링크의 링크값이 '#'로 시작하면 같은 페이지내 북마크로 부드러운 스크롤
		var href = $heroLink.attr( 'href' );
		if ( '' == href ) {
			href = '#bl-direct-buttons';
		}
		if ( href.startsWith( '#' ) ) {
			$heroButton.click( function( e ) {
				e.preventDefault();
				$( window ).scrollTo( href, { duration: 600 } );
			});
		}
	// 일반 페이지: 헤더 로고(.custom-logo-link img)만 보여주고, 히어로이미지(.custom-header-media) 숨김
	} else {
		$branding.css( { 'top' : '0', 'opacity' : '1' } );
	}

	// HTML 페이지 준비? 땅!
	$( document ).on( 'pageinit', function() {

		// 페이지 로드 시 현재 페이지가 속한 서브메뉴(드롭다운 메뉴)를 미리 펼치고 있게 함
/*		if ( $currentMenuParent.length ) {
			$currentMenuParent.addClass( 'toggled-on' );
		}
*/		// SVG 이미지 처리 (부모테마 Twentyseventeen에서 가져옴)
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
