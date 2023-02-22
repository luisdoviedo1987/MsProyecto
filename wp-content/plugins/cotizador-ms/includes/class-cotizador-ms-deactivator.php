<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.ulemus.com/
 * @since      1.0.0
 *
 * @package    Cotizador_Ms
 * @subpackage Cotizador_Ms/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Cotizador_Ms
 * @subpackage Cotizador_Ms/includes
 * @author     Ulemus <jhernandez@ulemus.com>
 */
class Cotizador_Ms_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	private $ms_activator;

	public function __construct($activator){
        $this->ms_activator = $activator;
    }

	public  function deactivate() {
	
	}

}
