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

    add_action( 'init', array($this, 'bsf_rt_process_form'));
   
}

public function bsf_rt_process_form() {

    $page = isset( $_GET['page'] ) ? $_GET['page'] : null;

    if ( 'bsf_rt' !== $page ) {
        return;
    }
    if (isset( $_POST['bsf-rt-general'] ) && wp_verify_nonce( $_POST['bsf-rt-general'], 'bsf-rt-nonce-general' )) {
        
            if (isset($_POST['bsf_rt_words_per_minute'])) {

                $bsf_rt_words_per_minute=$_POST['bsf_rt_words_per_minute'];

            } else {

                $bsf_rt_words_per_minute = '275';
            }
            
            if (isset($_POST['posts'])) {

                $bsf_rt_post_types=$_POST['posts'];

            } else {

                $bsf_rt_post_types = array();
            }
            if (isset($_POST['bsf_rt_include_images'])) {

                $bsf_rt_include_images=$_POST['bsf_rt_include_images'];

            } else {

                $bsf_rt_include_images = '';
            }
            if (isset($_POST['bsf_rt_include_comments'])) {

                $bsf_rt_include_comments=$_POST['bsf_rt_include_comments'];
            } else {

                $bsf_rt_include_comments = '';
            }

            $update_options = array(
              'bsf_rt_words_per_minute'   => $bsf_rt_words_per_minute,
              'bsf_rt_post_types'     => $bsf_rt_post_types,
              'bsf_rt_include_comments' => $bsf_rt_include_comments,
              'bsf_rt_include_images' => $bsf_rt_include_images,

            );
            update_option('bsf_rt_general_settings', $update_options);
            
            update_option('bsf_rt_saved_msg','ok');
        } else if (isset( $_POST['bsf-rt-reading'] ) && wp_verify_nonce( $_POST['bsf-rt-reading'], 'bsf-rt-nonce-reading' )) {

                if (isset($_POST['bsf_rt_reading_time_prefix_label'])) {
                    $bsf_rt_reading_time_label = $_POST['bsf_rt_reading_time_prefix_label'];
                } else {
                    $bsf_rt_reading_time_label = '';
                }

                if (isset($_POST['bsf_rt_reading_time_postfix_label'])) {
                    $bsf_rt_reading_time_postfix_label = $_POST['bsf_rt_reading_time_postfix_label'];
                } else {
                    $bsf_rt_reading_time_postfix_label = '';
                }

                if (isset($_POST['bsf_rt_show_read_time'])) {

                    $bsf_rt_show_read_time = $_POST['bsf_rt_show_read_time'];
                } else {

                    $bsf_rt_show_read_time = array();
                }
                if (isset($_POST['bsf_rt_read_time_font_size'])) {

                    $bsf_rt_read_time_font_size = $_POST['bsf_rt_read_time_font_size'];
                } else {

                    $bsf_rt_read_time_font_size = 15;
                }
                if (isset($_POST['bsf_rt_read_time_margin_top']) && $_POST['bsf_rt_read_time_margin_top'] !== '') {

                    $bsf_rt_read_time_margin_top = $_POST['bsf_rt_read_time_margin_top'];
                } else {

                    $bsf_rt_read_time_margin_top = 5;
                }
                if (isset($_POST['bsf_rt_read_time_margin_right']) && $_POST['bsf_rt_read_time_margin_right'] !== '') {

                    $bsf_rt_read_time_margin_right = $_POST['bsf_rt_read_time_margin_right'];
                } else {

                    $bsf_rt_read_time_margin_right = 0;
                }
                if (isset($_POST['bsf_rt_read_time_margin_bottom']) && $_POST['bsf_rt_read_time_margin_bottom'] !== '') {

                    $bsf_rt_read_time_margin_bottom = $_POST['bsf_rt_read_time_margin_bottom'];
                } else {

                    $bsf_rt_read_time_margin_bottom = 5;
                }
                if (isset($_POST['bsf_rt_read_time_margin_left']) && $_POST['bsf_rt_read_time_margin_left'] !== '') {

                    $bsf_rt_read_time_margin_left = $_POST['bsf_rt_read_time_margin_left'];
                } else {

                    $bsf_rt_read_time_margin_left = 0;
                }
                if (isset($_POST['bsf_rt_read_time_padding_top']) && $_POST['bsf_rt_read_time_padding_top'] !== '') {

                    $bsf_rt_read_time_padding_top =  $_POST['bsf_rt_read_time_padding_top'];
                } else {

                    $bsf_rt_read_time_padding_top = 0.5;
                }
                if (isset($_POST['bsf_rt_read_time_padding_right']) && $_POST['bsf_rt_read_time_padding_right'] !== '') {

                    $bsf_rt_read_time_padding_right =  $_POST['bsf_rt_read_time_padding_right'];
                } else {

                    $bsf_rt_read_time_padding_right = 0.7;
                }
                if (isset($_POST['bsf_rt_read_time_padding_bottom']) && $_POST['bsf_rt_read_time_padding_bottom'] !== '') {

                    $bsf_rt_read_time_padding_bottom =  $_POST['bsf_rt_read_time_padding_bottom'];
                } else {

                    $bsf_rt_read_time_padding_bottom = 0.5;
                }
                if (isset($_POST['bsf_rt_read_time_padding_left']) && $_POST['bsf_rt_read_time_padding_left'] !== '') {

                    $bsf_rt_read_time_padding_left =  $_POST['bsf_rt_read_time_padding_left'];
                } else {

                    $bsf_rt_read_time_padding_left = 0.7;
                }
                 
                 
                $bsf_rt_position_of_read_time=$_POST['bsf_rt_position_of_read_time'];

                $bsf_rt_read_time_background_color=$_POST['bsf_rt_read_time_background_color'];

                $bsf_rt_read_time_color=$_POST['bsf_rt_read_time_color'];

                $bsf_rt_padding_unit=$_POST['bsf_rt_padding_unit'];

                $bsf_rt_margin_unit=$_POST['bsf_rt_margin_unit'];

                $update_options = array(
                      'bsf_rt_reading_time_label'=> $bsf_rt_reading_time_label,
                      'bsf_rt_reading_time_postfix_label'=> $bsf_rt_reading_time_postfix_label,
                      'bsf_rt_position_of_read_time' => $bsf_rt_position_of_read_time,
                      'bsf_rt_show_read_time' => $bsf_rt_show_read_time,
                      'bsf_rt_position_of_read_time' => $bsf_rt_position_of_read_time,
                      'bsf_rt_read_time_background_color' => $bsf_rt_read_time_background_color,
                      'bsf_rt_read_time_color' => $bsf_rt_read_time_color,
                      'bsf_rt_read_time_font_size' => $bsf_rt_read_time_font_size,
                      'bsf_rt_read_time_margin_top' => $bsf_rt_read_time_margin_top,
                      'bsf_rt_read_time_margin_right' => $bsf_rt_read_time_margin_right,
                      'bsf_rt_read_time_margin_bottom' => $bsf_rt_read_time_margin_bottom,
                      'bsf_rt_read_time_margin_left' => $bsf_rt_read_time_margin_left,
                      'bsf_rt_read_time_padding_top' => $bsf_rt_read_time_padding_top,
                      'bsf_rt_read_time_padding_right' => $bsf_rt_read_time_padding_right,
                      'bsf_rt_read_time_padding_bottom' => $bsf_rt_read_time_padding_bottom,
                      'bsf_rt_read_time_padding_left' => $bsf_rt_read_time_padding_left,
                      'bsf_rt_padding_unit' => $bsf_rt_padding_unit,
                      'bsf_rt_margin_unit' => $bsf_rt_margin_unit,
                );

                update_option('bsf_rt_read_time_settings', $update_options);
                update_option('bsf_rt_saved_msg','ok');
        } else if (isset( $_POST['bsf-rt-progress'] ) && wp_verify_nonce( $_POST['bsf-rt-progress'], 'bsf-rt-nonce-progress' )) {


                $site_url=site_url();

                $bsf_rt_position_of_progress_bar=$_POST['bsf_rt_position_of_progress_bar'];

                $bsf_rt_progress_bar_background_color=$_POST['bsf_rt_progress_bar_background_color'];

                $bsf_rt_progress_bar_thickness=$_POST['bsf_rt_progress_bar_thickness'];

                $bsf_rt_progress_bar_styles=$_POST['bsf_rt_progress_bar_styles'];

                $bsf_rt_progress_bar_gradiant_one=$_POST['bsf_rt_progress_bar_color_g1'];

                $bsf_rt_progress_bar_gradiant_two=$_POST['bsf_rt_progress_bar_color_g2'];

                $update_options = array(
                      'bsf_rt_position_of_progress_bar' => $bsf_rt_position_of_progress_bar,
                      'bsf_rt_progress_bar_styles' => $bsf_rt_progress_bar_styles,
                      'bsf_rt_progress_bar_background_color' => $bsf_rt_progress_bar_background_color,
                      'bsf_rt_progress_bar_gradiant_one'=>$bsf_rt_progress_bar_gradiant_one,
                      'bsf_rt_progress_bar_gradiant_two'=>$bsf_rt_progress_bar_gradiant_two,
                      'bsf_rt_progress_bar_thickness' => $bsf_rt_progress_bar_thickness,
                       );

                update_option('bsf_rt_progress_bar_settings', $update_options);
                update_option('bsf_rt_saved_msg','ok');

            }
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
