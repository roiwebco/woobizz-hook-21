<?php
/*
Plugin Name: Woobizz Hook 21 
Plugin URI: http://woobizz.com
Description: Disable zoom on product page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook21
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook21_load_textdomain' );
function woobizzhook21_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook21', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
    add_action( 'after_setup_theme', 'woobizzhook21_remove_zoom_on_product_image', 100 );
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook21_admin_notice' );
}
//Hook 21
function woobizzhook21_remove_zoom_on_product_image() {
	remove_theme_support('wc-product-gallery-zoom' );
}
//Hook21 Notice
function woobizzhook21_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 21 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook21' ); ?></p>
    </div>
    <?php
}