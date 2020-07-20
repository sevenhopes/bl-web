<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_sticky() && is_home() ) :
		echo blmobilefirst_get_svg( array( 'icon' => 'thumb-tack' ) );
	endif;
	?>
	<header class="entry-header">
		<?php
		/*
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
			if ( is_single() ) {
				blmobilefirst_posted_on();
			} else {
				echo blmobilefirst_time_link();
				blmobilefirst_edit_link();
			};
			echo '</div><!-- .entry-meta -->';
		};
		*/

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			// the_title( '<h3 class="entry-title">', '</h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			// the_title( '<h2 class="entry-title">', '</h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'blmobilefirst-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
		if ( is_single() ) {
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blmobilefirst' ),
					get_the_title()
				)
			);
		} else {
			the_excerpt();
		}

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'blmobilefirst' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php
	// if ( is_single() ) {
	// 	blmobilefirst_entry_footer();
	// }
	?>

</article><!-- #post-<?php the_ID(); ?> -->
