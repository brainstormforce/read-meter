<?php
/**
 * Plugin Name: Read Meter - Reading Time & Progress Bar for WordPress.
 * Description:  To display Reading Time for a particular post.
 * Version:     1.0.10
 * Author:      Pratik Chaskar
 * Author URI:  https://pratikchaskar.com
 * Text Domain: read-meter.
 * Main
 *
 * PHP version 7
 *
 * @category PHP
 * @package  BSF ReadTime
 * @author   Display Name <username@pratikchaskar.com>
 * @license  https://pratikchaskar.com
 * @link     https://pratikchaskar.com
 */

define( 'BSF_RT_PATH', __FILE__ );

define( 'BSF_RT_VER', '1.0.10' );

define( 'BSF_RT_ABSPATH', plugin_dir_path( __FILE__ ) );

define( 'BSF_RT_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

define( 'BSF_RT_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

require_once plugin_dir_path( __FILE__ ) . 'classes/class-bsfrt-loader.php';
require_once plugin_dir_path( __FILE__ ) . 'classes/class-bsfrt-readtime.php';


