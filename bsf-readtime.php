<?php
   /**
    * Plugin Name: BSF ReadTime
    * Plugin URI:  https://brainstormforce.com
    * Description:  To Display Reading time for a particular post.    
    * Version:     1.0.0
    * Author:      Rajkiran Gajanan Bagal.
    * Author URI:  https://brainstormforce.com
    *
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
   define('BSF_RT_ABSPATH', plugin_dir_path(__FILE__));
   
   define('BSF_RT_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

   define('BSF_RT_PLUGIN_URL', untrailingslashit(plugins_url('', __FILE__)));

   require plugin_dir_path(__FILE__).'classes/class-bsfrt-loader.php';
   require plugin_dir_path(__FILE__).'classes/class-bsfrt-readtime.php';