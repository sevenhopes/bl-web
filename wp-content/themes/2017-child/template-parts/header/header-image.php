<?php
/**
 * 헤더 미디어를 보여줌
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.0
 */

?>
<div class="custom-header">

	<div class="custom-header-media">
		<?php the_custom_header_markup(); ?>
	</div>

	<?php
		/*
		 * 부모 테마의 사이트 제목은 삭제
		 */
		// get_template_part( 'template-parts/header/site', 'branding' );
	?>

	<?php
	/*
	 * 여기부터 자식 테마에 추가한 코드, 위 코드는 부모 테마의 코드.
	 */
	?>
	<div id="bl-branding">
		<button id="bl-menu-toggle" aria-controls="top-menu" aria-expanded="false">
			<img src="<?php echo get_theme_mod( 'bl_menu_button_img' ); ?>" />
		</button>
		<!-- <div class="bl-custom-logo-wrap"> -->
			<?php the_custom_logo(); ?>
		<!-- </div> -->
	</div>

	<?php
	if ( is_front_page() ) :
	$herotext = get_theme_mod( 'bl_herotext' );
	?>
	<div id="bl-hero-text"><?php echo $herotext; ?></div>

	<button id="bl-hero-button">
		<a href="<?php echo get_theme_mod( 'bl_herolink' ); ?>"><?php echo get_theme_mod( 'bl_herobutton' ); ?></a>
	</button>
	<?php endif; ?>

</div><!-- .custom-header -->
