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
<meta property="og:image" content="http://www.bridgelightels.com/m/wp-content/uploads/2019/04/og-image-1200x630.jpg">
<meta property="og:image:height" content="630">
<meta property="og:image:width" content="1200">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:description" content="상담예약: 033-243-5757 / 우수한 강사진 / 영어의 생활화 / 말하기, 듣기, 읽기, 쓰기 4대영역 통합교육 / TOEIC, TEPS 시험영어 / 춘천시 영어학원은 브릿지라잇 / 온의동 영어학원은 브릿지라잇">
<meta property="og:title" content="<?php the_title(); ?> - 브릿지라잇 어학원">
<meta property="og:type" content="article">
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

	</header><!-- #masthead -->

	<?php //부모테마 <header> 안의 <div .navigation-top>을 <header #masthead> 밖으로 꺼냄. ?>
	<?php if ( has_nav_menu( 'top' ) ) : ?>
		<div class="navigation-top">
			<div class="wrap">
				<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
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
