<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://welaunch.io
 * @since             1.0.
 * @package           WooCommerce_Cart_PDF
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Cart PDF
 * Plugin URI:        https://www.welaunch.io/en/product/woocommerce-cart-pdf/
 * Description:       Create a PDF-Catalog of your WooCommerce Cart
 * Version:           1.0.6
 * Author:            weLaunch
 * Author URI:        https://welaunch.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-cart-pdf
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-cart-pdf-activator.php
 */
function activate_WooCommerce_Cart_PDF() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-cart-pdf-activator.php';
	WooCommerce_Cart_PDF_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-cart-pdf-deactivator.php
 */
function deactivate_WooCommerce_Cart_PDF() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-cart-pdf-deactivator.php';
	WooCommerce_Cart_PDF_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_WooCommerce_Cart_PDF' );
register_deactivation_hook( __FILE__, 'deactivate_WooCommerce_Cart_PDF' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-cart-pdf.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_WooCommerce_Cart_PDF() {

	$plugin_data = get_plugin_data( __FILE__ );
	$version = $plugin_data['Version'];

	$plugin = new WooCommerce_Cart_PDF($version);
	$plugin->run();

	return $plugin;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce/woocommerce.php') && (is_plugin_active('redux-dev-master/redux-framework.php') || is_plugin_active('redux-framework/redux-framework.php') ||  is_plugin_active('welaunch-framework/welaunch-framework.php') ) ){
	$WooCommerce_Cart_PDF = run_WooCommerce_Cart_PDF();

} else {
	add_action( 'admin_notices', 'WooCommerce_Cart_PDF_installed_notice' );
}

function WooCommerce_Cart_PDF_installed_notice()
{
	?>
    <div class="error">
      <p><?php _e( 'WooCommerce Cart PDF requires the WooCommerce and weLaunch Framework plugin. Please install or activate them before: https://www.welaunch.io/updates/welaunch-framework.zip', 'woocommerce-cart-pdf'); ?></p>
    </div>
    <?php
}