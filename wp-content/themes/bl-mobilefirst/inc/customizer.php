<?php
/**
 * Twenty Seventeen: Customizer
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since BL Mobile First 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blmobilefirst_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'blmobilefirst_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'blmobilefirst_customize_partial_blogdescription',
		)
	);

	/**
	 * Custom colors.
	 */
	$wp_customize->add_setting(
		'colorscheme',
		array(
			'default'           => 'light',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'blmobilefirst_sanitize_colorscheme',
		)
	);

	$wp_customize->add_setting(
		'colorscheme_hue',
		array(
			'default'           => 250,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint', // The hue is stored as a positive integer.
		)
	);

	$wp_customize->add_control(
		'colorscheme',
		array(
			'type'     => 'radio',
			'label'    => __( 'Color Scheme', 'blmobilefirst' ),
			'choices'  => array(
				'light'  => __( 'Light', 'blmobilefirst' ),
				'dark'   => __( 'Dark', 'blmobilefirst' ),
				'custom' => __( 'Custom', 'blmobilefirst' ),
			),
			'section'  => 'colors',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'colorscheme_hue',
			array(
				'mode'     => 'hue',
				'section'  => 'colors',
				'priority' => 6,
			)
		)
	);

	/**
	 * Theme options.
	 */
	$wp_customize->add_section(
		'theme_options',
		array(
			'title'    => __( 'Theme Options', 'blmobilefirst' ),
			'priority' => 130, // Before Additional CSS.
		)
	);

	$wp_customize->add_setting(
		'page_layout',
		array(
			'default'           => 'two-column',
			'sanitize_callback' => 'blmobilefirst_sanitize_page_layout',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'page_layout',
		array(
			'label'           => __( 'Page Layout', 'blmobilefirst' ),
			'section'         => 'theme_options',
			'type'            => 'radio',
			'description'     => __( 'When the two-column layout is assigned, the page title is in one column and content is in the other.', 'blmobilefirst' ),
			'choices'         => array(
				'one-column' => __( 'One Column', 'blmobilefirst' ),
				'two-column' => __( 'Two Column', 'blmobilefirst' ),
			),
			'active_callback' => 'blmobilefirst_is_view_with_layout_option',
		)
	);

	/**
	 * Filter number of front page sections in Twenty Seventeen.
	 *
	 * @since BL Mobile First 1.0
	 *
	 * @param int $num_sections Number of front page sections.
	 */
	$num_sections = apply_filters( 'blmobilefirst_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting(
			'panel_' . $i,
			array(
				'default'           => false,
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'panel_' . $i,
			array(
				/* translators: %d: The front page section number. */
				'label'           => sprintf( __( 'Front Page Section %d Content', 'blmobilefirst' ), $i ),
				'description'     => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'blmobilefirst' ) ),
				'section'         => 'theme_options',
				'type'            => 'dropdown-pages',
				'allow_addition'  => true,
				'active_callback' => 'blmobilefirst_is_static_front_page',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'panel_' . $i,
			array(
				'selector'            => '#panel' . $i,
				'render_callback'     => 'blmobilefirst_front_page_section',
				'container_inclusive' => true,
			)
		);
	}

// bl added /////////////////////////////////////////////////////////////////////

	// 새 섹션 만들기
	$wp_customize->add_section( 'blmobilefirst_theme_options', array(
			'title'    => __( 'Bridge Light Options', 'blmobilefirst' ),
			'priority' => 0,
		)
	);

	// 계절별, 이벤트별로 다른 사이트 모습을 선택
	$wp_customize->add_setting( 'blmobilefirst_seasonlook', array(
			'default'           => 'excellence',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'blmobilefirst_sanitize_blmobilefirst_seasonlook',
		)
	);
	$wp_customize->add_control( 'blmobilefirst_seasonlook', array(
			'type'     => 'radio',
			'label'    => __( 'Seasonal Look', 'blmobilefirst' ),
			'choices'  => array(
				'excellence' => __( 'Excellence', 'blmobilefirst' ),
				'spring'     => __( 'Spring', 'blmobilefirst' ),
				'winter'     => __( 'Winter', 'blmobilefirst' ),
				'halloween'  => __( 'Halloween', 'blmobilefirst'),
			),
			'section'  => 'blmobilefirst_theme_options',
			'priority' => 1,
		)
	);

	// 화면 우상단의 네비게이션 메뉴를 열고 닫는 버튼 이미지. 계절별, 이벤트별 사이트 모습에 따라 선택
	/*$wp_customize->add_setting( 'blmobilefirst_menu_button_img', array(
		'default'   => get_stylesheet_directory_uri().'/assets/images/menu-button-default.png',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'blmobilefirst_menu_button_img',
			array(
				'label'    => __( 'Menu Button Image', 'blmobilefirst' ),
				'section'  => 'blmobilefirst_theme_options',
				'settings' => 'blmobilefirst_menu_button_img',
				'priority' => '10',
			)
		)
	);*/

	// Hero Text: 첫 화면에 표시되는 큰 글자 텍스트
	/*$wp_customize->add_setting( 'blmobilefirst_herotext', array(
		'default'   => 'In Pursuit of Excellence<br>in English Education',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( 'blmobilefirst_herotext', array(
		'label'    => __( 'Hero Text', 'blmobilefirst' ),
		'section'  => 'blmobilefirst_theme_options',
		'type'     => 'text',
		'priority' => 2,
	) );
	$wp_customize->selective_refresh->add_partial( 'blmobilefirst_herotext', array(
		'selector'        => '#bl-hero-text',
		'render_callback' => 'blmobilefirst_customize_partial_blmobilefirst_herotext',
	) );*/
}
add_action( 'customize_register', 'blmobilefirst_customize_register' );

/**
 * Sanitize the page layout options.
 *
 * @param string $input Page layout.
 */
function blmobilefirst_sanitize_page_layout( $input ) {
	$valid = array(
		'one-column' => __( 'One Column', 'blmobilefirst' ),
		'two-column' => __( 'Two Column', 'blmobilefirst' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}

	return '';
}

/**
 * Sanitize the colorscheme.
 *
 * @param string $input Color scheme.
 */
function blmobilefirst_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since BL Mobile First 1.0
 * @see blmobilefirst_customize_register()
 *
 * @return void
 */
function blmobilefirst_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since BL Mobile First 1.0
 * @see blmobilefirst_customize_register()
 *
 * @return void
 */
function blmobilefirst_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function blmobilefirst_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function blmobilefirst_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function blmobilefirst_customize_preview_js() {
	wp_enqueue_script( 'blmobilefirst-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '20161002', true );
}
add_action( 'customize_preview_init', 'blmobilefirst_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function blmobilefirst_panels_js() {
	wp_enqueue_script( 'blmobilefirst-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '20161020', true );
}
add_action( 'customize_controls_enqueue_scripts', 'blmobilefirst_panels_js' );
