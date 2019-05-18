<?php
/**
 * Class for calculating reading time.
 *
 * The class that contains all functions for calculating reading time.
 *
 * @since 1.0.0
 */
class BSF_ReadTime
{
    public $reading_time;

    public $bsf_rt_options = array();
    /**
     * Construct function for BSF_ReadTime.
     *
     * Create default settings on plugin activation.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        
        $default_options = array(
        'bsf_rt_reading_time_label'=> 'Reading Time',
        'bsf_rt_reading_time_postfix_label'=> 'mins',
        'bsf_rt_words_per_minute'   => '275',
        'bsf_rt_position_of_read_time' => 'above_the_content',
        'bsf_rt_post_types'     => 'post',
        );

        add_option('bsf_rt', $default_options);

        $this->bsf_rt_options = get_option('bsf_rt');

        if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'above_the_content' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
        
            add_filter('the_content', array( $this, 'bsf_rt_add_reading_time_before_content' ), 90);
        }
        if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'above_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
        
            add_filter('the_title', array( $this, 'bsf_rt_add_reading_time_above_the_post_title' ), 90);
        }
        if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'below_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
        
            add_filter('the_title', array( $this, 'bsf_rt_add_reading_time_below_the_post_title' ), 90);
        }
        if (isset($this->bsf_rt_options['bsf_rt_single_page']) && 'bsf_rt_single_page' === $this->bsf_rt_options['bsf_rt_single_page'] ) {
            add_filter('get_the_excerpt', array( $this, 'bsf_rt_add_reading_time_before_excerpt' ), 1000);
        }
        if (isset($this->bsf_rt_options['bsf_rt_position_of_progress_bar']) && ( 'none' === $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) ) {
            return;
        } elseif (isset($this->bsf_rt_options['bsf_rt_position_of_progress_bar']) && ( 'top_of_the_page' === $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) ) {
            add_action('wp_footer', 'hook_header');
            
            function hook_header()
            {
                $bsf_rt_is_admin_bar_showing=is_admin_bar_showing();    
                
                if ($bsf_rt_is_admin_bar_showing == true ) {
                    
                    echo '<div style="top:30px;" id="myWrap" class="progress-container-top">
            	<div class="progress-bar" id="myBar"></div>
            	</div>';
                } elseif ($bsf_rt_is_admin_bar_showing == false ) {
                     
                            echo '<div style="top:0px;" id="myWrap" class="progress-container-top">
            	<div class="progress-bar" id="myBar"></div>
            	</div>';
                }
        
            }      
        } elseif (isset($this->bsf_rt_options['bsf_rt_position_of_progress_bar']) && ( 'bottom_of_the_page' === $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) ) {
            add_action('wp_footer', 'hook_header');
            function hook_header()
            {
                  echo '<div id="myWrap" class="progress-container-bottom">
            	<div class="progress-bar" id="myBar"></div>
            	</div>';
            }
        }

        if (isset($this->bsf_rt_options['bsf_rt_progress_bar_styles']) && ('Normal' === $this->bsf_rt_options['bsf_rt_progress_bar_styles'])  ) {

            if (isset($this->bsf_rt_options['bsf_rt_progress_bar_color']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_background_color']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_thickness']) ) {
                
                add_action('wp_head', array( $this, 'bsf_rt_set_progressbar_colors_normal'));
                 // $this->bsf_rt_set_progressbar_colors_normal();
            }
        } elseif (isset($this->bsf_rt_options['bsf_rt_progress_bar_styles']) && ('Gradient' === $this->bsf_rt_options['bsf_rt_progress_bar_styles'])  ) {

            if (isset($this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_gradiant_two']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_background_color']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_thickness']) ) {

                      add_action('wp_head', array( $this, 'bsf_rt_set_progressbar_colors_gradient'));
            }
        } 


         // if ( isset( $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) && 'below_ast_header' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) {
         //     add_action( 'astra_header_after', array( $this, 'bsf_rt_add_reading_time_after_astra_header' ), 1000 );
         // }
    }

    public function call_css_header()
    {
        ?>
        <style type="text/css">
            .progress-container-top{
                background: #000;
                height: 20px;
            }
        </style>

        <?php
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
    public function bsf_rt_add_reading_time_before_content( $content )
    {

        // die();
        $this->bsf_rt_options = get_option('bsf_rt');

        // Get the post type of the current post.
        $bsf_rt_current_post_type = get_post_type();
        
        // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
  		if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
    			return $content;
    		}
        if (isset($this->bsf_rt_options['bsf_rt_post_types']) && !in_array($bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types']) ) {
            return $content;
        }

        $original_content = $content;
        $bsf_rt_post          = get_the_ID();
        $post_meta=get_post_meta($bsf_rt_post, 'bsf_rt_reading_time', true);
        $previous_word_count=get_post_meta($bsf_rt_post, 'bsf_rt_reading_time', true);
        
        $this->bsf_rt_calculate_reading_time($bsf_rt_post, $this->bsf_rt_options);
    
        $label            = $this->bsf_rt_options['bsf_rt_reading_time_label'];
        $postfix          = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];
        

        if ($this->reading_time > 1 ) {
            $calculated_postfix = $postfix;
        } else {
            $calculated_postfix = 'mins';
        }

        $content  = '
		<span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label">' . $label . '</span> <span class="bsf_rt_display_time">' . $this->reading_time . '</span> <span class="bsf_rt_display_label bsf_rt_display_postfix">' . $calculated_postfix . '</span></span>';
        $content .= $original_content;
        return $content;
    }
    /**
     * Adds the reading time above the post title.
     *
     * @since 1.0.0
     *
     * @param  string $content The original post content.
     * @return string The post content with reading time prepended.
     */
    public function bsf_rt_add_reading_time_above_the_post_title( $title)
    {
        // die();
        if (in_the_loop() && ( is_single() || is_page() || is_home() || is_category() ) ) {
        
  
            $this->bsf_rt_options = get_option('bsf_rt');

            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();
            //var_dump($this->bsf_rt_options['bsf_rt_post_types']);
        
            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
    		if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
    			    
    			return $title;
    			
    		}
            if (isset($this->bsf_rt_options['bsf_rt_post_types']) && !in_array($bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types']) ) {
                  return $title;
              
            }

            $original_title = $title;
            $bsf_rt_post          = get_the_ID();
            $post_meta=get_post_meta($bsf_rt_post, 'bsf_rt_reading_time', true);
            $previous_word_count=get_post_meta($bsf_rt_post, 'bsf_rt_reading_time', true);
        
            $this->bsf_rt_calculate_reading_time($bsf_rt_post, $this->bsf_rt_options);
    
            $label            = $this->bsf_rt_options['bsf_rt_reading_time_label'];
            $postfix          = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];
        

            if ($this->reading_time > 1 ) {
                $calculated_postfix = $postfix;
            } else {
                $calculated_postfix = 'mins';
            }

            $title  = '
		<span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label">' . $label . '</span> <span class="bsf_rt_display_time">' . $this->reading_time . '</span> <span class="bsf_rt_display_label bsf_rt_display_postfix">' . $calculated_postfix . '</span></span><br>';
            $title .= $original_title;
            return $title;
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
    public function bsf_rt_add_reading_time_below_the_post_title( $title)
    {
        // die();
        if (in_the_loop() && ( is_single() || is_page() || is_home() || is_category() ) ) {
        
  
            $this->bsf_rt_options = get_option('bsf_rt');


            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();

        
            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
    		if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
    			return $title;
    		}
            if (isset($this->bsf_rt_options['bsf_rt_post_types']) && !in_array($bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types']) ) {
                  return $title;
            }

            $original_title = $title;
            $bsf_rt_post          = get_the_ID();
            $post_meta=get_post_meta($bsf_rt_post, 'bsf_rt_reading_time', true);
            $previous_word_count=get_post_meta($bsf_rt_post, 'bsf_rt_reading_time', true);
        
            $this->bsf_rt_calculate_reading_time($bsf_rt_post, $this->bsf_rt_options);
    
            $label            = $this->bsf_rt_options['bsf_rt_reading_time_label'];
            $postfix          = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];
        

            if ($this->reading_time > 1 ) {
                $calculated_postfix = $postfix;
            } else {
                $calculated_postfix = 'mins';
            }

            $title  = ' 
		<br><span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label">' . $label . '</span> <span class="bsf_rt_display_time">' . $this->reading_time . '</span> <span class="bsf_rt_display_label bsf_rt_display_postfix">' . $calculated_postfix . '</span></span>';
            $original_title .= $title;
            $title=$original_title;
            return $title;
        }

    }
    /**
     * Adds the reading time before the_excerpt.
     *
     * If the options is selected to automatically add the reading time before
     * the_excerpt, the reading time is calculated and added to the beginning of the_excerpt.
     *
     * @since 1.0.0
     *
     * @param  string $content The original content of the_excerpt.
     * @return string The excerpt content with reading time prepended.
     */
    public function bsf_rt_add_reading_time_before_excerpt( $content )
    {
        $this->bsf_rt_options = get_option('bsf_rt');

        // Get the post type of the current post.
        $bsf_rt_current_post_type = get_post_type();

        // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
       if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
    			return $title;
    		}
        if (isset($this->bsf_rt_options['bsf_rt_post_types']) && !in_array($bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types']) ) {
            return $title;
        }

        $original_content = $content;
        $bsf_rt_post          = get_the_ID();

        $this->bsf_rt_calculate_reading_time($bsf_rt_post, $this->bsf_rt_options);

        $label            = $this->bsf_rt_options['bsf_rt_reading_time_label'];
        $postfix          = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];

