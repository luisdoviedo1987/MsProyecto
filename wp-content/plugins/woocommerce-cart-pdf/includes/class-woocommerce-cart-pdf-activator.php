<?php

/**
 * Fired during plugin activation
 *
 * @link       http://woocommerce-cart-pdf.db-dzine.de
 * @since      1.0.0
 *
 * @package    WooCommerce_Cart_PDF
 * @subpackage WooCommerce_Cart_PDF/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WooCommerce_Cart_PDF
 * @subpackage WooCommerce_Cart_PDF/includes
 * @author     Daniel Barenkamp <contact@db-dzine.de>
 */
class WooCommerce_Cart_PDF_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$timestamp = wp_next_scheduled( 'woocommerce_cart_pdf_generate_cache_schedule' );

		if ( false === $timestamp ) {
			wp_schedule_event( time(), 'daily', 'woocommerce_cart_pdf_generate_cache' );
		}
	}

}
