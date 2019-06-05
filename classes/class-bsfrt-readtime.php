<?php
/**
 * Class for calculating reading time.
 *
 * The class that contains all functions for calculating reading time.
 *
 * @since 1.0.0
 */
class BSF_ReadTime {

	/**
	 * Member Variable
	 *
	 * @var instance
	 */
	private static $instance;

	public $reading_time;

	public $bsf_rt_options = array();

	public static $bsf_rt_is_admin_bar_showing;

	public static $bsf_rt_check_the_page;

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
	 * Construct function for Read Meter.
	 *
	 * Create default settings on plugin activation.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->bsf_rt_init_backend();

		add_action( 'wp_enqueue_scripts', array( $this, 'bsf_rt_init_frontend' ) );

		// Shortcode
		add_shortcode( 'read_meter', array( $this, 'read_meter_shortcode' ) );

		add_filter( 'comments_template', array( $this, 'bsf_rt_remove_the_title_from_comments' ) );
	}

	public function bsf_rt_init_backend() {
		 $bsf_rt_show_read_time = array( 'bsf_rt_single_page' );

		$bsf_rt_posts = array( 'post' );

		$bsf_rt_show_read_time = array( 'bsf_rt_single_page' );

		$default_options_general = array(
			'bsf_rt_words_per_minute' => '275',
			'bsf_rt_post_types'       => $bsf_rt_posts,
		);
		add_option( 'bsf_rt_general_settings', $default_options_general );

		$default_options_readtime = array(
			'bsf_rt_show_read_time'             => $bsf_rt_show_read_time,
			'bsf_rt_reading_time_label'         => 'Reading Time',
			'bsf_rt_reading_time_postfix_label' => 'mins',
			'bsf_rt_words_per_minute'           => '275',
			'bsf_rt_position_of_read_time'      => 'above_the_content',
			'bsf_rt_read_time_background_color' => '#eeeeee',
			'bsf_rt_read_time_color'            => '#333333',
			'bsf_rt_read_time_font_size'        => 15,
			'bsf_rt_read_time_margin_top'       => 1,
			'bsf_rt_read_time_margin_right'     => 1,
			'bsf_rt_read_time_margin_bottom'    => 1,
			'bsf_rt_read_time_margin_left'      => 1,
			'bsf_rt_read_time_padding_top'      => 0.5,
			'bsf_rt_read_time_padding_right'    => 0.7,
			'bsf_rt_read_time_padding_bottom'   => 0.5,
			'bsf_rt_read_time_padding_left'     => 0.7,
			'bsf_rt_padding_unit'               => 'em',
			'bsf_rt_margin_unit'                => 'px',
		);
		add_option( 'bsf_rt_read_time_settings', $default_options_readtime );

		$default_options_progressbar = array(
			'bsf_rt_position_of_progress_bar' => 'none',
		);
		add_option( 'bsf_rt_progress_bar_settings', $default_options_progressbar );

		$bsf_rt_general_settings = get_option( 'bsf_rt_general_settings' );

		$bsf_rt_read_time_settings = get_option( 'bsf_rt_read_time_settings' );

		$bsf_rt_progress_bar_settings = get_option( 'bsf_rt_progress_bar_settings' );

		if ( isset( $bsf_rt_general_settings ) && $bsf_rt_read_time_settings !== '' && isset( $bsf_rt_progress_bar_settings ) ) {
				$all_options = array_merge( $bsf_rt_general_settings, $bsf_rt_read_time_settings );
				$all_options = array_merge( $all_options, $bsf_rt_progress_bar_settings );
		}
		$this->bsf_rt_options = $all_options;

		add_action( 'init', array( $this, 'bsf_rt_is_admin_bar_showing' ) );
	}

	public function bsf_rt_init_frontend() {
		if ( isset( $this->bsf_rt_options['bsf_rt_include_comments'] ) && $this->bsf_rt_options['bsf_rt_include_comments'] == 'yes' ) {
			if ( get_comments_number() !== '0' ) {
					add_filter(
						'comments_template',
						function( $template ) {
							echo '<div id="bsf-rt-comments"></div>';
							return $template;
						}
					);
			} else {
				add_filter( 'the_content', array( $this, 'bsf_rt_add_marker_for_progress_bar_scroll' ), 90 );
			}
		} else {
			add_filter( 'the_content', array( $this, 'bsf_rt_add_marker_for_progress_bar_scroll' ), 90 );
		}
		if ( isset( $this->bsf_rt_options['bsf_rt_show_read_time'] ) && $this->bsf_rt_options['bsf_rt_position_of_read_time'] !== 'none' ) {

			if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'above_the_content' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
				// Read time styles
				if ( isset( $this->bsf_rt_options['bsf_rt_read_time_margin_top'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_margin_right'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_margin_bottom'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_margin_left'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_padding_top'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_padding_right'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_padding_bottom'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_padding_left'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_font_size'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_color'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_background_color'] ) && isset( $this->bsf_rt_options['bsf_rt_padding_unit'] ) && isset( $this->bsf_rt_options['bsf_rt_margin_unit'] ) ) {

					add_action( 'wp_head', array( $this, 'bsf_rt_set_readtime_styles_content' ) );

				}
			} elseif ( isset( $this->bsf_rt_options['bsf_rt_read_time_margin_top'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_margin_right'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_margin_bottom'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_margin_left'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_padding_top'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_padding_right'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_padding_bottom'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_padding_left'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_font_size'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_color'] ) && isset( $this->bsf_rt_options['bsf_rt_read_time_background_color'] ) && isset( $this->bsf_rt_options['bsf_rt_padding_unit'] ) && isset( $this->bsf_rt_options['bsf_rt_margin_unit'] ) ) {

				add_action( 'wp_head', array( $this, 'bsf_rt_set_readtime_styles' ) );
			}
		}

		// For twenty fifteen Theme remove the extra markup in the nextpost and prev post section
		$bsf_rt_current_theme = $this->bsf_rt_get_current_theme();

		if ( $bsf_rt_current_theme === 'Twenty Fifteen' ) {
			add_filter( 'next_post_link', array( $this, 'bsf_rt_remove_markup_for_twenty_fifteen' ) );
			add_filter( 'previous_post_link', array( $this, 'bsf_rt_remove_markup_for_twenty_fifteen' ) );
		}

		// Show Reading time Conditions
		if ( isset( $this->bsf_rt_options['bsf_rt_show_read_time'] ) && $this->bsf_rt_options['bsf_rt_position_of_read_time'] !== 'none' ) {
			if ( in_array( 'bsf_rt_single_page', $this->bsf_rt_options['bsf_rt_show_read_time'] ) && is_singular() ) {

				if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'above_the_content' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {

					add_filter( 'the_content', array( $this, 'bsf_rt_add_reading_time_before_content' ), 90 );
				}
				if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'above_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {

					add_filter( 'the_title', array( $this, 'bsf_rt_add_reading_time_above_the_post_title' ), 90, 2 );
				}
				if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'below_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {

					add_filter( 'the_title', array( $this, 'bsf_rt_add_reading_time_below_the_post_title' ), 90 );
				}
			}
			if ( in_array( 'bsf_rt_home_blog_page', $this->bsf_rt_options['bsf_rt_show_read_time'] ) && is_home() && ! is_archive() ) {

				if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'above_the_content' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {

					add_filter( 'get_the_excerpt', array( $this, 'bsf_rt_add_reading_time_before_content_excerpt' ), 1000 );
					if ( $bsf_rt_current_theme === 'Twenty Fifteen' || $bsf_rt_current_theme === 'Twenty Nineteen' || $bsf_rt_current_theme === 'Twenty Thirteen' || $bsf_rt_current_theme === 'Twenty Fourteen' || $bsf_rt_current_theme === 'Twenty Sixteen' || $bsf_rt_current_theme === 'Twenty Seventeen' || $bsf_rt_current_theme === 'Twenty Twelve' ) {
						add_filter( 'the_content', array( $this, 'bsf_rt_add_reading_time_before_content_excerpt' ), 1000 );
					}
				}
				if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'above_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {

					add_filter( 'the_title', array( $this, 'bsf_rt_add_reading_time_before_title_excerpt' ), 1000 );
				}
				if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'below_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {

					add_filter( 'the_title', array( $this, 'bsf_rt_add_reading_time_after_title_excerpt' ), 1000 );
				}
			}
			if ( in_array( 'bsf_rt_archive_page', $this->bsf_rt_options['bsf_rt_show_read_time'] ) && ! is_home() && is_archive() ) {

				if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'above_the_content' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {

					add_filter( 'get_the_excerpt', array( $this, 'bsf_rt_add_reading_time_before_content_archive' ), 1000 );

					if ( $bsf_rt_current_theme === 'Twenty Fifteen' || $bsf_rt_current_theme === 'Twenty Nineteen' ) {
						add_filter( 'the_content', array( $this, 'bsf_rt_add_reading_time_before_content_archive' ), 1000 );
					}
				}
				if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'above_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {

					add_filter( 'the_title', array( $this, 'bsf_rt_add_reading_time_before_title_archive' ), 1000 );
				}
				if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'below_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {

					add_filter( 'the_title', array( $this, 'bsf_rt_add_reading_time_after_title_archive' ), 1000 );
				}
			}
		}
			// Displaying Progress Bar Conditions
		if ( isset( $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) && ( 'none' === $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) ) {

			 return;

		} elseif ( isset( $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) && ( 'top_of_the_page' === $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) ) {

			add_action( 'wp_footer', array( $this, 'hook_header_top' ) );

		} elseif ( isset( $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) && ( 'bottom_of_the_page' === $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) ) {

			add_action( 'wp_footer', array( $this, 'hook_header_bottom' ) );

		}

		if ( isset( $this->bsf_rt_options['bsf_rt_progress_bar_styles'] ) && ( 'Normal' === $this->bsf_rt_options['bsf_rt_progress_bar_styles'] ) ) {

			if ( isset( $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one'] ) && isset( $this->bsf_rt_options['bsf_rt_progress_bar_background_color'] ) && isset( $this->bsf_rt_options['bsf_rt_progress_bar_thickness'] ) ) {

				add_action( 'wp_head', array( $this, 'bsf_rt_set_progressbar_colors_normal' ) );
			}
		} elseif ( isset( $this->bsf_rt_options['bsf_rt_progress_bar_styles'] ) && ( 'Gradient' === $this->bsf_rt_options['bsf_rt_progress_bar_styles'] ) ) {

			if ( isset( $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one'] ) && isset( $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_two'] ) && isset( $this->bsf_rt_options['bsf_rt_progress_bar_background_color'] ) && isset( $this->bsf_rt_options['bsf_rt_progress_bar_thickness'] ) ) {

				  add_action( 'wp_head', array( $this, 'bsf_rt_set_progressbar_colors_gradient' ) );
			}
		}
	}
	/**
	 * Adds the reading time before the_content.
	 *
	 * If the options is selected to automatically add the reading time before
	 * the_content, the reading time is calculated and added to the beginning of the_content.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $content The original post content.
	 * @return string The post content with reading time prepended.
	 */
	public function bsf_rt_add_reading_time_before_content( $content ) {
		if ( in_the_loop() && is_singular() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

					return $content;
			}

			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				return $content;
			}

			$original_content = $content;

			$bsf_rt_post = get_the_ID();

			$post_meta = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$previous_word_count = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

			$label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
			$postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

			if ( $this->reading_time > 1 ) {

				$calculated_postfix = $postfix;

			} else {

				$calculated_postfix = 'mins';
			}

			$content      = '<span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span>';
				$content .= $original_content;
				return $content;
		} else {

			return $content;
		}
	}
	/**
	 * Adds the reading time above the post title.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $content The original post content.
	 * @return string The post content with reading time prepended.
	 */
	public function bsf_rt_add_reading_time_above_the_post_title( $title ) {
		if ( in_the_loop() && is_singular() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

				return $title;

			}
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {

					 return $title;
			}
			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				  return $title;
			}

			$original_title = $title;

			$bsf_rt_post = get_the_ID();

			$post_meta = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$previous_word_count = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

			$label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
			$postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

			if ( $this->reading_time > 1 ) {

				$calculated_postfix = $postfix;

			} else {

				$calculated_postfix = 'mins';
			}

			$title = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><!-- .bsf_rt_reading_time_before_content -->';

			$title .= $original_title;

			return $title;

		} else {

			return $title;
		}

	}
	/**
	 * Adds the reading time below the post title.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $content The original post content.
	 * @return string The post content with reading time prepended.
	 */
	public function bsf_rt_add_reading_time_below_the_post_title( $title ) {
		if ( in_the_loop() && is_singular() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

				return $title;
			}
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {

					return $title;
			}
			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				  return $title;
			}

			$original_title = $title;

			$bsf_rt_post = get_the_ID();

			$post_meta = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$previous_word_count = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

			$label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
			$postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

			if ( $this->reading_time > 1 ) {

				$calculated_postfix = $postfix;

			} else {

				$calculated_postfix = 'mins';
			}

			$title = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><!-- .bsf_rt_reading_time_before_content -->';

			$original_title .= $title;

			$title = $original_title;

			return $title;

		} else {

			return $title;
		}

	}
	/**
	 * Adds the reading time before the_excerpt content.
	 *
	 * If the options is selected to automatically add the reading time before
	 * the_excerpt, the reading time is calculated and added to the beginning of the_excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $content The original content of the_excerpt.
	 * @return string The excerpt content with reading time prepended.
	 */
	public function bsf_rt_add_reading_time_before_content_excerpt( $excerpt ) {
		if ( in_the_loop() && is_home() && ! is_archive() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

				return $excerpt;
			}
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {

				return $excerpt;
			}
			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				 return $excerpt;
			}

			$original_excerpt = $excerpt;

			$bsf_rt_post = get_the_ID();

			$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

			$label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
			$postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

			if ( $this->reading_time > 1 ) {

				$calculated_postfix = $postfix;

			} else {

				$calculated_postfix = 'mins';
			}

			$excerpt = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span>';

			$excerpt .= $original_excerpt;

			echo $excerpt;

		} else {

			echo $excerpt;
		}
	}
	 /**
	  * Adds the reading time before the_excerpt title.
	  *
	  * If the options is selected to automatically add the reading time before
	  * the_excerpt, the reading time is calculated and added to the beginning of the_excerpt.
	  *
	  * @since 1.0.0
	  *
	  * @param  string $title The original content of the_excerpt.
	  * @return string The excerpt content with reading time prepended.
	  */
	public function bsf_rt_add_reading_time_before_title_excerpt( $title ) {
		if ( in_the_loop() && is_home() && ! is_archive() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

				return $title;

			}
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {

				   return $title;
			}
			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				  return $title;

			}

			$original_title = $title;

			$bsf_rt_post = get_the_ID();

			$post_meta = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$previous_word_count = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

			$label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
			$postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

			if ( $this->reading_time > 1 ) {

				$calculated_postfix = $postfix;

			} else {

				$calculated_postfix = 'mins';
			}

			$title = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span>';

			$title .= $original_title;

			return $title;
		} else {

			return $title;
		}
	}
	/**
	 * Adds the reading time after the_excerpt title.
	 *
	 * If the options is selected to automatically add the reading time before
	 * the_excerpt, the reading time is calculated and added to the beginning of the_excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $title The original content of the_excerpt.
	 * @return string The excerpt content with reading time prepended.
	 */
	public function bsf_rt_add_reading_time_after_title_excerpt( $title ) {
		if ( in_the_loop() && is_home() && ! is_archive() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

				return $title;
			}
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {

				return $title;
			}
			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				  return $title;
			}

			$original_title = $title;

			$bsf_rt_post = get_the_ID();

			$post_meta = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$previous_word_count = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

			$label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
			$postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

			if ( $this->reading_time > 1 ) {

				$calculated_postfix = $postfix;

			} else {

				$calculated_postfix = 'mins';
			}

			$title = ' 
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span>';

			$original_title .= $title;

			$title = $original_title;

			return $title;
		} else {

			return $title;
		}
	}
	/**
	 * Adds the reading time before the archive excerpt.
	 *
	 * If the options is selected to automatically add the reading time before
	 * the_excerpt, the reading time is calculated and added to the beginning of the_excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $excerpt The original content of the_excerpt.
	 * @return string The excerpt content with reading time prepended.
	 */
	public function bsf_rt_add_reading_time_before_content_archive( $excerpt ) {
		if ( in_the_loop() && is_archive() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

					return $excerpt;
			}
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {

				return $excerpt;
			}
			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				return $excerpt;
			}

			$original_excerpt = $excerpt;

			$bsf_rt_post = get_the_ID();

			$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

			$label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
			$postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

			if ( $this->reading_time > 1 ) {

				$calculated_postfix = $postfix;
			} else {

				$calculated_postfix = 'mins';
			}

			$excerpt = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span>';

			$excerpt .= $original_excerpt;

			echo $excerpt;

		} else {

			echo $excerpt;
		}
	}
	 /**
	  * Adds the reading time before the archive title.
	  *
	  * If the options is selected to automatically add the reading time before
	  * the_excerpt, the reading time is calculated and added to the beginning of the_excerpt.
	  *
	  * @since 1.0.0
	  *
	  * @param  string $title The original content of the_excerpt.
	  * @return string The excerpt content with reading time prepended.
	  */
	public function bsf_rt_add_reading_time_before_title_archive( $title ) {
		if ( in_the_loop() && is_archive() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

				return $title;

			}
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {

					return $title;
			}
			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				  return $title;

			}

			$original_title = $title;

			$bsf_rt_post = get_the_ID();

			$post_meta = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$previous_word_count = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

			$label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
			$postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

			if ( $this->reading_time > 1 ) {

				$calculated_postfix = $postfix;

			} else {

				$calculated_postfix = 'mins';
			}

			$title = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span>';

			$title .= $original_title;

			return $title;

		} else {

			return $title;
		}

	}
	/**
	 * Adds the reading time after the archive title.
	 *
	 * If the options is selected to automatically add the reading time before
	 * the_excerpt, the reading time is calculated and added to the beginning of the_excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $title The original content of the_excerpt.
	 * @return string The excerpt content with reading time prepended.
	 */
	public function bsf_rt_add_reading_time_after_title_archive( $title ) {
		if ( in_the_loop() && is_archive() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

				return $title;
			}
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {

				return $title;
			}
			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				  return $title;
			}

			$original_title = $title;

			$bsf_rt_post = get_the_ID();

			$post_meta = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$previous_word_count = get_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', true );

			$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

			$label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
			$postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

			if ( $this->reading_time > 1 ) {

				$calculated_postfix = $postfix;

			} else {

				$calculated_postfix = 'mins';
			}

			$title = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span>';

			$original_title .= $title;

			$title = $original_title;

			return $title;

		} else {

			return $title;
		}
	}

	/**
	 * Calculate the reading time of a post.
	 *
	 * Gets the post content, counts the images, strips shortcodes, and strips tags.
	 * Then counds the words. Converts images into a word count. And outputs the
	 * total reading time.
	 *
	 * @since 1.0.0
	 *
	 * @param  int   $rt_post_id The Post ID.
	 * @param  array $rt_options The options selected for the plugin.
	 * @return string|int The total reading time for the article or string if it's 0.
	 */
	public function bsf_rt_calculate_reading_time( $bsf_rt_post, $bsf_rt_options ) {
		$bsf_rt_current_post_type = get_post_type();

		if ( $bsf_rt_current_post_type == 'post' ) {

			if ( in_the_loop() && is_singular() ) {

				$args = array(

					'post_id' => $bsf_rt_post, // use post_id, not post_ID

				);
				$comments = get_comments( $args );

				$comment_string = '';

				foreach ( $comments as $comment ) {

					$comment_string = $comment_string . ' ' . $comment->comment_content;
				}

				$comment_word_count = ( count( preg_split( '/\s+/', $comment_string ) ) );

			} else {

				$comment_word_count = 0;
			}
		} else {

			$comment_word_count = 0;
		}

		$bsf_rt_content = get_post_field( 'post_content', $bsf_rt_post );

		$number_of_images = substr_count( strtolower( $bsf_rt_content ), '<img ' );

		if ( ! isset( $this->bsf_rt_options['include_shortcodes'] ) ) {

			$bsf_rt_content = strip_shortcodes( $bsf_rt_content );
		}

		$bsf_rt_content = wp_strip_all_tags( $bsf_rt_content );

		$word_count = count( preg_split( '/\s+/', $bsf_rt_content ) );

		if ( isset( $this->bsf_rt_options['bsf_rt_include_comments'] ) && $this->bsf_rt_options['bsf_rt_include_comments'] == 'yes' ) {

			$word_count += $comment_word_count;
		}

		// Calculate additional time added to post by images.
		$additional_words_for_images = $this->bsf_rt_calculate_images( $number_of_images, $this->bsf_rt_options['bsf_rt_words_per_minute'] );

		if ( isset( $this->bsf_rt_options['bsf_rt_include_images'] ) && $this->bsf_rt_options['bsf_rt_include_images'] == 'yes' ) {

			 $word_count += $additional_words_for_images;
		}

		$this->reading_time = ceil( $word_count / $this->bsf_rt_options['bsf_rt_words_per_minute'] );

		// If the reading time is 0 then return it as < 1 instead of 0.
		if ( 1 > $this->reading_time ) {

			$this->reading_time = '< 1';
		}

		 update_post_meta( $bsf_rt_post, 'bsf_rt_reading_time', $this->reading_time );
		 update_post_meta( $bsf_rt_post, 'bsf_rt_word_count', $word_count );

		return $this->reading_time;
	}

	/**
	 * Adds additional reading time for images
	 *
	 * Calculate additional reading time added by images in posts. Based on calculations by Medium. https://blog.medium.com/read-time-and-you-bc2048ab620c
	 *
	 * @since 1.1.0
	 *
	 * @param  int   $total_images            number of images in post.
	 * @param  array $bsf_rt_words_per_minute words per minute.
	 * @return int  Additional time added to the reading time by images.
	 */
	public function bsf_rt_calculate_images( $total_images, $bsf_rt_words_per_minute ) {
			$additional_time = 0;

			// For the first image add 12 seconds, second image add 11, ..., for image 10+ add 3 seconds.

		for ( $i = 1; $i <= $total_images; $i++ ) {
			if ( $i >= 10 ) {

				$additional_time += 3 * (int) $bsf_rt_words_per_minute / 60;
			} else {

				$additional_time += ( 12 - ( $i - 1 ) ) * (int) $bsf_rt_words_per_minute / 60;
			}
		}

			return $additional_time;
	}

	 /**
	  * Adds the Progress Bar at the bottom.
	  *
	  * @since 1.0.0
	  *
	  * @param  Nothing.
	  * @return Nothing.
	  */

	public function hook_header_bottom() {
		if ( ! is_home() && ! is_archive() ) {

			// Get the post type of the current post.
			$bsf_rt_current_post_type = get_post_type();

			// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

				return;
			}
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {

				return;
			}
			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				return;
			}
			 echo '<div id="bsf_rt_progress_bar_container" class="progress-container-bottom">
                <div class="progress-bar" id="bsf_rt_progress_bar"></div>
                </div>';
		}
	}

	 /**
	  * Adds the Progress Bar at the top.
	  *
	  * @since 1.0.0
	  *
	  * @param  Nothing.
	  * @return Nothing.
	  */
	public function hook_header_top() {
		if ( ! is_home() && ! is_archive() ) {

			  // Get the post type of the current post.
			  $bsf_rt_current_post_type = get_post_type();

			  // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
			if ( $this->bsf_rt_options['bsf_rt_post_types'] == null ) {

				return;
			}

			if ( isset( $this->bsf_rt_options['bsf_rt_post_types'] ) && ! in_array( $bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types'] ) ) {

				return;
			}
			if ( self::$bsf_rt_is_admin_bar_showing == true ) {

					echo '<div id="bsf_rt_progress_bar_container" class="progress-container-top-admin-bar">
                            <div class="progress-bar" id="bsf_rt_progress_bar"></div>
                            </div>';
			} elseif ( self::$bsf_rt_is_admin_bar_showing == false ) {

						echo '<div id="bsf_rt_progress_bar_container" class="progress-container-top">
                                <div class="progress-bar" id="bsf_rt_progress_bar"></div>
                                </div>';
			}
		}

	}
	/**
	 * Checks if admin bar is showing or not.
	 *
	 * @since 1.0.0
	 *
	 * @param  Nothing.
	 * @return Nothing.
	 */
	public function bsf_rt_is_admin_bar_showing() {
		self::$bsf_rt_is_admin_bar_showing = is_admin_bar_showing();

	}
	 /**
	  * Function of the read_meter shortcode.
	  *
	  * @since 1.0.0
	  *
	  * @param  Nothing.
	  * @return shortcode display value.
	  */
	public function read_meter_shortcode() {
		   $bsf_rt_post = get_the_ID();

		   $this->bsf_rt_calculate_reading_time( $bsf_rt_post, $this->bsf_rt_options );

		   $label   = $this->bsf_rt_options['bsf_rt_reading_time_label'];
		   $postfix = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

		if ( $this->reading_time > 1 ) {
			$calculated_postfix = $postfix;
		} else {
			$calculated_postfix = 'mins';
		}

		   $shortcode_output = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span>';

		   return $shortcode_output;
	}
	/**
	 * Remove markup for Twenty fifteen.
	 *
	 * @since 1.0.0
	 *
	 * @param  Nothing.
	 * @return Nothing.
	 */
	public function bsf_rt_remove_markup_for_twenty_fifteen( $output ) {
		$startStr = esc_html( '<span class="bsf_rt_reading_time_before_content">' );
		$endStr   = esc_html( '<!-- .bsf_rt_reading_time_before_content -->' );

		$newstr = preg_replace( '/' . preg_quote( $startStr ) . '.*?' . preg_quote( $endStr ) . '/', '', esc_html( $output ) );

		return htmlspecialchars_decode( $newstr );
	}
	/**
	 * Get the current Theme Name.
	 *
	 * @since 1.0.0
	 *
	 * @param  Nothing.
	 * @return current theme name.
	 */
	public function bsf_rt_get_current_theme() {
		$theme_name = '';
		$theme      = wp_get_theme();

		if ( isset( $theme->parent_theme ) && '' != $theme->parent_theme || null != $theme->parent_theme ) {

			$theme_name = $theme->parent_theme;

		} else {

			$theme_name = $theme->name;
		}

		return $theme_name;
	}
	 /**
	  * Removes our Reading time from the comments title
	  *
	  * @since 1.0.0
	  *
	  * @param  Nothing.
	  * @return current theme name.
	  */
	public function bsf_rt_remove_the_title_from_comments() {
		remove_filter( 'the_title', array( self::get_instance(), 'bsf_rt_add_reading_time_above_the_post_title' ), 90, 2 );

		remove_filter( 'the_title', array( self::get_instance(), 'bsf_rt_add_reading_time_below_the_post_title' ), 90, 2 );
	}
	/**
	 * Adds CSS to the progress Bar as per User input , When Style is Selected Normal.
	 *
	 * @since 1.1.0
	 *
	 * @param Progress Bar color.
	 * @param Progress Bar Background color.
	 * @param Progress Bar Thickness.
	 *
	 * @return int  Additional time added to the reading time by images.
	 */
	public function bsf_rt_set_progressbar_colors_normal() {        ?>
		<style type="text/css">
				.progress-container-top-admin-bar{
					background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
					height: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
					
				}
				.progress-container-top {
					background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
					height: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
					
				}
				.progress-container-bottom {
					background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
					height: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
					
				} 
				.progress-bar {
					background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one']; ?>;
					height: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
				   width: 0%;
					
				}           
		</style>
		<?php
	}

	 /**
	  * Adds CSS to the progress Bar as per User input , When Style is Selected Gradient.
	  *
	  * @since 1.1.0
	  *
	  * @param Progress Bar gradient color one.
	  * @param Progress Bar gradient color two.
	  * @param Progress Bar Background color.
	  * @param Progress Bar Thickness.
	  *
	  * @return int  Additional time added to the reading time by images.
	  */
	public function bsf_rt_set_progressbar_colors_gradient() {
		?>
		<style type="text/css">
			   .progress-container-top-admin-bar{
					background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
					height: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
					
				}
				.progress-container-top {
					background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
					height: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
					
				}
				.progress-container-bottom {
					background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
					height: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
					
				} 
				.progress-bar {
				background-color:  <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one']; ?>;
				background-image: linear-gradient(to bottom right, <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one']; ?>, <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_two']; ?>);
				height: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
				width: 0%;
				

				}
		</style>
		<?php
	}

	 /**
	  * Adds CSS to the Read Time as per User input if color.
	  *
	  * @since  1.1.0
	  * @param  Nothing.
	  * @return Nothing.
	  */
	public function bsf_rt_set_readtime_styles() {
		?>
		<style type="text/css">
			   .bsf_rt_reading_time_before_content{
					background: <?php echo $this->bsf_rt_options['bsf_rt_read_time_background_color']; ?>;

					color: <?php echo $this->bsf_rt_options['bsf_rt_read_time_color']; ?>;

					font-size: <?php echo $this->bsf_rt_options['bsf_rt_read_time_font_size']; ?>px;
					
					margin-top: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_top'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					margin-right: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_right'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					margin-bottom: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_bottom'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					margin-left: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_left'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					padding-top: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_top'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					padding-right: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_right'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					padding-bottom: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_bottom'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					padding-left: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_left'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					width: max-content;

					display: block;
					
				}
				
		</style>
		<?php
	}
	 /**
	  * Adds CSS to the Read Time as per User input if color and in above content.
	  *
	  * @since  1.1.0
	  * @param  Nothing.
	  * @return Nothing.
	  */
	public function bsf_rt_set_readtime_styles_content() {
		if ( $this->bsf_rt_options['bsf_rt_read_time_background_color'] == '' ) {
			?>

				<style type="text/css">
			  .entry-content .bsf_rt_reading_time_before_content{
				   background: unset;

					color: <?php echo $this->bsf_rt_options['bsf_rt_read_time_color']; ?>;

					font-size: <?php echo $this->bsf_rt_options['bsf_rt_read_time_font_size']; ?>px;
					
					margin-top: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_top'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					margin-right: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_right'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					margin-bottom: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_bottom'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					margin-left: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_left'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					padding-top: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_top'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					padding-right: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_right'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					padding-bottom: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_bottom'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					padding-left: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_left'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					width: max-content;

					display: block;
					
				}
				
		</style>

			  <?php
		} else {

			?>
		<style type="text/css">
			  .entry-content .bsf_rt_reading_time_before_content{
					background: <?php echo $this->bsf_rt_options['bsf_rt_read_time_background_color']; ?>;

					color: <?php echo $this->bsf_rt_options['bsf_rt_read_time_color']; ?>;

					font-size: <?php echo $this->bsf_rt_options['bsf_rt_read_time_font_size']; ?>px;
					
					margin-top: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_top'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					margin-right: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_right'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					margin-bottom: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_bottom'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					margin-left: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_margin_left'];
					echo $this->bsf_rt_options['bsf_rt_margin_unit'];
					?>
					 ;

					padding-top: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_top'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					padding-right: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_right'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					padding-bottom: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_bottom'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					padding-left: 
					<?php
					echo $this->bsf_rt_options['bsf_rt_read_time_padding_left'];
					echo $this->bsf_rt_options['bsf_rt_padding_unit'];
					?>
					 ;

					width: max-content;

					display: block;
					
				}
				
		</style>
				 <?php
		}
	}
	/**
	 * Adding Shortcode in Astra Theme hook.
	 *
	 * @since  1.1.0
	 * @param  Nothing.
	 * @return Nothing.
	 */
	public function bsf_rt_add_reading_time_after_astra_header() {
		echo do_shortcode( '[read_meter]' );
	}
	/**
	 * Checking current page
	 *
	 * @since  1.1.0
	 * @param  Nothing.
	 * @return Nothing.
	 */
	public function bsf_rt_check_the_page() {
		if ( is_singular() ) {

			 self::$bsf_rt_check_the_page = 'single';
		} elseif ( is_home() ) {

			  self::$bsf_rt_check_the_page = 'home';

		} elseif ( is_archive() ) {

			  self::$bsf_rt_check_the_page = 'archive';

		}
	}
	 /**
	  * Adding Marker for Progress Bar.
	  *
	  * @since  1.1.0
	  * @param  content
	  * @return content.
	  */
	public function bsf_rt_add_marker_for_progress_bar_scroll( $content ) {

				$markup_start = '<div id="bsf_rt_marker">';
				$markup_end   = '</div>';

				$content = $markup_start . $content . $markup_end;

				return $content;

	}


}

BSF_ReadTime::get_instance();

