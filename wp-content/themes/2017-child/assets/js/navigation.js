/* global twentyseventeenScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 *
 * 부모테마를 override하는 파일
 * - 부모에서 가져온 코드는 그대로 두고 자식테마(2017-child)의 코드를 추가
 */

(function( $ ) {
	// document.ready() 밖으로 꺼내면 .dropdown-toggle을 선택하지 못 함.
	$( document ).on( 'pageinit', function() {

		var masthead, menuToggle, siteNavContain, siteNavigation;

		function initMainNavigation( container ) {

			// Add dropdown toggle that displays child menu items.
			var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
				.append( twentyseventeenScreenReaderText.icon )
				.append( $( '<span />', { 'class': 'screen-reader-text', text: twentyseventeenScreenReaderText.expand }) );

			container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

	/*		bl: 현재 페이지에 해당 하는 드롭다운 메뉴 펼치기를 하지 않음
			// Set the active submenu dropdown toggle button initial state.
			container.find( '.current-menu-ancestor > button' )
				.addClass( 'toggled-on' )
				.attr( 'aria-expanded', 'true' )
				.find( '.screen-reader-text' )
				.text( twentyseventeenScreenReaderText.collapse );
			// Set the active submenu initial state.
			container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );
	*/
			container.find( '.dropdown-toggle' ).click( function( e ) {
				var _this = $( this ),
					screenReaderSpan = _this.find( '.screen-reader-text' );

				e.preventDefault();
				_this.toggleClass( 'toggled-on' );
				_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

				_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

				screenReaderSpan.text( screenReaderSpan.text() === twentyseventeenScreenReaderText.expand ? twentyseventeenScreenReaderText.collapse : twentyseventeenScreenReaderText.expand );
			});
		} // End of initMainNavigation()

		initMainNavigation( $( '.main-navigation' ) );

		masthead       = $( '#masthead' );
		menuToggle     = masthead.find( '.menu-toggle' );
		siteNavContain = masthead.find( '.main-navigation' );
		siteNavigation = masthead.find( '.main-navigation > div > ul' );

		// Enable menuToggle.
	/*	(function() {

			// Return early if menuToggle is missing.
			if ( ! menuToggle.length ) {
				return;
			}

			// Add an initial value for the attribute.
			menuToggle.attr( 'aria-expanded', 'false' );

			menuToggle.on( 'click.twentyseventeen', function() {
				siteNavContain.toggleClass( 'toggled-on' );

				$( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
			});
		})();
	*/
		// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
		(function() {
			if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
				return;
			}

			// Toggle `focus` class to allow submenu access on tablets.
			function toggleFocusClassTouchScreen() {
				if ( 'none' === $( '.bl-menu-toggle' ).css( 'display' ) ) {

					$( document.body ).on( 'touchstart.twentyseventeen', function( e ) {
						if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
							$( '.main-navigation li' ).removeClass( 'focus' );
						}
					});

					siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
						.on( 'touchstart.twentyseventeen', function( e ) {
							var el = $( this ).parent( 'li' );

							if ( ! el.hasClass( 'focus' ) ) {
								e.preventDefault();
								el.toggleClass( 'focus' );
								el.siblings( '.focus' ).removeClass( 'focus' );
							}
						});

				} else {
					siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.twentyseventeen' );
				}
			}

			if ( 'ontouchstart' in window ) {
				$( window ).on( 'resize.twentyseventeen', toggleFocusClassTouchScreen );
				toggleFocusClassTouchScreen();
			}

			siteNavigation.find( 'a' ).on( 'focus.twentyseventeen blur.twentyseventeen', function() {
				$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
			});
		})();


		///// bl
		/////
		var	$body = $( 'body' ),
			$blMenuToggle = $body.find( '#bl-menu-toggle' ),
			$navTop = $body.find( '.navigation-top' ),
			$mainNav = $navTop.find( '.main-navigation' ),
			$dropdowns = $mainNav.find( '.dropdown-toggle' ), // 모든 드롭다운 버튼(화살표)
			// $currentMenuParent = $mainNav.find( '.current-menu-parent' ),
			$linksMenuParents = $mainNav.find( '.menu-item-has-children > a:first-child' );

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
			$( 'body' ).click( function( e ) {
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
				if ( $mainNav.hasClass( 'toggled-on' ) && ! $navTop.is( ':animated' ) ) {
					var scrollTop = $( window ).scrollTop(),
						navHeight = $mainNav.height();

					if ( scrollTop >= ( navHeight - 100 ) ) {
						blToggleNavigation( true );
					}
				}
			});

			function blToggleNavigation( hide = false ) {
				if ( ! $navTop.is( ':animated' ) ) {
					// 메뉴 숨기기
					if ( $navTop.is( ':visible' ) || hide ) {
						$navTop.animate( { 'right' : '-100px', 'opacity' : '0' }, function() {
							$navTop.hide();
							blToggleNavCSS(); // 이걸 여기서 해야 애니메이션 중 메뉴가 사라짐을 방지
							$mainNav.find( '.dropdown-toggle.toggled-on' ).trigger( 'click' );
						} );
					// 메뉴 보이기
					} else {
						blToggleNavCSS(); // 이걸 먼저 해야 아래 애니메이션 중 메뉴가 보임
						$navTop.show().animate( { 'right' : '0', 'opacity' : '1' } );
					}
				}

				function blToggleNavCSS() {
					$mainNav.toggleClass( 'toggled-on' );
					$blMenuToggle.attr( 'aria-expanded', $mainNav.hasClass( 'toggled-on' ) ? 'true' : 'false' );
				}
			}
		} // End of blInitMenuToggleEvents()

		function blInitDropdowns() {
			// 기존 부모 테마의 클릭 이벤트 해제
			$dropdowns.unbind( 'click' );

			// 클릭 이벤트 재등록
			$dropdowns.click( function( e ) {
				var clickedDropdown = $( this ),
					droppedMenu = $mainNav.find( '.dropdown-toggle.toggled-on' );

				e.preventDefault();

				blToggleDropdownMenu( clickedDropdown );

				// 열려 있는 '다른' 서브메뉴(droppedMenu)는 닫음; jquery 객체끼리의 비교는 .get(0)
				if ( droppedMenu.get(0) !== clickedDropdown.get(0) ) {
					blToggleDropdownMenu( droppedMenu );
				}
			});

			// 메인메뉴 아이템 자체(<a>태그)를 눌러도 드롭다운 버튼과 같은 동작 설정
			$linksMenuParents.click( function( e ) {
				e.preventDefault();
				$( this ).next( '.dropdown-toggle' ).trigger( 'click' );
			});

			function blToggleDropdownMenu( ddToggleButton ) {
				var menuParent = ddToggleButton.parent( '.menu-item-has-children' ),
					menuChildren = ddToggleButton.next( '.sub-menu' );

				menuParent.toggleClass( 'toggled-on' );
				ddToggleButton.toggleClass( 'toggled-on' )
					.attr( 'aria-expanded', ddToggleButton.attr( 'aria-expanded' ) === 'true' ? 'false' : 'true' );

				menuChildren.slideToggle( 'fast', function() { // 슬라이드 동작이 끝난 후 토글상태 변경
					menuChildren.toggleClass( 'toggled-on' );
				});
			}
		} // End of blInitMenuToggleEvents()
		/////
		///// bl end

	}); // End of document.ready

})( jQuery );
