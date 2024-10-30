<?php
/*
Plugin Name: Masterstudy LMS Divi Modules
Plugin URI:  http://masterstudy.stylemixthemes.com/masterstudy-lms-divi/
Description: Masterstudy LMS Modules for Divi Builder
Author:      StylemixThemes
Author URI:  https://stylemixthemes.com/
Text Domain: masterstudy-lms-divi
Version:     1.0.7
Domain Path: /languages
*/

defined( 'ABSPATH' ) || die();

define( 'DMSLMS_VERSION', '1.0.7' );
define( 'DMSLMS_FILE__', __FILE__ );
define( 'DMSLMS_DIR_PATH', dirname( __FILE__ ) );
define( 'DMSLMS_DIR_URL', plugin_dir_url( DMSLMS_FILE__ ) );
define( 'DMSLMS_ASSETS', trailingslashit( DMSLMS_DIR_URL . 'assets' ) );
/**
 * Environment
 * PROD
 * DEV
 */
define( 'DMSLMS_ENV', 'PROD' );


/**
 * Load plugin text domain
 * @since 1.0.7
 */
if ( ! function_exists( 'masterstudy_lms_divi_textdomain' ) ) {
	function masterstudy_lms_divi_textdomain() {
		load_plugin_textdomain( 'masterstudy-lms-divi', false, dirname( plugin_basename( __FILE__ ) . '/languages' ) );
	}
}
add_action( 'init', 'masterstudy_lms_divi_textdomain' );


/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function masterstudy_lms_divi_enqueue_admin_style() {
	wp_enqueue_style( 'masterstudy_lms_divi_wp_admin_css', DMSLMS_DIR_URL . '/includes/admin-style.css', false, DMSLMS_VERSION );
}

add_action( 'admin_enqueue_scripts', 'masterstudy_lms_divi_enqueue_admin_style' );


/**
 * stm_lms_divi_init function
 *
 * @return void
 */
if ( ! function_exists( 'stm_lms_divi_init' ) ) {
	function stm_lms_divi_init() {
		if ( ! defined( 'STM_LMS_PATH' ) ) {
			add_action(
				'admin_notices',
				function () {
					require_once DMSLMS_DIR_PATH . '/includes/templates/notice.php';
				}
			);
		} else if ( ! function_exists( 'ms_lms_dm_initialize_extension' ) ) {
			add_action(
				'divi_extensions_init',
				function () {
					require_once DMSLMS_DIR_PATH . '/includes/MasterstudyDiviModules.php';
				}
			);
		}
	}
}
add_action( 'plugins_loaded', 'stm_lms_divi_init' );
