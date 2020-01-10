<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="bl-wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// 댓글 기능 비활성
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;

				the_post_navigation(
					array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', '2017-child' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( '이전 소식', '2017-child' ) . '</span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', '2017-child' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( '다음 소식', '2017-child' ) . '</span> <span class="nav-title">%title</span>',
						'screen_reader_text' => __( 'Post navigation', '2017-child' ),
						// 아래 두 줄로 현재 글과 같은 카테고리의 글로만 이전/다음 링크를 만듬
						'in_same_term' => true,
						'taxonomy' => __( 'category', '2017-child' ),
					)
				);

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php //사이드바 비활성 get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();