        if ($this->reading_time > 1 ) {
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
     * @param  string $content The original post content.
     * @return string The post content with reading time prepended.
     */
    public function bsf_rt_add_reading_time_after_astra_header()
    {
        $this->bsf_rt_options = get_option('bsf_rt');

        // Get the post type of the current post.
        $bsf_rt_current_post_type = get_post_type();
        
        // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
    
        if (isset($this->bsf_rt_options['bsf_rt_post_types']) && !in_array($bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types']) ) {
            return ;
        }
        $bsf_rt_post          = get_the_ID();
        $this->bsf_rt_calculate_reading_time($bsf_rt_post, $this->bsf_rt_options);
    
        $label            = $this->bsf_rt_options['bsf_rt_reading_time_label'];
        $postfix          = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];
        

        if ($this->reading_time > 1 ) {
            $calculated_postfix = $postfix;
        } else {
            $calculated_postfix = 'mins';
        }

        echo '
			<span class="bsf_rt_reading_time_after_astra_header"><span class="bsf_rt_display_label">' . $label . '</span> <span class="bsf_rt_display_time">' . $this->reading_time . '</span> <span class="bsf_rt_display_label bsf_rt_display_postfix">' . $calculated_postfix . '</span></span>
	         ';

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
    public function bsf_rt_calculate_reading_time( $bsf_rt_post, $bsf_rt_options )
    {

        $bsf_rt_content       = get_post_field('post_content', $bsf_rt_post);
        $number_of_images = substr_count(strtolower($bsf_rt_content), '<img ');

        if (! isset($this->bsf_rt_options['include_shortcodes']) ) {
            $bsf_rt_content = strip_shortcodes($bsf_rt_content);
        }

        $bsf_rt_content = wp_strip_all_tags($bsf_rt_content);
        $word_count = count(preg_split('/\s+/', $bsf_rt_content));

        // Calculate additional time added to post by images.
        $additional_words_for_images = $this->bsf_rt_calculate_images($number_of_images, $this->bsf_rt_options['bsf_rt_words_per_minute']);
        $word_count                 += $additional_words_for_images;
        
        $this->reading_time = ceil($word_count / $this->bsf_rt_options['bsf_rt_words_per_minute']);

        // If the reading time is 0 then return it as < 1 instead of 0.
        if (1 > $this->reading_time ) {
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
     * @param  int   $total_images            number of images in post.
     * @param  array $bsf_rt_words_per_minute words per minute.
     * @return int  Additional time added to the reading time by images.
     */
    public function bsf_rt_calculate_images( $total_images, $bsf_rt_words_per_minute )
    {
        $additional_time = 0;
        // For the first image add 12 seconds, second image add 11, ..., for image 10+ add 3 seconds.
        for ( $i = 1; $i <= $total_images; $i++ ) {
            if ($i >= 10 ) {
                $additional_time += 3 * (int) $bsf_rt_words_per_minute / 60;
            } else {
                $additional_time += ( 12 - ( $i - 1 ) ) * (int) $bsf_rt_words_per_minute / 60;
            }
        }

        return $additional_time;
    }

    /**
     * Adds CSS to the progress BAr as per User input , When Style is Selected Normal.
     *
     * @since 1.1.0
     *
     * @param Progress Bar color.
     * @param Progress Bar Background color.
     * @param Progress Bar Thickness.
     * 
     * @return int  Additional time added to the reading time by images.
     */
    public function bsf_rt_set_progressbar_colors_normal()
    {
        
        ?>
        <style type="text/css">
                .progress-container-top{
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
                    height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
                    
                }
                .progress-container-bottom {
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
                    height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
                    
                } 
                .progress-bar {
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_color']; ?>;
                    height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
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
    public function bsf_rt_set_progressbar_colors_gradient()
    {  
        ?>
        <style type="text/css">
               .progress-container-top{
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
                    height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
                    
                }
                .progress-container-bottom {
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
                    height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
                    
                } 
                .progress-bar {
                background-color:  <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one']; ?>;
                background-image: linear-gradient(to bottom right, <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one']; ?>, <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_two']; ?>);
                height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
                width: 0%;
                

                }
        </style>
        <?php
    }

}
$bsf_rt = new BSF_ReadTime();
