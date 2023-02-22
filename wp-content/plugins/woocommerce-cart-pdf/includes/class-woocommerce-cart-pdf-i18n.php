<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://woocommerce-cart-pdf.db-dzine.de
 * @since      1.0.0
 *
 * @package    WooCommerce_Cart_PDF
 * @subpackage WooCommerce_Cart_PDF/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    WooCommerce_Cart_PDF
 * @subpackage WooCommerce_Cart_PDF/includes
 * @author     Daniel Barenkamp <contact@db-dzine.de>
 */
class WooCommerce_Cart_PDF_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$loaded = load_plugin_textdomain(
			'woocommerce-cart-pdf',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
