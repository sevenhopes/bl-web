/* global blmobilefirstScreenReaderText */
/**
 * 내비게이션 메뉴의 핸들러 자바스크립트 (jQuery)
 *
 * Version: 1.8.1
 */

(function( $ ) {

	// *
	// * Warning!! uglify(minify) 할 때 조심! 카카오링크 관련, 런타임 때 에러나는 경우가 있음!
	// *
	$.blang = {}; // bl + lang
	$.blang.ko = {
		address: "강원도 춘천시 스포츠타운길 534 (온의동)",
		linkdesc: "033-243-5757 #영어생활화 #매일수업 #방학영어캠프 #미국연수 #초중영어",
		pageurlmsg: "이제 현재 페이지 주소를 붙여넣기 할 수 있습니다.",
		siteurlmsg: "이제 웹사이트 주소를 붙여넣기 할 수 있습니다."
	};
	$.blang.en = {
		address: "534, Sports town-gil, Chuncheon-si, Gangwon-do, Republic of Korea",
		linkdesc: "033-243-5757 #DailyEnglishClass #EnglishStudyCamp #MonthLongUSAStudy",
		pageurlmsg: "Now you can paste the current page's URL.",
		siteurlmsg: "Now you can paste the website's URL."
	};

	var scrolling = false,
		current_top = 0,
		scroll_interval = 350,
		is_widescreen = ( $( '#content' ).width() == 860 );	// 960 - (padding-left 50 + padding-right 50)

	// document.ready() 밖으로 꺼내면 .dropdown-toggle을 선택하지 못 함.
	// $( document ).ready( function() {

		var masthead, menuToggle, siteNavContain, siteNavigation;

		function initMainNavigation( container ) {

			// Add dropdown toggle that displays child menu items.
			var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
				.append( blmobilefirstScreenReaderText.icon );

			container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

			// 아래 두 조각의 코드: 현재 페이지에 해당하는 드롭다운 메뉴(서브 메뉴)를 미리 펼치고 표시함
			// Set the active submenu dropdown toggle button initial state.
			container.find( '.current-menu-ancestor > button' )
				.addClass( 'toggled-on' )
				.attr( 'aria-expanded', 'true' );
			// Set the active submenu initial state.
			container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );
			// 현재 페이지의 드롭다운 메뉴가 속한 상위 메뉴 스타일
			container.find( '.current-menu-ancestor' ).toggleClass( 'toggled-on' );
	
			container.find( '.dropdown-toggle' ).click( function( e ) {
				var _this = $( this ),
					screenReaderSpan = _this.find( '.screen-reader-text' );

				e.preventDefault();
				_this.toggleClass( 'toggled-on' );
				_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

				_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			});
		} // End of initMainNavigation()

		initMainNavigation( $( '.main-navigation' ) );

		masthead       = $( '#masthead' );
		menuToggle     = masthead.find( '.menu-toggle' );
		siteNavContain = masthead.find( '.main-navigation' );
		siteNavigation = masthead.find( '.main-navigation > div > ul' );

		///// bl //////////////////////////////////////////////////////////////////
		/////
		var	$body = $( 'body' ),
			$blMenuToggle = $body.find( '#bl-menu-toggle' ),
			$navTop = $body.find( '.navigation-top' ),
			$mainNav = $navTop.find( '.main-navigation' ),
			$dropdowns = $mainNav.find( '.dropdown-toggle' ), // 모든 드롭다운 버튼(화살표)
			$sharelayer = $( '.bl-share-layer' ),
			isFrontPage = $body.hasClass( 'home' ),
			langset = $body.hasClass( 'ko-KR' ) ? $.blang.ko : $.blang.en,
			site_name = document.head.querySelector('meta[property="og:site_name"]').getAttribute('content'),
			og_image = document.head.querySelector('meta[property="og:image"]').getAttribute('content');

		// console.log( 'langset.address: ' + langset.address );
		// console.log( 'typeof langset.address: ' + typeof langset.address );
		// console.log( '$.blang.ko.address: ' + $.blang.ko.address );
		// console.log( 'typeof $.blang.ko.address: ' + typeof $.blang.ko.address );

		if ( is_widescreen ) {
			blInitWideNavigation();
			return;	// document.ready() 탈출. blInitMenuToggleEvents()와 blInitDropdowns()을 호출하지 않음.
		}

		blInitMenuToggleEvents();
		blInitDropdowns();

		function blInitWideNavigation() {
			var cursor_over = false;
			$body.find( '.nav-drawer > ul' ).on( 'mouseenter', function() {
				// console.log( 'mouseenter' );
				if ( ! cursor_over ) {
					blShowWideNav();
					cursor_over = true;
				}
			});
			$body.find( '.navigation-top' ).on( 'mouseleave', function() {
				// console.log( 'mouseleave' );
				if ( cursor_over ) {
					blHideWideNav();
					cursor_over = false;
				}
			});

			// 내비게이션 숨김/보임 (넓은 화면)
			function blHideWideNav() {
				var $navTop = $body.find( '.navigation-top' );
				$navTop.fadeOut( 200 );
			}
			function blShowWideNav() {
				var $navTop = $body.find( '.navigation-top' );
				$navTop.fadeIn( 200 );
			}
		}

		function blInitMenuToggleEvents() {

			// 메뉴 펼침/숨김 상태 숨김으로 초기화.
			$blMenuToggle.attr( 'aria-expanded', 'false' );

			// 네비게이션 메뉴가 보이는 상태에서 다른 곳을 터치하면 (포커스를 옮기면) 메뉴를 숨김
			$body.click( function( e ) {
				if ( 'true' === $blMenuToggle.attr( 'aria-expanded' ) ) {
					blHideNav();
				}
			} );

			// 네비게이션 메뉴를 보여주거나 숨기는 버튼의 동작 (드롭다운 버튼 아님, 전체 메뉴의 버튼)
			$blMenuToggle.click( function( e ) {
				e.stopPropagation();
				blToggleNav();
			} );

			$navTop.click( function( e ) {
				e.stopPropagation();
			} );

			// 네비게이션 메뉴가 보이는 상태에서 스크롤다운을 많이 하면 메뉴를 숨김
			$( window ).on( 'scroll', function() {
				scrolling = true;
				// current_top = $( window ).scrollTop();

				// blHideNav();
			});

			setInterval( function() {
				if ( scrolling ) {
					// if ( Math.abs( current_top - $( window ).scrollTop() ) > 10 ) {
						blHideNav();
					// }
					scrolling = false;
				}
			}, scroll_interval );

			function blToggleNav() {
				if ( $navTop.is( ':visible' ) ) {
					blHideNav();
				} else {
					blShowNav();
				}
			}

			function blHideNav() {
				if ( $navTop.is( ':animated' ) || ! $navTop.is( ':visible' ) ) {
					return;
				}
				$blMenuToggle.toggleClass( 'toggled' );
				$navTop.animate( { 'right' : '-100px', 'opacity' : '0' }, 300, function() {
					$navTop.hide();
					blToggleNavCSS(); // 이걸 여기서 해야 애니메이션 중 메뉴가 사라짐을 방지
				} );
			}

			function blShowNav() {
				if ( $navTop.is( ':animated') || $navTop.is( ':visible' ) ) {
					return;
				}
				$blMenuToggle.toggleClass( 'toggled' );
				blToggleNavCSS(); // 이걸 먼저 해야 아래 애니메이션 중 메뉴가 보임
				$navTop.show().animate( { 'right' : '0', 'opacity' : '1' }, 300 );
			}

			function blToggleNavCSS() {
				$mainNav.toggleClass( 'toggled-on' );
				$blMenuToggle.attr( 'aria-expanded', $mainNav.hasClass( 'toggled-on' ) ? 'true' : 'false' );
			}
		} // End of blInitMenuToggleEvents()

		function blInitDropdowns() {
			// 기존 부모 테마의 클릭 이벤트 해제
			// $dropdowns.unbind( 'click' );

			// .main-navigation 메뉴의 마지막에 커스텀 메뉴를 추가 (메인페이지는 제외)
			$mainNav.find( '#top-menu' ).html( function() {
				var $allmenubtn = ' <li id="menu-item-99999" class="bl-custom-menu menu-item menu-item-type-post_type menu-item-object-page"><div><a class="bl-custom-call" href="tel:033-243-5757"><i class="bl-sp icw-call" title="전화상담&예약"></i></a></div><div><a href="/admission/appt-and-visit/"><i class="bl-sp icw-map" title="위치안내"></i></a></div><div><a class="bl-custom-share" href=""><i class="bl-sp icw-share" title="정보공유"></i></a></div></li>';
				var $shareonly =  ' <li id="menu-item-99999" class="bl-custom-menu menu-item menu-item-type-post_type menu-item-object-page"><div><a class="bl-custom-call disabled" href="tel:033-243-5757"><i class="bl-sp icw-call" title="전화상담&예약"></i></a></div><div><a class="disabled" href="/admission/appt-and-visit/"><i class="bl-sp icw-map" title="위치안내"></i></a></div><div><a class="bl-custom-share" href=""><i class="bl-sp icw-share" title="정보공유"></i></a></div></li>';
				return $( this ).html() + ( isFrontPage ? $shareonly : $allmenubtn );
			});

			// 전화하기 커스텀 메뉴 동작: 네비 메뉴 메뉴 닫음
			$mainNav.find( '.bl-custom-call' ).click( function( e ) {
				$blMenuToggle.trigger( 'click' );
			});

			// 공유하기 커스텀 메뉴 동작: 공유하기 레이어 보임
			$mainNav.find( '.bl-custom-share' ).click( function( e ) {
				e.preventDefault();
				$body.addClass( 'no-scroll' );
				$sharelayer.css( 'top', $( window ).scrollTop() );
				$blMenuToggle.trigger( 'click' );
				$sharelayer.fadeIn( 'fast' );
			});
			// 공유하기 레이어에서 (modal 상자 밖의) 아무 영역이나 누르면 닫기
			$sharelayer.click( function( e ) {
				e.stopPropagation();
				$( '.bl-share-layer' ).fadeOut( 'fast' );
				$body.removeClass( 'no-scroll' );
			});
			// 공유하기 레이어 내에 modal 상자를 클릭했을 때 클릭이벤트가 뒷면 페이지에 발생하는 걸 방지
			$sharelayer.find( '.bl-share-box' ).click( function( e ) {
				e.stopPropagation();
			});
			// 공유하기 레이어 닫기 아이콘
			$sharelayer.find( '#bl-close-sharelayer' ).click( function( e ) {
				e.preventDefault();
				e.stopPropagation();
				$sharelayer.trigger( 'click' );
			});
			// 카카오톡 공유
			Kakao.init('402e01df01114b3ef841e557210bc62f');
			// 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
			Kakao.Link.createDefaultButton({
				container: '#bl-share-kakao',
				objectType: 'location',
				address: langset.address,
				addressTitle: site_name,
				content: {
					title: document.title,
					description: langset.linkdesc,
					imageUrl: og_image,
					link: {
						mobileWebUrl: window.location.href,
						webUrl: window.location.href
					}
				},
				// social: {
				//   likeCount: 286,
				//   commentCount: 45,
				//   sharedCount: 845
				// },
				buttons: [
				{
					title: '웹으로 보기',
					link: {
						mobileWebUrl: window.location.href,
						webUrl: window.location.href
					}
				}
				]
			});
			// 페이스북 공유
			$sharelayer.find( '#bl-share-facebook' ).click( function( e ) {
				e.stopPropagation();
				$sharelayer.trigger( 'click' );
				// FB.init({
				// 	appId: '462886344532595'
				// });
				// FB.ui({
				// 	method: 'share_open_graph',
				// 	action_type: 'og.shares',
				// 	action_properties: JSON.stringify({
				// 		object: window.location.href,
				// 	})
				// }, function( response ){});
			});
			// 현재 페이지 주소 복사
			$sharelayer.find( '#bl-copy-page-url' ).click( function( e ) {
				e.preventDefault();
				e.stopPropagation();
				copyPageURL();
				alert( langset.pageurlmsg );
				$sharelayer.trigger( 'click' );
			});
			// 메인 페이지 주소 복사
			$sharelayer.find( '#bl-copy-home-url' ).click( function( e ) {
				e.preventDefault();
				e.stopPropagation();
				copyHomeURL();
				alert( langset.siteurlmsg );
				$sharelayer.trigger( 'click' );
			});
			// 현재 페이지의 주소 복사
			// https://stackoverflow.com/questions/22581345/click-button-copy-to-clipboard-using-jquery
			//
			function copyPageURL() {
				var $temp = $( '<input>' );
				$( 'body' ).append( $temp );
				$temp.val( window.location.href ).select();
				document.execCommand( 'copy' );
				$temp.remove();
			}
			// 메인 페이지(첫화면)의 주소 복사
			function copyHomeURL() {
				var $temp = $( '<input>' );
				$( 'body' ).append( $temp );
				$temp.val( window.location.origin + '/m/' ).select();
				document.execCommand( 'copy' );
				$temp.remove();
			}

			// PC 등 넓은화면인 경우, 부모 메뉴의 하이퍼링크를 비활성 하지 않고 유지함.
			if ( is_widescreen ) {
				return;
			}

			// (모바일) 클릭 이벤트 재등록
			// 위의 $mainNav.html() 함수가 기존 자식 오브젝트에 대한 모든 jquery 변수나 이벤트 핸들러를 무효화하기에
			// 여기서 무효화된 $dropdowns 변수 대신 새 오브젝트를 다시 find함
			$mainNav.find( '.dropdown-toggle' ).click( function( e ) {
				var clickedDropdown = $( this ),
					droppedMenu = $mainNav.find( '.dropdown-toggle.toggled-on' );

				e.preventDefault();

				blToggleDropdownMenu( clickedDropdown );

				// 열려 있는 '다른' 서브메뉴(droppedMenu)는 닫음; jquery 객체끼리의 비교는 .get(0)
				if ( droppedMenu.get(0) !== clickedDropdown.get(0) ) {
					blToggleDropdownMenu( droppedMenu );
				}
			});

			// (모바일) 메인메뉴 아이템 자체(<a>태그)를 눌러도 드롭다운 버튼과 같은 동작 설정
			$mainNav.find( '.menu-item-has-children > a:first-child' ).click( function( e ) {
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
		} // End of blInitDropdowns()
		/////
		///// bl end //////////////////////////////////////////////////////////////////

	// }); // End of document.ready

})( jQuery );
