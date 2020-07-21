<?php
/**
 * 본 테마의 모든 PHP 함수와 그 정의
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.3.1
 */

// 4.7 미만 버전에 테마 적용하려면 알림
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

function blmobilefirst_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/blmobilefirst
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'blmobilefirst' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blmobilefirst' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );


	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'blmobilefirst-featured-image', 2000, 1200, true );
	add_image_size( 'blmobilefirst-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 860;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'blmobilefirst' ),
			'social' => __( 'Social Links Menu', 'blmobilefirst' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://wordpress.org/support/article/post-formats/
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	  */
	add_editor_style( array( 'assets/css/editor-style.css', blmobilefirst_fonts_url() ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets'     => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'       => array(
			'home',
			'about'            => array(
				'thumbnail' => '{{image-shelf}}',
			),
			'contact'          => array(
				'thumbnail' => '{{image-bridgelight}}',
			),
			'blog'             => array(
				'thumbnail' => '{{image-lobby}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-bridgelight}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-bridgelight' => array(
				'post_title' => _x( 'Bridge Light', 'Theme starter content', 'blmobilefirst' ),
				'file'       => 'assets/images/legacy/bridgelight.jpg', // URL relative to the template directory.
			),
			'image-shelf' => array(
				'post_title' => _x( 'Shelf', 'Theme starter content', 'blmobilefirst' ),
				'file'       => 'assets/images/legacy/shelf.jpg',
			),
			'image-lobby'   => array(
				'post_title' => _x( 'Lobby', 'Theme starter content', 'blmobilefirst' ),
				'file'       => 'assets/images/legacy/lobby.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods'  => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'   => array(
			// Assign a menu to the "top" location.
			'top'    => array(
				'name'  => __( 'Top Menu', 'blmobilefirst' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name'  => __( 'Social Links Menu', 'blmobilefirst' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters BL Mobile First array of starter content.
	 *
	 * @since BL Mobile First 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'blmobilefirst_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'blmobilefirst_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blmobilefirst_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( blmobilefirst_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter BL Mobile First content width of the theme.
	 *
	 * @since BL Mobile First 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'blmobilefirst_content_width', $content_width );
}
add_action( 'template_redirect', 'blmobilefirst_content_width', 0 );

/**
 * Register custom fonts.
 */
function blmobilefirst_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Noto Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$noto_sans = _x( 'on', 'Noto Sans Korean font: on or off', 'blmobilefirst' );

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
 * Add preconnect for Google Fonts.
 *
 * @since BL Mobile First 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function blmobilefirst_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'blmobilefirst-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'blmobilefirst_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blmobilefirst_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'blmobilefirst' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'blmobilefirst' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'blmobilefirst' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'blmobilefirst' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'blmobilefirst' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'blmobilefirst' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'blmobilefirst_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since BL Mobile First 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function blmobilefirst_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Post title. */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blmobilefirst' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'blmobilefirst_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since BL Mobile First 1.0
 */
function blmobilefirst_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'blmobilefirst_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function blmobilefirst_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'blmobilefirst_pingback_header' );

/**
 * Display custom color CSS.
 */
function blmobilefirst_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$customize_preview_data_hue = '';
	if ( is_customize_preview() ) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
	?>
	<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
		<?php echo blmobilefirst_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'blmobilefirst_colors_css_wrap' );

/**
 * Enqueues scripts and styles.
 */
function blmobilefirst_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'blmobilefirst-fonts', blmobilefirst_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'blmobilefirst-style', get_stylesheet_uri(), array(), '20200714' );

	// Theme block stylesheet.
	wp_enqueue_style( 'blmobilefirst-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'blmobilefirst-style' ), '20200714' );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'blmobilefirst-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'blmobilefirst-style' ), '20200714' );
	}

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '20200714' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'blmobilefirst-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '20200714', true );

	$blmobilefirst_l10n = array(
		'quote' => blmobilefirst_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'blmobilefirst-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '20200715', true );
		$blmobilefirst_l10n['expand']   = __( 'Expand child menu', 'blmobilefirst' );
		$blmobilefirst_l10n['collapse'] = __( 'Collapse child menu', 'blmobilefirst' );
		$blmobilefirst_l10n['icon']     = blmobilefirst_get_svg(
			array(
				'icon'     => 'angle-down',
				'fallback' => true,
			)
		);
	}

	wp_enqueue_script( 'blmobilefirst-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '20190121', true );

	wp_enqueue_script( 'minified-js', get_stylesheet_directory_uri().'/assets/js/bl.min.js', array( 'jquery' ), '1.1', true );

	wp_enqueue_script( 'kakaolink', 'https://developers.kakao.com/sdk/js/kakao.min.js', array(), null );

	// wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	// Though localization is the primary use, it can be used to make any data available to your script that you can normally only get from the server side of WordPress.
	// https://developer.wordpress.org/reference/functions/wp_localize_script/
	// 아래 함수는 지역화가 첫번째 쓰임이지만, 또한 (다른 쓰임도 있는데) 보통 워드프레스의 서버측으로부터만 얻을 수 있는 데이타에 개발자의 자바스크립트가 접근이 가능하도록 한다.
	// 간단히 PHP에서 Javascript로 데이터를 전달할 수 있음.
	wp_localize_script( 'blmobilefirst-skip-link-focus-fix', 'blmobilefirstScreenReaderText', $blmobilefirst_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blmobilefirst_scripts' );

/**
 * Enqueues styles for the block-based editor.
 *
 * @since BL Mobile First 1.8
 */
function blmobilefirst_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'blmobilefirst-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ), array(), '20200714' );
	// Add custom fonts.
	wp_enqueue_style( 'blmobilefirst-fonts', blmobilefirst_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'blmobilefirst_block_editor_styles' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since BL Mobile First 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function blmobilefirst_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'blmobilefirst_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since BL Mobile First 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function blmobilefirst_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'blmobilefirst_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since BL Mobile First 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function blmobilefirst_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'blmobilefirst_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since BL Mobile First 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function blmobilefirst_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'blmobilefirst_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since BL Mobile First 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function blmobilefirst_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'blmobilefirst_widget_tag_cloud_args' );

/**
 * Get unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since BL Mobile First 2.0
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @staticvar int $id_counter
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function blmobilefirst_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );



// from 2017-Child ///////////////////////////////////////////////////////////

// require get_stylesheet_directory().'/inc/icon-functions.php';

/**
 * Enqueue styles of the parent theme and the child theme
 */
// function blmobilefirst_theme_enqueue_scripts() {
// 	// wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
// 	// wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css', array( 'parent-style' ), wp_get_theme()->get('Version') );
// 	// wp_enqueue_style( 'fonts-noto-sans', blmobilefirst_fonts_url(), array(), null );
// 	// wp_enqueue_script( 'minified-js', get_stylesheet_directory_uri().'/assets/js/bl.min.js', array( 'jquery' ), '1.1', true );
// 	// wp_enqueue_script( 'navigation-js', get_stylesheet_directory_uri().'/assets/js/navigation.js', array( 'jquery' ), '1.1', true );
// 	// wp_enqueue_script( 'all-js', get_stylesheet_directory_uri().'/assets/js/src/all.js', array( 'jquery' ), '1.1', true );
// 	// wp_enqueue_script( 'kakaolink', 'https://developers.kakao.com/sdk/js/kakao.min.js', array(), null );
// }
// add_action( 'wp_enqueue_scripts', 'blmobilefirst_theme_enqueue_scripts' );

/**
 * 커스텀 프리뷰 창에 Hero Text의 바로가기 화살표를 그린다.
 *
 * @return void
 */
/*function blmobilefirst_customize_partial_blmobilefirst_herotext() {
	echo get_theme_mod( 'blmobilefirst_herotext' );
}*/

/**
 * seasonlook을 sanitize 한다.
 *
 * @return string $input name of the seasonal look, else 'excellence'
 */
function blmobilefirst_sanitize_blmobilefirst_seasonlook( $input ) {
	$valid = array( 'excellence', 'spring', 'winter', 'halloween' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'excellence';
}

/**
 * 글목록에서 글 요약(excerpt)의 단어 개수를 return 값으로 변경. (이 함수 없으면 기본값은 단어 55개)
 *
 * @return '더 보기' 버튼 전에 표시되는 단어 개수 (본문 첫 단어부터 시작)
 */
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * 날짜 텍스트를 받아 영어 요일을 한글 요일로 바꿈. (예, '2019-09-10 Tue' -> '2019-09-10 화')
 * 
 * @return 요일이 한글로 바뀐 날짜 텍스트
 */
function blmobilefirst_w2k( $str ) {
	$search = array( "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" );
	$replace = array( "일", "월", "화", "수", "목", "금", "토" );
	return str_replace( $search, $replace, $str );
}

/**
 *
 * @source https://wordpress.stackexchange.com/questions/159162/set-custom-post-feature-image-as-ogimage
 *
 */
add_action( 'wp_head', 'blmobilefirst_include_opengraph_facebook' );
function blmobilefirst_include_opengraph_facebook(){
		if ( is_single() ) {
			echo '<meta property="og:image" content="'.get_the_post_thumbnail_url( get_the_ID(), 'full' ).'">';
		} else {
    	echo '<meta property="og:image" content="/wp-content/themes/bl-mobilefirst/assets/images/bridge-light-og-image.jpg">';
		}
}
?>
