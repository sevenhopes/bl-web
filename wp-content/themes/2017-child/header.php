<?php
/**
 * 자식 테마 Child-2017의 헤더
 *
 * <div id="content"> 이전의 <head>를 포함한 모든 태그와 내용을 명시.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

<meta property="og:site_name" content="브릿지라잇 어학원">
<meta property="og:url" content="http://www.bridgelightels.com/m/">
<meta property="og:image" content="http://www.bridgelightels.com/m/wp-content/uploads/2019/05/og-image-1200x630.jpg">
<meta property="og:image:height" content="630">
<meta property="og:image:width" content="1200">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:description" content="상담예약: 033-243-5757 / 영어의 생활화 / 우수한 강사진 / 말하기, 듣기, 읽기, 쓰기 4대영역 통합교육 / TOEIC, TEPS 시험영어 / 여름/겨울방학 영어캠프 / 춘천시 전역 버스운행 / 춘천 영어학원 / 온의동 영어학원">
<meta property="og:title" content="<?php the_title(); ?> - 브릿지라잇 어학원">
<meta property="og:type" content="article">
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="custom-header">
			<?php
				// 부모 테마의 사이트 제목은 삭제
				// get_template_part( 'template-parts/header/site', 'branding' );
			?>
			<div id="bl-branding">
				<button id="bl-menu-toggle" aria-controls="top-menu" aria-expanded="false">
					<img src="<?php echo get_theme_mod( 'bl_menu_button_img' ); ?>" />
				</button>
				<?php the_custom_logo(); ?>
			</div>

			<!-- <div class="custom-header-media"> -->
				<?php // the_custom_header_markup(); ?>
			<!-- </div> -->

			<div class="bl-header-slides">
				<a href="<?php echo home_url(); ?>/about/why-bridge-light/">
					<img src="<?php echo content_url(); ?>/uploads/2019/05/header-bridge-light.jpg" />
					<span class="bl-title">왜 브릿지라잇인가</span>
					<span class="bl-caption">영어가 어려운가요? 다리를 놓았습니다. 빛을 밝혔습니다! 따라만 오세요. 나머진 저희가 책임지겠습니다.</span>
				</a>
				<a href="<?php echo home_url(); ?>/about/support-and-services/">
					<img src="<?php echo content_url(); ?>/uploads/2019/05/header-scholarship-display.jpg" />
					<span class="bl-title">장학금을 주는 학원?!</span>
					<span class="bl-caption">우리학원 디게 좋아요. 막 돈도 줘요. 중3까지의 영어학업을 브릿지라잇에서 끝마치면 말이지요, 후후후... you just activated my trap card...</span>
				</a>
				<a href="<?php echo home_url(); ?>/admission/appt-and-visit/">
					<img src="<?php echo content_url(); ?>/uploads/2019/05/header-certificate-pics-wall.jpg" />
					<span class="bl-title">춘천대표 우수학원</span>
					<span class="bl-caption">저희 로비 벽에 걸린 우수학원상입니다. 맞아요, 저희가 좀 우수해요. 우수한 강사진! 가을 되면 난리나요... 메롱</span>
				</a>
				<a href="<?php echo home_url(); ?>/about/foundation-story/">
					<img src="<?php echo content_url(); ?>/uploads/2019/05/header-main-building-at-night.jpg" />
					<span class="bl-title">Story of Establishment</span>
					<span class="bl-caption">Yes, this homepage is a beta versoin. Quote: 여기저기 둘러봐준다면 유혈사태는 일어나지 않을 것입니다. by Civilization the game</span>
				</a>
			</div>

		</div><!-- .custom-header -->
	</header><!-- #masthead -->

	<?php 
		// 1 부모테마 <header> 안의 <div .navigation-top>을 <header #masthead> 밖으로 꺼냄,
		//   왜냐하면 메인페이지 이외의 페이지에서는 헤더보다 메뉴가 더 크기 때문. (overflow 문제)
		// 2 부모테마 template-parts/navigation/navigation-top.php 대신 여기에 코딩.
		// 3 사용하지 않는 .menu-toggle과 .menu-scroll-down을 삭제 (대신 header-image.php 안에서 .bl-menu-toggle을 사용)
	if ( has_nav_menu( 'top' ) ) : ?>
		<div class="navigation-top">
			<div class="wrap">
				<?php // get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'twentyseventeen' ); ?>">
					<?php wp_nav_menu( array( 'theme_location' => 'top', 'menu_id' => 'top-menu', ) ); ?>
				</nav>
			</div><!-- .wrap -->
		</div><!-- .navigation-top -->
	<?php endif; ?>

	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		echo '<div class="single-featured-image-header">';
		echo get_the_post_thumbnail( get_queried_object_id(), 'twentyseventeen-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<div class="bl-dev-code">
		<?php
		echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
		?>
	</div>

	<div class="site-content-contain">
		<div id="content" class="site-content">
