<?php
/**
 * Add submenu of Global settings Page to admin menu.
 *
 * @since  1.0.0
 * @return void
 */
function BSF_RT_Settings_page() {
	add_submenu_page(
		'options-general.php',
		'Read Meter',
		'Read Meter',
		'manage_options',
		'bsf_rt',
		'BSF_RT_Page_html'
	);
}
add_action( 'admin_menu', 'BSF_RT_Settings_page' );

/**
 * Main Frontpage.
 *
 * @since  1.0.0
 * @return void
 */
function BSF_RT_Page_html() {
	include BSF_RT_ABSPATH . 'includes/bsf-rt-main-frontend.php';
}
