<?php
/**
 * 테마를 워드프레스 4.7 이전 버전에 적용하려 할 경우 알림
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since BL Mobile First 1.0
 */

/**
 * Prevent switching to BL Mobile First on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since BL Mobile First 1.0
 */
function bl_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'bl_upgrade_notice' );
}
add_action( 'after_switch_theme', 'bl_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * BL Mobile First on WordPress versions prior to 4.7.
 *
 * @since BL Mobile First 1.0
 *
 * @global string $wp_version WordPress version.
 */
function bl_upgrade_notice() {
	/* translators: %s: The current WordPress version. */
	$message = sprintf( __( 'BL Mobile First requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'bl' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since BL Mobile First 1.0
 *
 * @global string $wp_version WordPress version.
 */
function bl_customize() {
	wp_die(
		/* translators: %s: The current WordPress version. */
		sprintf( __( 'BL Mobile First requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'bl' ), $GLOBALS['wp_version'] ),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'bl_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since BL Mobile First 1.0
 *
 * @global string $wp_version WordPress version.
 */
function bl_preview() {
	if ( isset( $_GET['preview'] ) ) {
		/* translators: %s: The current WordPress version. */
		wp_die( sprintf( __( 'BL Mobile First requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'bl' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'bl_preview' );
