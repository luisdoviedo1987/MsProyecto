<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://woocommerce-cart-pdf.db-dzine.de
 * @since      1.0.0
 *
 * @package    WooCommerce_Cart_PDF
 * @subpackage WooCommerce_Cart_PDF/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WooCommerce_Cart_PDF
 * @subpackage WooCommerce_Cart_PDF/admin
 * @author     Daniel Barenkamp <contact@db-dzine.de>
 */
class WooCommerce_Cart_PDF_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $notice;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->notice = "";
	}

	public function load_redux()
	{
        if(!is_admin() || !current_user_can('administrator') || (defined('DOING_AJAX') && DOING_AJAX && (isset($_POST['action']) && !$_POST['action'] == "woocommerce_pdf_catlaog_options_ajax_save") )) {
            return false;
        }

	    // Load the theme/plugin options
	    if ( file_exists( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/options-init.php' ) ) {
	        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/options-init.php';
	    }
	}

   /**
     * Enqueue Admin Styles
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://plugins.db-dzine.com
     * @return  boolean
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name.'-admin', plugin_dir_url(__FILE__).'css/woocommerce-cart-pdf-admin.css', array(), $this->version, 'all');
    }

    /**
     * Enqueue Admin Scripts
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://plugins.db-dzine.com
     * @return  boolean
     */
    public function enqueue_scripts()
    {
    	$forJS = array(
    		'frontend_url' => get_site_url(),
    	);
        wp_enqueue_script($this->plugin_name . '-admin', plugin_dir_url(__FILE__).'js/woocommerce-cart-pdf-admin.js', array('jquery'), $this->version, true);
        wp_localize_script($this->plugin_name . '-admin', 'woocommerce_cart_pdf_options', $forJS);
    }

	public function init()
	{
        global $woocommerce_cart_pdf_options;

        if(!is_admin() || !current_user_can('administrator') || (defined('DOING_AJAX') && DOING_AJAX)){
            $woocommerce_cart_pdf_options = get_option('woocommerce_cart_pdf_options');
        }
	}

	public function generate_cart_pdf_link($atts)
	{
	    $attributes = shortcode_atts( array(
	        'text' => 'Cart PDF',
	    ), $atts );

		$actual_link = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

		if( strpos($actual_link, '?') === FALSE ){ 
			$actual_link = $actual_link . '?'; 
		} else {
		 	$actual_link = $actual_link . '&'; 
		}

	    return '<a href="' . $actual_link . 'cart-pdf=true" class="woocommerce_cart_pdf_button button alt" target="_blank"><i class="fa fa-file-pdf-o fa-1x "></i>  ' . $attributes['text'] . '</a>';
	}	

	public function add_preview_frame()
	{
		?>
		<div id="cart-pdf-preview-frame-container" class="cart-pdf-preview-frame-container">
			<div id="cart-pdf-preview-spinner" class="cart-pdf-preview-spinner">
				<i class="el el-refresh el-spin"></i>
			</div>
			<iframe id="cart-pdf-preview-frame" src="" width="100%" height="100%" class="cart-pdf-preview-frame">

			</iframe>
		</div>
		<div id="cart-pdf-preview-frame-overlay" class="cart-pdf-preview-frame-overlay"></div>
		<?php
	}
}