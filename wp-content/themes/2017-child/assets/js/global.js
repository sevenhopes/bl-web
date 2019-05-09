(function( $ ) {

	var	$body = $( 'body' ),
		$customHeader = $body.find( '.custom-header' ),
		$branding = $customHeader.find( '#bl-branding' ),
		$heroText = $customHeader.find( '#bl-hero-text' ),
		$heroButton = $customHeader.find( '#bl-hero-button' ),
		$heroLink = $customHeader.find( '#bl-hero-button a' ),
		$blMenuToggle = $branding.find( '#bl-menu-toggle' ),
		$navTop = $body.find( '.navigation-top' ),
		$siteNavContain = $navTop.find( '.main-navigation' ),
		$dropdowns = $siteNavContain.find( '.dropdown-toggle' ), // 모든 드롭다운 버튼(화살표)
		$currentMenuParent = $siteNavContain.find( '.current-menu-parent' ),
		$linksMenuParents = $siteNavContain.find( '.menu-item-has-children > a:first-child' ),
		isFrontPage = $body.hasClass( 'home' ) || $body.hasClass( 'twentyseventeen-front-page' ),
		cnt = 1,	// 버튼 깜빡임 카운터
		intv = 4000;	// 
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

	if ( $blMenuToggle.length ) {
		blInitMenuToggleEvents();
	}

	if ( $dropdowns.length ) {
		blInitDropdowns();
	}

	function blInitMenuToggleEvents() {		
		// 메뉴 펼침/숨김 상태 숨김으로 초기화.
		$blMenuToggle.attr( 'aria-expanded', 'false' );

		// 네비게이션 메뉴가 보이는 상태에서 다른 곳을 터치하면 (포커스를 옮기면) 메뉴를 숨김
		$body.click( function( e ) {
			if ( 'true' === $blMenuToggle.attr( 'aria-expanded' ) ) {
				blToggleNavigation( true );
			}
		} );

		// 네비게이션 메뉴를 보여주거나 숨기는 버튼의 동작 (드롭다운 버튼 아님, 전체 메뉴의 버튼)
		$blMenuToggle.click( function( e ) {
			e.stopPropagation();
			blToggleNavigation();
		} );

		$navTop.click( function( e ) {
			e.stopPropagation();
		} );

		// 네비게이션 메뉴가 보이는 상태에서 스크롤다운을 많이 하면 메뉴를 숨김
		$( window ).on( 'scroll', function() {
			if ( $siteNavContain.hasClass( 'toggled-on' ) && ! $navTop.is( ':animated' ) ) {
				var scrollTop = $( window ).scrollTop(),
					navHeight = $siteNavContain.height();

				if ( scrollTop >= ( navHeight - 100 ) ) {
					blToggleNavigation( true );
				}
			}
		});

		function blToggleNavigation( hide = false ) {
			if ( ! $navTop.is( ':animated' ) ) {
				if ( $navTop.is( ':visible' ) || hide ) {
					$navTop.animate( { 'right' : '-100px', 'opacity' : '0' }, function() {
						$navTop.hide();
						blToggleNavCSS(); // 이걸 여기서 해야 애니메이션 중 메뉴가 사라짐을 방지
					} );
				} else {
					blToggleNavCSS(); // 이걸 먼저 해야 아래 애니메이션 중 메뉴가 보임
					$navTop.show().animate( { 'right' : '0', 'opacity' : '1' } );
				}
			}

			function blToggleNavCSS() {
				$siteNavContain.toggleClass( 'toggled-on' );
				$blMenuToggle.attr( 'aria-expanded', $siteNavContain.hasClass( 'toggled-on' ) ? 'true' : 'false' );
			}
		}
	} // End of blInitMenuToggleEvents()

	function blInitDropdowns() {
		// 기존 부모 테마의 클릭 이벤트 해제
		$dropdowns.unbind( 'click' );

		// 클릭 이벤트 재등록
		$dropdowns.click( function( e ) {
			var clickedDropdown = $( this ),
				droppedMenu = $siteNavContain.find( '.dropdown-toggle.toggled-on' );

			e.preventDefault();

			blToggleDropdownMenu( clickedDropdown );

			// 열려 있는 '다른' 서브메뉴(droppedMenu)는 닫음
			if ( droppedMenu.get(0) !== clickedDropdown.get(0) ) {
				blToggleDropdownMenu( droppedMenu );
			}
		});

		// 메인메뉴 아이템 자체(<a>태그)를 눌러도 드롭다운 버튼과 같은 동작 설정
		$linksMenuParents.click( function( e ) {
			e.preventDefault();
			$( this ).next( '.dropdown-toggle' ).trigger( 'click' );
		});

		function blToggleDropdownMenu( dropdownToggle ) {
			var menuParent = dropdownToggle.parent( '.menu-item-has-children' ),
				menuChildren = dropdownToggle.next( '.sub-menu' );

			menuParent.toggleClass( 'toggled-on' );
			dropdownToggle.toggleClass( 'toggled-on' )
				.attr( 'aria-expanded', dropdownToggle.attr( 'aria-expanded' ) === 'true' ? 'false' : 'true' );

			menuChildren.slideToggle( 'fast', function() { // 슬라이드 동작이 끝난 후 토글상태 변경
				menuChildren.toggleClass( 'toggled-on' );
			});
		}
	} // End of blInitMenuToggleEvents()

	// HTML 페이지 준비? 땅!
	$( document ).ready( function() {

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

		// 현재 페이지가 속한 메뉴를 표시
		if ( $currentMenuParent.length ) {
			$currentMenuParent.addClass( 'bl-imhere' );
		}
		// 페이지 로드 시 현재 페이지가 속한 서브메뉴(드롭다운 메뉴)를 미리 펼치고 있게 함
/*		if ( $currentMenuParent.length ) {
			$currentMenuParent.addClass( 'toggled-on' );
		}
*/		// SVG 이미지 처리 (부모테마 Twentyseventeen에서 가져옴)
		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
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
})( jQuery );
