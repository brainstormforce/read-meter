<?php
   /**
    * Plugin Name: Read Meter - Advanced Read Time & Reading Progress Bar for WordPress
    * Plugin URI:  https://brainstormforce.com
    * Description:  To Display Reading time for a particular post.    
    * Version:     1.0.0
    * Author:      Rajkiran Gajanan Bagal.
    * Author URI:  https://brainstormforce.com
    * Text Domain: bsf_rt_textdomain.
    * Main
    *
    * PHP version 7
    *
    * @category PHP
    * @package  BSF ReadTime
    * @author   Display Name <username@rajkiranb.com>
    * @license  https://brainstormforce.com 
    * @link     https://brainstormforce.com
    */
   define('BSF_RT_PATH', __FILE__);

   define('BSF_RT_ABSPATH', plugin_dir_path(__FILE__));
   
   define('BSF_RT_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

   define('BSF_RT_PLUGIN_URL', untrailingslashit(plugins_url('', __FILE__)));

   require_once plugin_dir_path(__FILE__).'classes/class-bsfrt-loader.php';
   require_once plugin_dir_path(__FILE__).'classes/class-bsfrt-readtime.php';

   
