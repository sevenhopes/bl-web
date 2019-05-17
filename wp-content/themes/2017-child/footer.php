<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="bl-button-container">
				<div id="bl-direct-buttons">
					<!-- <div><a href="tel:033-243-5757"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frontpage-button-phone.png" alt="상담전화" /></a></div> -->
					<!-- <div><a href="http://www.bridgelightels.com/m/admission/appt-and-visit/#bl-map"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frontpage-button-map.png" alt="지도보기" /></a></div> -->
					<div><a href="http://blog.naver.com/blcorp" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frontpage-button-blog.png" alt="블로그" /></a></div>
					<div><a href="https://www.facebook.com/bridgelightels/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/frontpage-button-facebook.png" alt="페이스북" /></a></div>
				</div>
			</div>

			<div class="wrap bl-wrap">
				<?php
				// get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) :
					?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
								)
							);
						?>
					</nav><!-- .social-navigation -->
					<?php
				endif;

				// get_template_part( 'template-parts/footer/site', 'info' );
				?>
			</div><!-- .wrap -->

			<a ></a>
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
