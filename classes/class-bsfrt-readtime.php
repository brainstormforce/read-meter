<?php
/**
 * Class for calculating reading time.
 *
 * The class that contains all functions for calculating reading time.
 *
 * @since 1.0.0
 */
class BSF_ReadTime {
	public $reading_time;
	/**
	 * Construct function for BSF_ReadTime.
	 *
	 * Create default settings on plugin activation.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// die();
		$default_options = array(
		'bsf_rt_reading_time_label'=> 'Reading Time',
		'bsf_rt_reading_time_postfix_label'=> 'mins',
		'bsf_rt_words_per_minute'   => '275',
		'bsf_rt_position_of_read_time' => 'above_the_content',
		'bsf_rt_post_types'     => 'post',
	);

	add_option( 'bsf_rt', $default_options );

	$bsf_rt_options = get_option( 'bsf_rt' );

	if ( isset( $bsf_rt_options['bsf_rt_position_of_read_time'] ) && ( 'above_the_content' === $bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
		// die();
			add_filter( 'the_content', array( $this, 'bsf_rt_add_reading_time_before_content' ), 90 );
		}

		 if ( isset( $bsf_rt_options['bsf_rt_position_of_read_time'] ) && 'below_ast_header' === $bsf_rt_options['bsf_rt_position_of_read_time'] ) {
		 	add_action( 'astra_header_after', array( $this, 'bsf_rt_add_reading_time_after_astra_header' ), 1000 );
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
	 * @param string $content The original post content.
	 * @return string The post content with reading time prepended.
	 */
	public function bsf_rt_add_reading_time_before_content( $content ) {
		// die();
		$bsf_rt_options = get_option( 'bsf_rt' );

		// Get the post type of the current post.
		$bsf_rt_current_post_type = get_post_type();
		
		// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
	
		if ( isset( $bsf_rt_options['bsf_rt_post_types'] ) && !in_array($bsf_rt_current_post_type, $bsf_rt_options['bsf_rt_post_types']) )  {
			return $content;
		}

		$original_content = $content;
		$bsf_rt_post          = get_the_ID();
		$post_meta=get_post_meta( $bsf_rt_post,'bsf_rt_reading_time',true);
		$previous_word_count=get_post_meta( $bsf_rt_post,'bsf_rt_reading_time',true);
		
		$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $bsf_rt_options );
	
		$label            = $bsf_rt_options['bsf_rt_reading_time_label'];
		$postfix          = $bsf_rt_options['bsf_rt_reading_time_postfix_label'];
		

		if ( $this->reading_time > 1 ) {
			$calculated_postfix = $postfix;
		} else {
			$calculated_postfix = 'mins';
		}

		$content  = '<span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label">' . $label . '</span> <span class="bsf_rt_display_time">' . $this->reading_time . '</span> <span class="bsf_rt_display_label bsf_rt_display_postfix">' . $calculated_postfix . '</span></span>';
		$content .= $original_content;
		return $content;
	}

	/**
	 * Adds the reading time after astra_header.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content The original post content.
	 * @return string The post content with reading time prepended.
	 */
	public function bsf_rt_add_reading_time_after_astra_header() {
		$bsf_rt_options = get_option( 'bsf_rt' );

		// Get the post type of the current post.
		$bsf_rt_current_post_type = get_post_type();
		
		// If the current post type isn't included in the array of post types or it is and set to false, don't display it.
	
		if ( isset( $bsf_rt_options['bsf_rt_post_types'] ) && !in_array($bsf_rt_current_post_type, $bsf_rt_options['bsf_rt_post_types']) )  {
			return ;
		}
		$bsf_rt_post          = get_the_ID();
		$this->bsf_rt_calculate_reading_time( $bsf_rt_post, $bsf_rt_options );
	
		$label            = $bsf_rt_options['bsf_rt_reading_time_label'];
		$postfix          = $bsf_rt_options['bsf_rt_reading_time_postfix_label'];
		

		if ( $this->reading_time > 1 ) {
			$calculated_postfix = $postfix;
		} else {
			$calculated_postfix = 'mins';
		}

	echo '<span class="bsf_rt_reading_time_after_astra_header"><span class="bsf_rt_display_label">' . $label . '</span> <span class="bsf_rt_display_time">' . $this->reading_time . '</span> <span class="bsf_rt_display_label bsf_rt_display_postfix">' . $calculated_postfix . '</span></span>';
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
	 * @param int   $rt_post_id The Post ID.
	 * @param array $rt_options The options selected for the plugin.
	 * @return string|int The total reading time for the article or string if it's 0.
	 */
	public function bsf_rt_calculate_reading_time( $bsf_rt_post, $bsf_rt_options ) {

		$bsf_rt_content       = get_post_field( 'post_content', $bsf_rt_post );
		$number_of_images = substr_count( strtolower( $bsf_rt_content ), '<img ' );

		if ( ! isset( $bsf_rt_options['include_shortcodes'] ) ) {
			$bsf_rt_content = strip_shortcodes( $bsf_rt_content );
		}

		$bsf_rt_content = wp_strip_all_tags( $bsf_rt_content );
		$word_count = count( preg_split( '/\s+/', $bsf_rt_content ) );

		// Calculate additional time added to post by images.
		$additional_words_for_images = $this->bsf_rt_calculate_images( $number_of_images, $bsf_rt_options['bsf_rt_words_per_minute'] );
			$word_count                 += $additional_words_for_images;
		
	$this->reading_time = ceil( $word_count / $bsf_rt_options['bsf_rt_words_per_minute'] );

		// If the reading time is 0 then return it as < 1 instead of 0.
		if ( 1 > $this->reading_time ) {
			$this->reading_time = '< 1';
		}
         update_post_meta($bsf_rt_post, 'bsf_rt_reading_time', $this->reading_time);
         update_post_meta($bsf_rt_post, 'bsf_rt_word_count', $word_count);
		return $this->reading_time;

	}

	/**
	 * Adds additional reading time for images
	 *
	 * Calculate additional reading time added by images in posts. Based on calculations by Medium. https://blog.medium.com/read-time-and-you-bc2048ab620c
	 *
	 * @since 1.1.0
	 *
	 * @param int   $total_images number of images in post.
	 * @param array $bsf_rt_words_per_minute words per minute.
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

}
$bsf_rt = new BSF_ReadTime();