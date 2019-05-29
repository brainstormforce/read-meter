<?php
/**
 * BSF Read Meter Loader Doc comment
 *
 * PHP version 7
 *
 * @category PHP
 * @package  Read Meter
 * @author   Display Name <username@rajkiranb.com>
 * @license  http://brainstormforce.com
 * @link     http://brainstormforce.com
 */

if (! class_exists('BSF_RT_Loader') ) :
    /**
     * Read Meter Loader Doc comment
     *
     * PHP version 7
     *
     * @category PHP
     * @package  Read Meter
     * @author   Display Name <username@rajkiranb.com>
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

            add_action('wp_enqueue_scripts', array($this, 'bsfrt_pluginStyle_frontend'));

            add_action('admin_enqueue_scripts', array($this, 'bsfrt_pluginStyle_dashboard'));

           
            register_deactivation_hook(BSF_RT_PATH, array($this,'bsf_rt_remove_data'));
           
        }         
        /**
         * Plugin Styles for frontend.
         *
         * @since  1.0.0
         * @return void
         */
        public function bsfrt_pluginStyle_frontend()
        { 

             wp_enqueue_style('bsfrt_frontend', BSF_RT_PLUGIN_URL.'/assets/css/bsfrt-frontend-css.css');

             wp_enqueue_script('bsfrt_frontend', BSF_RT_PLUGIN_URL.'/assets/js/bsf-rt-frontend.js');
        }
        /**
         * Plugin Styles for admin dashboard.
         *
         * @since  1.0.0
         * @return void
         */
        public function bsfrt_pluginStyle_dashboard()
        { 

             wp_enqueue_style('wp-color-picker');

             wp_enqueue_style('bsfrt_dashboard', BSF_RT_PLUGIN_URL.'/assets/css/bsfrt-admin-dashboard-css.css', 999);

             wp_enqueue_script('bsfrt_backend', BSF_RT_PLUGIN_URL.'/assets/js/bsf-rt-backend.js');

             wp_enqueue_script('colorpickerscript', BSF_RT_PLUGIN_URL.'/assets/js/color-picker.js', array('jquery','wp-color-picker'), null, true);
        }
        

        public function bsf_rt_remove_data()
        {

            delete_option('bsf_rt_general_settings');

            delete_option('bsf_rt_progress_bar_settings');
            
            delete_option('bsf_rt_read_time_settings');
        }
            
    }
    $fl = new BSF_RT_Loader();
endif;
?>
