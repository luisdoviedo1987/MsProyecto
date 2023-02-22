<?php

/*
Plugin Name: Multi Step for Contact Form 7 (Lite)
Plugin URI: https://ninjateam.org/contact-form-7-multi-step/
Description: Break your long form into user-friendly steps.
Version: 2.7.3
Author: NinjaTeam
Author URI: http://ninjateam.org
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists( 'cf7mls_plugin_init' ) ) {
	require_once plugin_dir_path( __FILE__ ) . 'inc/Fallback.php';
	add_action(
		'admin_init',
		function() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
	);
	return;
}

if ( ! defined( 'CF7MLS_PLUGIN_DIR' ) ) {
	define( 'CF7MLS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'CF7MLS_PLUGIN_URL' ) ) {
	define( 'CF7MLS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'CF7MLS_PLUGIN_BASENAME' ) ) {
	define( 'CF7MLS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'CF7MLS_NTA_VERSION' ) ) {
	define( 'CF7MLS_NTA_VERSION', '2.7.3' );
}

if ( ! function_exists( 'cf7mls_plugin_init' ) ) {
	function cf7mls_plugin_init() {
		// language load text domain
		require_once CF7MLS_PLUGIN_DIR . '/inc/I18n.php';
		// CF7DB
		require_once CF7MLS_PLUGIN_DIR . '/inc/cf7db.php';
		// admin
		require_once CF7MLS_PLUGIN_DIR . '/inc/admin/init.php';
		require_once CF7MLS_PLUGIN_DIR . '/inc/admin/settings.php';
		require_once CF7MLS_PLUGIN_DIR . '/inc/admin/review.php';
		require_once CF7MLS_PLUGIN_DIR . '/inc/admin/dashboard-widget.php';
		// frontend
		require_once CF7MLS_PLUGIN_DIR . '/inc/frontend/init.php';
		require_once CF7MLS_PLUGIN_DIR . '/inc/frontend/validation.php';
	}
}

add_action( 'plugins_loaded', 'cf7mls_plugin_init' );

