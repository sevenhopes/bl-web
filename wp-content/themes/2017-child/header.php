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

			<div class="custom-header-media">
				<?php // the_custom_header_markup(); ?>
			</div>

			<div class="bl-header-slides">
				<a href="<?php echo home_url(); ?>/about/why-bridge-light/"><div>
					<img src="<?php echo content_url(); ?>/uploads/2019/05/Bridge-Lighthouse.jpg" />
					<span class="bl-title">Why Bridge Light?</span>
					<span class="bl-caption">영어가 어려운가요? 다리를 놓았습니다. 빛을 밝혔습니다! 뚜벅뚜벅 따라만 오세요. 나머진 브릿지라잇이 책임지겠습니다.</span>
				</div></a>
				<a href="<?php echo home_url(); ?>/about/support-and-services/"><div>
					<img src="<?php echo content_url(); ?>/uploads/2019/05/scholarship-display.jpg" />
					<span class="bl-title">장학금을 주는 학원?!</span>
					<span class="bl-caption">우리학원 디게 좋아요. 막 돈도 줘요. 엄청 많이요. 중3까지의 영어학업을 브릿지라잇에서 끝마치면 말이지요, 후후후... you just activated my trap card... 학생들이 매년 200만원씩 받아가요. 열심히 공부한 당신 떠나라, 고등학교로...?</span>
				</div></a>
				<a href="<?php echo home_url(); ?>/admission/appt-and-visit/"><div>
					<img src="<?php echo content_url(); ?>/uploads/2019/05/certificate-pics-wall.jpg" />
					<span class="bl-title">춘천대표 우수학원</span>
					<span class="bl-caption">저희 로비 벽에 걸린 우수학원상입니다. 맞아요, 저희가 좀 우수해요. 우수한 강사진! 프로그램부터 학생 개개인까지 신경쓰는 원장단! 친절한 상담실장! 우수우수해요. 가을 되면 난리나요. 우수수..... 메롱</span>
				</div></a>
				<a href="<?php echo home_url(); ?>/about/foundation-story/"><div>
					<img src="<?php echo content_url(); ?>/uploads/2019/04/main-building-at-night.jpg" />
					<span class="bl-title">Story of Establishment</span>
					<span class="bl-caption">I'm just writing this in English so I can check how it looks. 한글도 섞어서 써봅니다. Yes, this homepage is a beta versoin. 여기저기 봐준다면 유혈사태는 일어나지 않을 것입니다. (인터넷 드립)</span>
				</div></a>
			</div>

			<div class="bl-button-container">
				<div id="bl-direct-buttons">
					<div><a href="tel:033-243-5757"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frontpage-button-phone.png" alt="상담전화" /></a></div>
					<div><a href="http://www.bridgelightels.com/m/admission/appt-and-visit/#bl-map"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frontpage-button-map.png" alt="지도보기" /></a></div>
					<div><a href="http://blog.naver.com/blcorp" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frontpage-button-blog.png" alt="블로그" /></a></div>
					<div><a href="https://www.facebook.com/bridgelightels/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frontpage-button-facebook.png" alt="페이스북" /></a></div>
				</div>
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
