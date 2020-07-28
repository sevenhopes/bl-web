<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since BL Mobile First 1.0
 */

/**
 * WordPress Body Class CSS for a Variety of Devices
 * https://clicknathan.com/web-design/wordpress-body-class-css-for-a-variety-of-devices/
 */
// add conditional statements for mobile devices
function blmobilefirst_is_ipad() {
	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' );
}
// function blmobilefirst_is_iphone() {
// 	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'iPhone' );
// }
// function blmobilefirst_is_ipod() {
// 	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'iPod' );
// }
// function blmobilefirst_is_ios() {
// 	return blmobilefirst_is_iphone() || blmobilefirst_is_ipad() || blmobilefirst_is_ipod();
// }
function blmobilefirst_is_android() { // detect ALL android devices
	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' );
}
function blmobilefirst_is_android_mobile() { // detect ALL android devices
	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' )
		&& (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'Mobile' );
}
// function blmobilefirst_is_android_tablet() { // detect android tablets
// 	return blmobilefirst_is_android() && !blmobilefirst_is_android_mobile();
// }
// function blmobilefirst_is_mobile_device() { // detect ALL mobile devices
// 	return blmobilefirst_is_android_mobile() || blmobilefirst_is_iphone() || blmobilefirst_is_ipod();
// }
function blmobilefirst_is_tablet() { // detect ALL tablets
	return ( blmobilefirst_is_android() && !blmobilefirst_is_android_mobile() ) || blmobilefirst_is_ipad();
}
// function blmobilefirst_is_kor_mutant() { // 국내의 돌연변이 브라우저들 인식하기
// 	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'NAVER' ) // Naver 앱 인식
// 		|| (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'SamsungBrowser' ) // 삼성인터넷 앱 인식
// 		|| (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'DaumApps' ) // Daum 앱 인식
// 		|| (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'Whale' );
// }
/*
// add browser name & os type to body class
add_filter( 'body_class', 'browser_body_class' );
function browser_body_class( $classes ) {
	global $is_gecko, $is_IE, $is_opera, $is_safari, $is_chrome, $blmobilefirst_is_iphone, $is_edge;

	if ( wp_is_mobile() ) {
		if ( blmobilefirst_is_kor_mutant() )  $classes[] = 'browser-kor-mutant';
		elseif ( blmobilefirst_is_android() ) $classes[] = 'browser-android';
		elseif ( blmobilefirst_is_iphone() )  $classes[] = 'browser-iphone';
		elseif ( blmobilefirst_is_ipad() )    $classes[] = 'browser-ipad';
		elseif ( blmobilefirst_is_ipod() )    $classes[] = 'browser-ipod';
		elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false ) $classes[] = 'browser-kindle';
		elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false ) $classes[] = 'browser-blackberry';
		elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false ) $classes[] = 'browser-opera-mini';
		elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' ) !== false ) $classes[] = 'browser-opera-mobi';
		if ( blmobilefirst_is_tablet() )  $classes[] = 'device-tablet';
	} else {
		if ( $is_gecko )      $classes[] = 'browser-gecko'; // Firefox
		elseif ( $is_opera )  $classes[] = 'browser-opera';
		elseif ( $is_safari ) $classes[] = 'browser-safari';
		elseif ( $is_chrome ) $classes[] = 'browser-chrome';
		elseif ( $is_edge )   $classes[] = 'browser-edge';
				elseif ( $is_IE) {
						$classes[] = 'browser-ie';
						if ( preg_match( '/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'] , $browser_version ) )
							$classes[] = 'ie-version-'.$browser_version[1];
				}
				else $classes[] = 'browser-unknown';
		$classes[] = 'device-immobile';
	}

	if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Windows' ) !== false ) $classes[] = 'os-windows';
	elseif ( blmobilefirst_is_android() ) $classes[] = 'os-android';
	elseif ( blmobilefirst_is_ios() )     $classes[] = 'os-ios';
	elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Macintosh' ) !== false ) $classes[] = 'os-mac';
	elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Linux' ) !== false )     $classes[] = 'os-linux';
	elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false )    $classes[] = 'os-kindle';
	elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false ) $classes[] = 'os-blackberry';
	else $classes[] = 'os-unknown';

	return $classes;
}
*/
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blmobilefirst_body_classes( $classes ) {
	global $is_IE, $GLOBALS;

	// screen-medium = 태블릿 화면, screen-small = 폰화면, screen-large = 데스크탑 화면
	if ( wp_is_mobile() ) {
		if ( blmobilefirst_is_tablet() ) {
			$classes[] = 'screen-medium';
		} else {
			$classes[] = 'screen-small';
		}
	} else {
		$classes[] = 'screen-large';

		if ( $is_IE ) {
			$classes[] = 'browser-ie';
		}
	}

	if ( function_exists( 'pll_current_language' ) ) {
		$GLOBALS['pll_lang'] = 'pll_'.pll_current_language();
	}
	$classes[] = $GLOBALS['pll_lang'];

	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'blmobilefirst-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'blmobilefirst-front-page';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$classes[] = 'has-sidebar';
	}

	// Add class for one or two column page layouts.
	if ( is_page() || is_archive() ) {
		if ( 'one-column' === get_theme_mod( 'page_layout' ) ) {
			$classes[] = 'page-one-column';
		} else {
			$classes[] = 'page-two-column';
		}
	}

	// Add class if the site title and tagline is hidden.
	if ( 'blank' === get_header_textcolor() ) {
		$classes[] = 'title-tagline-hidden';
	}

	// Get the colorscheme or the default if there isn't one.
	$colors    = blmobilefirst_sanitize_colorscheme( get_theme_mod( 'colorscheme', 'light' ) );
	$classes[] = 'colors-' . $colors;

	return $classes;
}
add_filter( 'body_class', 'blmobilefirst_body_classes' );

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function blmobilefirst_panel_count() {

	$panel_count = 0;

	/**
	 * Filter number of front page sections in BL Mobile First.
	 *
	 * @since BL Mobile First 1.0
	 *
	 * @param int $num_sections Number of front page sections.
	 */
	$num_sections = apply_filters( 'blmobilefirst_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		if ( get_theme_mod( 'panel_' . $i ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}

/**
 * Checks to see if we're on the front page or not.
 */
function blmobilefirst_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}
