<?php
/**
 * BSF ReadTime Loader Doc comment
 *
 * PHP version 7
 *
 * @category PHP
 * @package  BSF ReadTime
 * @author   Display Name <username@ahemads.com>
 * @license  http://brainstormforce.com
 * @link     http://brainstormforce.com
 */

if (! class_exists('BSF_RT_Loader') ) :
    /**
     * WCM Loader Doc comment
     *
     * PHP version 7
     *
     * @category PHP
     * @package  Google_Pagespeed_Insights_Portal
     * @author   Display Name <username@ahemads.com>
     * @license  http://brainstormforce.com
     * @link     http://brainstormforce.com
     */
    class BSF_RT_Loader
    {
        /**
         * Constructor
         */
        public function __construct()
        {
            include BSF_RT_ABSPATH.'includes/bsf-rt-page.php'; 
            add_action('init', array($this, 'bsfrt_pluginStyle'));
            add_action('init', array($this, 'bsfrt_pluginScript'));
           
        }         
        /**
         * Plugin Styles.
         *
         * @since  1.0.0
         * @return void
         */
        public function bsfrt_pluginStyle()
        { 
             wp_enqueue_style('wp-color-picker');
             wp_enqueue_style('customstyle', BSF_RT_PLUGIN_URL.'/assets/css/styles.css');
        }
         /**
          * Plugin Scripts.
          *
          * @since  1.0.0
          * @return void
          */
        public function bsfrt_pluginScript()
        { 
             wp_enqueue_script('customscript', BSF_RT_PLUGIN_URL.'/assets/js/bsf-rt.js');
        }

       
    }
    $fl = new BSF_RT_Loader();
endif;
?>
