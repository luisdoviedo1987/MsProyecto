<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.ulemus.com/
 * @since             1.0.0
 * @package           Cotizador_Ms
 *
 * @wordpress-plugin
 * Plugin Name:       Cotizador Medismart
 * Plugin URI:        https://www.medismart.net/
 * Description:       Cotizador de especialidades medismart.
 * Version:           1.0.0
 * Author:            Ulemus
 * Author URI:        https://www.ulemus.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cotizador-ms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('COTIZADOR_MS_VERSION', '1.0.0' );
define('MS_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
define('MS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MS_PLUGIN_BASEPATH', plugin_basename(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cotizador-ms-activator.php
 */
function activate_cotizador_ms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cotizador-ms-activator.php';
	$activator = new Cotizador_Ms_Activator();
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cotizador-ms-deactivator.php
 */
function deactivate_cotizador_ms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cotizador-ms-activator.php';
	$activator = new Cotizador_Ms_Activator();

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cotizador-ms-deactivator.php';
	$deactivator = new Cotizador_Ms_Deactivator($activator);
	$deactivator->deactivate();

}

register_activation_hook( __FILE__, 'activate_cotizador_ms' );
register_deactivation_hook( __FILE__, 'deactivate_cotizador_ms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cotizador-ms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cotizador_ms() {

	$plugin = new Cotizador_Ms();
	$plugin->run();

}
run_cotizador_ms();
