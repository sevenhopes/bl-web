<?php
/**
 * 페이지를 보여주기 위한 템플릿
 *
 * 템플릿이 따로 선택되지 않은 모든 페이지는 이 파일을 통해
 * 내용이 보여짐.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.1
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();

				// get_template_part( 'template-parts/page/content', 'page' );
			?>
			<?php // 위 파일의 코드를 직접 갖다붙임 ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php blmobilefirst_edit_link( get_the_ID() ); ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'blmobilefirst' ),
								'after'  => '</div>',
							)
						);
						?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
				// comments_template();
			// endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
