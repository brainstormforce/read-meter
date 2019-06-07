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

if ( ! class_exists( 'BSF_RT_Loader' ) ) :
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
	class BSF_RT_Loader {

		private static $instance;
		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		/**
		 * Constructor
		 */
		public function __construct() {
			 add_action( 'wp_enqueue_scripts', array( $this, 'bsfrt_pluginstyle_frontend' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'bsfrt_pluginstyle_dashboard' ) );

			add_action( 'init', array( $this, 'bsf_rt_process_form_general_settings' ) );

			add_action( 'init', array( $this, 'bsf_rt_process_form_read_time_settings' ) );

			add_action( 'init', array( $this, 'bsf_rt_process_form_progress_bar_settings' ) );

		}

		public function bsf_rt_process_form_general_settings() {

			require_once BSF_RT_ABSPATH . 'includes/bsf-rt-page.php';

			$page = isset( $_GET['page'] ) ? $_GET['page'] : null;

			if ( 'bsf_rt' !== $page ) {
				return;
			}
			if ( isset( $_POST['bsf-rt-general'] ) && wp_verify_nonce( $_POST['bsf-rt-general'], 'bsf-rt-nonce-general' ) ) {

				$bsf_rt_words_per_minute = (!empty( $_POST['bsf_rt_words_per_minute'] ) ? $_POST['bsf_rt_words_per_minute'] : '' );

				$bsf_rt_post_types = (!empty( $_POST['posts'] ) ? $_POST['posts'] : array() );

				$bsf_rt_include_images = (!empty( $_POST['bsf_rt_include_images'] ) ? $_POST['bsf_rt_include_images'] : '' );

				$bsf_rt_include_comments = (!empty( $_POST['bsf_rt_include_comments'] ) ? $_POST['bsf_rt_include_comments'] : '' );

				$update_options = array(
					'bsf_rt_words_per_minute' => $bsf_rt_words_per_minute,
					'bsf_rt_post_types'       => $bsf_rt_post_types,
					'bsf_rt_include_comments' => $bsf_rt_include_comments,
					'bsf_rt_include_images'   => $bsf_rt_include_images,

				);
				update_option( 'bsf_rt_general_settings', $update_options );

				update_option( 'bsf_rt_saved_msg', 'ok' );
			}
		}
		public function bsf_rt_process_form_read_time_settings() {

			$page = isset( $_GET['page'] ) ? $_GET['page'] : null;

			if ( 'bsf_rt' !== $page ) {
				return;
			}
			if ( isset( $_POST['bsf-rt-reading'] ) && wp_verify_nonce( $_POST['bsf-rt-reading'], 'bsf-rt-nonce-reading' ) ) {
				
				$bsf_rt_position_of_read_time = $_POST['bsf_rt_position_of_read_time'];
				$bsf_rt_read_time_background_color = $_POST['bsf_rt_read_time_background_color'];
				$bsf_rt_read_time_color = $_POST['bsf_rt_read_time_color'];
				$bsf_rt_padding_unit = $_POST['bsf_rt_padding_unit'];
				$bsf_rt_margin_unit = $_POST['bsf_rt_margin_unit'];
				
				$bsf_rt_reading_time_label = (!empty( $_POST['bsf_rt_reading_time_prefix_label'] ) ? sanitize_text_field($_POST['bsf_rt_reading_time_prefix_label']) : '' );

				$bsf_rt_reading_time_postfix_label = (!empty( $_POST['bsf_rt_reading_time_postfix_label'] ) ? sanitize_text_field($_POST['bsf_rt_reading_time_postfix_label']) : '' );

				$bsf_rt_show_read_time = (!empty($_POST['bsf_rt_show_read_time'] ) ? $_POST['bsf_rt_show_read_time'] : array() );

				$bsf_rt_read_time_font_size = (!empty( $_POST['bsf_rt_read_time_font_size'] ) ? $_POST['bsf_rt_read_time_font_size'] : 15 );

				$bsf_rt_read_time_margin_top = (!empty( $_POST['bsf_rt_read_time_margin_top'] ) ? $_POST['bsf_rt_read_time_margin_top'] : 5 );

				$bsf_rt_read_time_margin_right = (!empty( $_POST['bsf_rt_read_time_margin_right'] ) ? $_POST['bsf_rt_read_time_margin_right'] : 0 );

				$bsf_rt_read_time_margin_bottom = (!empty( $_POST['bsf_rt_read_time_margin_bottom'] ) ? $_POST['bsf_rt_read_time_margin_bottom'] : 5 );

				$bsf_rt_read_time_margin_left = (!empty( $_POST['bsf_rt_read_time_margin_left'] ) ? $_POST['bsf_rt_read_time_margin_left'] : 0 );

				$bsf_rt_read_time_padding_top = (!empty( $_POST['bsf_rt_read_time_padding_top'] ) ? $_POST['bsf_rt_read_time_padding_top'] : 0.5 );

				$bsf_rt_read_time_padding_right = (!empty( $_POST['bsf_rt_read_time_padding_right'] ) ? $_POST['bsf_rt_read_time_padding_right'] : 0.7 );

				$bsf_rt_read_time_padding_bottom = (!empty( $_POST['bsf_rt_read_time_padding_bottom'] ) ? $_POST['bsf_rt_read_time_padding_bottom'] : 0.5 );

				$bsf_rt_read_time_padding_left = (!empty( $_POST['bsf_rt_read_time_padding_left'] ) ? $_POST['bsf_rt_read_time_padding_left'] : 0.7 );

				$update_options = array(
					'bsf_rt_reading_time_label'         => $bsf_rt_reading_time_label,
					'bsf_rt_reading_time_postfix_label' => $bsf_rt_reading_time_postfix_label,
					'bsf_rt_position_of_read_time'      => $bsf_rt_position_of_read_time,
					'bsf_rt_show_read_time'             => $bsf_rt_show_read_time,
					'bsf_rt_position_of_read_time'      => $bsf_rt_position_of_read_time,
					'bsf_rt_read_time_background_color' => $bsf_rt_read_time_background_color,
					'bsf_rt_read_time_color'            => $bsf_rt_read_time_color,
					'bsf_rt_read_time_font_size'        => $bsf_rt_read_time_font_size,
					'bsf_rt_read_time_margin_top'       => $bsf_rt_read_time_margin_top,
					'bsf_rt_read_time_margin_right'     => $bsf_rt_read_time_margin_right,
					'bsf_rt_read_time_margin_bottom'    => $bsf_rt_read_time_margin_bottom,
					'bsf_rt_read_time_margin_left'      => $bsf_rt_read_time_margin_left,
					'bsf_rt_read_time_padding_top'      => $bsf_rt_read_time_padding_top,
					'bsf_rt_read_time_padding_right'    => $bsf_rt_read_time_padding_right,
					'bsf_rt_read_time_padding_bottom'   => $bsf_rt_read_time_padding_bottom,
					'bsf_rt_read_time_padding_left'     => $bsf_rt_read_time_padding_left,
					'bsf_rt_padding_unit'               => $bsf_rt_padding_unit,
					'bsf_rt_margin_unit'                => $bsf_rt_margin_unit,
				);

				update_option( 'bsf_rt_read_time_settings', $update_options );
				update_option( 'bsf_rt_saved_msg', 'ok' );

			}
		}
		public function bsf_rt_process_form_progress_bar_settings() {

			$page = isset( $_GET['page'] ) ? $_GET['page'] : null;

			if ( 'bsf_rt' !== $page ) {
				return;
			}
			if ( isset( $_POST['bsf-rt-progress'] ) && wp_verify_nonce( $_POST['bsf-rt-progress'], 'bsf-rt-nonce-progress' ) ) {

				$bsf_rt_position_of_progress_bar = $_POST['bsf_rt_position_of_progress_bar'];

				$bsf_rt_progress_bar_background_color = $_POST['bsf_rt_progress_bar_background_color'];

				$bsf_rt_progress_bar_thickness = $_POST['bsf_rt_progress_bar_thickness'];

				$bsf_rt_progress_bar_styles = $_POST['bsf_rt_progress_bar_styles'];

				$bsf_rt_progress_bar_gradiant_one = $_POST['bsf_rt_progress_bar_color_g1'];

				$bsf_rt_progress_bar_gradiant_two = $_POST['bsf_rt_progress_bar_color_g2'];

				$update_options = array(
					'bsf_rt_position_of_progress_bar'      => $bsf_rt_position_of_progress_bar,
					'bsf_rt_progress_bar_styles'           => $bsf_rt_progress_bar_styles,
					'bsf_rt_progress_bar_background_color' => $bsf_rt_progress_bar_background_color,
					'bsf_rt_progress_bar_gradiant_one'     => $bsf_rt_progress_bar_gradiant_one,
					'bsf_rt_progress_bar_gradiant_two'     => $bsf_rt_progress_bar_gradiant_two,
					'bsf_rt_progress_bar_thickness'        => $bsf_rt_progress_bar_thickness,
				);

				update_option( 'bsf_rt_progress_bar_settings', $update_options );
				update_option( 'bsf_rt_saved_msg', 'ok' );

			}
		}


		/**
		 * Plugin Styles for frontend.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function bsfrt_pluginstyle_frontend() {
			wp_enqueue_style( 'bsfrt_frontend', BSF_RT_PLUGIN_URL . '/assets/css/bsfrt-frontend-css.css' );

			wp_enqueue_script( 'bsfrt_frontend', BSF_RT_PLUGIN_URL . '/assets/js/bsf-rt-frontend.js' );
		}
		/**
		 * Plugin Styles for admin dashboard.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function bsfrt_pluginstyle_dashboard() {
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_style( 'bsfrt_dashboard', BSF_RT_PLUGIN_URL . '/assets/css/bsfrt-admin-dashboard-css.css', 999 );

			wp_enqueue_script( 'bsfrt_backend', BSF_RT_PLUGIN_URL . '/assets/js/bsf-rt-backend.js' );

			wp_enqueue_script( 'colorpickerscript', BSF_RT_PLUGIN_URL . '/assets/js/color-picker.js', array( 'jquery', 'wp-color-picker' ), null, true );
		}
	}
	BSF_RT_Loader::get_instance();
endif;

