<?php
/**
 * Plugin Name: WooCommerce Logistic
 * Plugin URI: http://agenciamagma.com.br
 * Description: WooCommerce Logistic inserts a field on the product page so that the user can tell where the item is located in your inventory.
 * Version: 0.0.1
 * Author: agenciamagma, Carlos Cardoso Dias
 * Author URI: http://agenciamagma.com.br
 * Text Domain: woocommerce-logistic
 * Domain Path: /languages/
 * License: -
 *
 * @author Carlos Cardoso Dias
 */

/**
 * Anti cheating code
 */
defined( 'ABSPATH' ) or die( 'A Ag&ecirc;ncia Magma n&atilde;o deixa voc&ecirc; trapacear ;)' );

if ( ! class_exists( 'WooCommerce_Logistic' ) ) :

require_once( 'includes/core/class-mgm-main-plugin.php' );

final class WooCommerce_Logistic extends MGM_Main_Plugin {

	/**
	 *
	 * @action( hook: "woocommerce_product_options_stock_fields" )
	 */
	public function add_position_in_stock_option() {
		global $thepostid;
		woocommerce_wp_text_input( array(
			'id'                => '_stock_position',
			'value'             => get_post_meta( $thepostid , '_stock_position' , true ),
			'label'             => __( 'Stock Position', $this->textdomain ),
			'desc_tip'          => true,
			'description'       => __( 'Position of the product in stock.', $this->textdomain )
		) );
	}

	/**
	 * Save stock data
	 *
	 * @action( hook: "woocommerce_process_product_meta_variable" )
	 * @action( hook: "woocommerce_process_product_meta_simple" )
	 */
	public function save_stock_position( $post_id ) {
		if ( ! empty( $_POST['_stock_position'] ) ) {
			update_post_meta( $post_id , '_stock_position' , sanitize_text_field( $_POST['_stock_position'] ) );
		}
	}
}

/**
 * Initialize the plugin
 */
WooCommerce_Logistic::register( array( 'called_class' => 'WooCommerce_Logistic' ) );

endif;