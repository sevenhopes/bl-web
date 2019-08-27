<?php
/**
 * 본 테마의 모든 PHP 함수와 그 정의
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 */

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

/**
 * Enqueue styles of the parent theme and the child theme
 */
function bridgelight_theme_enqueue_scripts() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css', array( 'parent-style' ), wp_get_theme()->get('Version') );
	wp_enqueue_style( 'fonts-noto-sans', bridgelight_fonts_url_noto_sans(), array(), null );
	wp_enqueue_script( 'concatenated-js', get_stylesheet_directory_uri().'/assets/js/bl.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'kakaolink', 'https://developers.kakao.com/sdk/js/kakao.min.js', array(), null );
}
add_action( 'wp_enqueue_scripts', 'bridgelight_theme_enqueue_scripts' );

/**
 * Register custom fonts.
 */
function bridgelight_fonts_url_noto_sans() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Noto Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$noto_sans = _x( 'on', 'Noto Sans Korean font: on or off', '2017-child' );

	if ( 'off' !== $noto_sans ) {
		$font_families = array();
		// 100: Thin / 300: Light / 400: Regular / 500: Medium / 700: Bold / 900: Black
		$font_families[] = 'Noto Sans:100,300,400,500,700,900';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'KR' ),
		);

		$fonts_url = add_query_arg( $query_args, 'fonts.googleapis.com/earlyaccess/notosanskr.css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * 2017 Child: Customizer
 *
 * 관리자 화면의 '테마 - 사용자 정의하기'에서 변경 가능한 부분을 정의한다.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bridgelight_customize_register( $wp_customize ) {

	// 새 섹션 만들기
	$wp_customize->add_section( 'bl_theme_options', array(
			'title'    => __( 'Bridge Light Options', '2017-child' ),
			'priority' => 0,
		)
	);

	// 계절별, 이벤트별로 다른 사이트 모습을 선택
	$wp_customize->add_setting( 'bl_seasonlook', array(
			'default'           => 'excellence',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'bridgelight_sanitize_bl_seasonlook',
		)
	);
	$wp_customize->add_control( 'bl_seasonlook', array(
			'type'     => 'radio',
			'label'    => __( 'Seasonal Look', '2017-child' ),
			'choices'  => array(
				'excellence' => __( 'Excellence', '2017-child' ),
				'spring'     => __( 'Spring', '2017-child' ),
				'winter'     => __( 'Winter', '2017-child' ),
				'halloween'  => __( 'Halloween', '2017-child'),
			),
			'section'  => 'bl_theme_options',
			'priority' => 1,
		)
	);

	// 화면 우상단의 네비게이션 메뉴를 열고 닫는 버튼 이미지. 계절별, 이벤트별 사이트 모습에 따라 선택
	$wp_customize->add_setting( 'bl_menu_button_img', array(
		'default'   => get_stylesheet_directory_uri().'/assets/images/menu-button-default.png',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'bl_menu_button_img',
			array(
				'label'    => __( 'Menu Button Image', '2017-child' ),
				'section'  => 'bl_theme_options',
				'settings' => 'bl_menu_button_img',
				'priority' => '10',
			)
		)
	);

	// Hero Text: 첫 화면에 표시되는 큰 글자 텍스트
	$wp_customize->add_setting( 'bl_herotext', array(
		'default'   => 'In Pursuit of Excellence<br>in English Education',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( 'bl_herotext', array(
		'label'    => __( 'Hero Text', '2017-child' ),
		'section'  => 'bl_theme_options',
		'type'     => 'text',
		'priority' => 2,
	) );
	$wp_customize->selective_refresh->add_partial( 'bl_herotext', array(
		'selector'        => '#bl-hero-text',
		'render_callback' => 'bridgelight_customize_partial_bl_herotext',
	) );
}
add_action( 'customize_register', 'bridgelight_customize_register' );

/**
 * 커스텀 프리뷰 창에 Hero Text의 바로가기 화살표를 그린다.
 *
 * @return void
 */
function bridgelight_customize_partial_bl_herotext() {
	echo get_theme_mod( 'bl_herotext' );
}

/**
 * seasonlook을 sanitize 한다.
 *
 * @return string $input name of the seasonal look, else 'excellence'
 */
function bridgelight_sanitize_bl_seasonlook( $input ) {
	$valid = array( 'excellence', 'spring', 'winter', 'halloween' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'excellence';
}

/**
 * WordPress Body Class CSS for a Variety of Devices
 * https://clicknathan.com/web-design/wordpress-body-class-css-for-a-variety-of-devices/
 */
// add conditional statements for mobile devices
function is_ipad() {
	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' );
}
function is_iphone() {
	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'iPhone' );
}
function is_ipod() {
	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'iPod' );
}
function is_ios() {
	return is_iphone() || is_ipad() || is_ipod();
}
function is_android() { // detect ALL android devices
	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' );
}
function is_android_mobile() { // detect ALL android devices
	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' )
		&& (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'Mobile' );
}
function is_android_tablet() { // detect android tablets
	return is_android() && !is_android_mobile();
}
// function is_mobile_device() { // detect ALL mobile devices
// 	return is_android_mobile() || is_iphone() || is_ipod();
// }
function is_tablet() { // detect ALL tablets
	return ( is_android() && !is_android_mobile() ) || is_ipad();
}
function is_kor_mutant() { // 국내의 돌연변이 브라우저들 인식하기
	return (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'Whale' )
		|| (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'NAVER' ) // Naver 앱 인식
		|| (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'DaumApps' ) // Daum 앱 인식
		|| (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'SamsungBrowser' ); // 삼성인터넷 앱 인식
}

// add browser name to body class
add_filter( 'body_class', 'browser_body_class' );
function browser_body_class( $classes ) {
	global $is_gecko, $is_IE, $is_opera, $is_safari, $is_chrome, $is_iphone, $is_edge;

	if ( wp_is_mobile() ) {
		if ( is_kor_mutant() )  $classes[] = 'browser-kor-mutant';
		elseif ( is_android() ) $classes[] = 'browser-android';
		elseif ( is_iphone() )  $classes[] = 'browser-iphone';
		elseif ( is_ipad() )    $classes[] = 'browser-ipad';
		elseif ( is_ipod() )    $classes[] = 'browser-ipod';
		elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false ) $classes[] = 'browser-kindle';
		elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false ) $classes[] = 'browser-blackberry';
		elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false ) $classes[] = 'browser-opera-mini';
		elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' ) !== false ) $classes[] = 'browser-opera-mobi';
		if ( is_tablet() )  $classes[] = 'device-tablet';
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
	elseif ( is_android() ) $classes[] = 'os-android';
	elseif ( is_ios() )     $classes[] = 'os-ios';
	elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Macintosh' ) !== false ) $classes[] = 'os-mac';
	elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Linux' ) !== false )     $classes[] = 'os-linux';
	elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false )    $classes[] = 'os-kindle';
	elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false ) $classes[] = 'os-blackberry';
	else $classes[] = 'os-unknown';

	return $classes;
}
?>
