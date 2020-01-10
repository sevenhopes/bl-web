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

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5GQSKZP');</script>
<!-- End Google Tag Manager -->

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

<meta property="og:site_name" content="브릿지라잇 어학원">
<meta property="og:url" content="<?php the_permalink(); ?>">
<!-- <meta property="og:image" content="http://www.bridgelightels.com/m/wp-content/themes/2017-child/assets/images/bridge-light-og-image.jpg"> -->
<meta property="og:image:height" content="630">
<meta property="og:image:width" content="1200">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:description" content="033-243-5757 #영어생활화 #매일수업 #방학영어캠프 #미국연수 #춘천전역버스 #초중영어 #춘천영어학원 #온의동영어학원">
<meta property="og:title" content="<?php the_title(); ?> - 브릿지라잇 어학원">
<meta property="og:type" content="website">
<meta property="fb:app_id" content="462886344532595">
<link rel="canonical" href="http://www.bridgelightels.com/">
</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5GQSKZP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
					<!-- <img src="<?php echo get_theme_mod( 'bl_menu_button_img' ); ?>" /> -->
					<span class="bl-toggle-icon">Menu</span>
				</button>
				<?php the_custom_logo(); ?>
			</div>

			<!-- <div class="custom-header-media"> -->
				<?php // the_custom_header_markup(); ?>
			<!-- </div> -->

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

	<div class="bl-under-header">
		We are 춘천 영어학원, 브릿지라잇 어학원, Bridge Light, Bridge Light English Language School.
	</div>

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

	<div class="site-content-contain">
		<div id="content" class="site-content">
