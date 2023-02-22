<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.ulemus.com/
 * @since      1.0.0
 *
 * @package    Cotizador_Ms
 * @subpackage Cotizador_Ms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cotizador_Ms
 * @subpackage Cotizador_Ms/admin
 * @author     Ulemus <jhernandez@ulemus.com>
 */
class Cotizador_Ms_Admin {

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

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cotizador_Ms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cotizador_Ms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cotizador-ms-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cotizador_Ms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cotizador_Ms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cotizador-ms-admin-manage.js', array( 'jquery' ), $this->version, false );

	}

	//Create menu method  
	public function ms_management_menu() {
		add_menu_page('Cotizador Medismart', 'Cotizador Medismart', 'manage_options', 'medismart_prices', array($this, "medismart_prices"), "dashicons-category", 22);
		add_submenu_page( 'ms_medismart', 'Productos', 'Productos','manage_options', 'ms_medismart', array($this, "medismart_prices"));

	}

	public function medismart_prices(){
	    echo '<iframe id="result-products" frameborder="0" style="overflow:hidden;height:1200px;width:100%;margin-left:-10px">'; 
	}

	public function ms_medismart(){
		echo '<iframe id="result-products" frameborder="0" style="overflow:hidden;height:1200px;width:100%;margin-left:-10px">';
	}

}
