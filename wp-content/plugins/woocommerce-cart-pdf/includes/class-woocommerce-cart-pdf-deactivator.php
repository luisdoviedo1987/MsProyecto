<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://woocommerce-cart-pdf.db-dzine.de
 * @since      1.0.0
 *
 * @package    WooCommerce_Cart_PDF
 * @subpackage WooCommerce_Cart_PDF/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    WooCommerce_Cart_PDF
 * @subpackage WooCommerce_Cart_PDF/includes
 * @author     Daniel Barenkamp <contact@db-dzine.de>
 */
class WooCommerce_Cart_PDF_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook( 'woocommerce_cart_pdf_generate_cache' );
	}

}
