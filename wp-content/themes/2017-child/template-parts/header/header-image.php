<?php
/**
 * 헤더 미디어를 보여줌
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.1
 */

?>
<div class="custom-header">

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

	<div class="custom-header-media">
		<?php the_custom_header_markup(); ?>
	</div>

	<div class="bl-button-container">
		<div id="bl-direct-buttons">
			<div><a href="tel:033-243-5757"><img src="/wp-content/themes/2017-child/assets/images/frontpage-button-phone.png" alt="상담전화" /></a></div>
			<div><a href="/admission/appt-and-visit/#bl-map"><img src="/wp-content/themes/2017-child/assets/images/frontpage-button-map.png" alt="지도보기" /></a></div>
			<div><a href="http://blog.naver.com/blcorp" target="_blank"><img src="/wp-content/themes/2017-child/assets/images/frontpage-button-blog.png" alt="블로그" /></a></div>
			<div><a href="https://www.facebook.com/bridgelightels/" target="_blank"><img src="/wp-content/themes/2017-child/assets/images/frontpage-button-facebook.png" alt="페이스북" /></a></div>
		</div>
	</div>

</div><!-- .custom-header -->
