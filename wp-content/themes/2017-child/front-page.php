<?php
/**
 * The front page template file
 *
 * 첫페이지로 정적인 페이지(static page)를 선택했을 때 보여짐
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.1
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
		// 페이지 중 하나인 전면 페이지(프론트 페이지)의 내용을 보여줌.
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
		else :
			get_template_part( 'template-parts/post/content', 'none' );
		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
