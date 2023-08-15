<?php

/**
 * Plugin Name: Hello Addon
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Rubel Ahamed
 * Author URI:  https://rubelahamed.xyz/
 * Text Domain: elementor-addon
 */

function Wse_Child_Theme_addon_rubel( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/hello-world.php' );
	require_once( __DIR__ . '/widgets/team-member.php' );
	require_once( __DIR__ . '/widgets/complexaddon.php' );

	$widgets_manager->register( new \Wse_Elementor_Addon() );
	$widgets_manager->register( new \Wse_Team_Members_Addon() );
	$widgets_manager->register( new \Wse_promo_box_Addon() );

}
add_action( 'elementor/widgets/register', 'Wse_Child_Theme_addon_rubel' );