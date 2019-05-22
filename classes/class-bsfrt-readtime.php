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

    public static $bsf_rt_is_admin_bar_showing;
    /**
     * Construct function for BSF_ReadTime.
     *
     * Create default settings on plugin activation.
     *
     * @since 1.0.0
     */
    public function __construct()
    {

        $bsf_rt_show_read_time=array();
        $bsf_rt_posts=array();
        array_push($bsf_rt_show_read_time, 'bsf_rt_single_page');
        array_push($bsf_rt_posts, 'post');
         $default_options_general = array(
        'bsf_rt_words_per_minute'   => '275',
        'bsf_rt_post_types'     => $bsf_rt_posts,
        );
        add_option('bsf_rt_general_settings', $default_options_general );
        $default_options_readtime = array(
        'bsf_rt_reading_time_label' => 'ReadingTime',
        'bsf_rt_reading_time_postfix_label' => 'mins',
        'bsf_rt_words_per_minute'   => '275',
        'bsf_rt_position_of_read_time' => 'above_the_content',
        'bsf_rt_single_page' => 'bsf_rt_single_page',
        //'bsf_rt_show_read_time' => $bsf_rt_show_read_time,
        );
        add_option('bsf_rt_read_time_settings', $default_options_readtime);
        $default_options_progressbar = array(
        'bsf_rt_position_of_progress_bar' => 'none',
        );
        add_option('bsf_rt_progress_bar_settings', $default_options_progressbar );
        $bsf_rt_general_settings = get_option('bsf_rt_general_settings');
        $bsf_rt_read_time_settings = get_option('bsf_rt_read_time_settings');
        $bsf_rt_progress_bar_settings = get_option('bsf_rt_progress_bar_settings');
 
        if (isset($bsf_rt_general_settings) && $bsf_rt_read_time_settings !=='' && isset($bsf_rt_progress_bar_settings)) {
        $all_options=array_merge( $bsf_rt_general_settings,$bsf_rt_read_time_settings);
        $all_options=array_merge($all_options,$bsf_rt_progress_bar_settings);
    }
        $this->bsf_rt_options = $all_options;
        add_action('init',array($this,'bsf_rt_is_admin_bar_showing'));

//Shortcode
add_shortcode('read_meter',array($this,'read_meter_shortcode'));        

//Displaying Reading Time Conditions
    if (isset($this->bsf_rt_options['bsf_rt_show_read_time'])) {
        if(in_array('bsf_rt_single_page', $this->bsf_rt_options['bsf_rt_show_read_time'])) {

                    if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'above_the_content' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
                    
                        add_filter('the_content', array( $this, 'bsf_rt_add_reading_time_before_content' ), 90);
                    }
                    if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'above_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
                    
                        add_filter('the_title', array( $this, 'bsf_rt_add_reading_time_above_the_post_title' ), 90);
                    }
                    if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'below_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
                    
                        add_filter('the_title', array( $this, 'bsf_rt_add_reading_time_below_the_post_title' ), 90);
                    }
             }
        if(in_array('bsf_rt_home_blog_page', $this->bsf_rt_options['bsf_rt_show_read_time'])) {

                    if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'above_the_content' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
                    
                        add_filter('get_the_excerpt', array( $this, 'bsf_rt_add_reading_time_before_content_excerpt' ), 1000);
                    }
                    if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'above_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
                    
                        add_filter('the_title', array( $this, 'bsf_rt_add_reading_time_before_title_excerpt' ), 1000);
                    }
                    if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'below_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
                    
                        add_filter('the_title', array( $this, 'bsf_rt_add_reading_time_after_title_excerpt' ), 1000);
                    }
             }
        if(in_array('bsf_rt_archive_page', $this->bsf_rt_options['bsf_rt_show_read_time'])) {

                    if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'above_the_content' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
                    
                        add_filter('get_the_excerpt', array( $this, 'bsf_rt_add_reading_time_before_content_archive' ), 1000);
                    }
                    if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'above_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
                    
                        add_filter('the_title', array( $this, 'bsf_rt_add_reading_time_before_title_archive' ), 1000);
                    }
                    if (isset($this->bsf_rt_options['bsf_rt_position_of_read_time']) && ( 'below_the_post_title' === $this->bsf_rt_options['bsf_rt_position_of_read_time'] ) ) {
                    
                        add_filter('the_title', array( $this, 'bsf_rt_add_reading_time_after_title_archive' ), 1000);
                    }
             }     
    }
//Displaying Progress Bar Conditions
        if (isset($this->bsf_rt_options['bsf_rt_position_of_progress_bar']) && ( 'none' === $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) ) {
            return;
        } elseif (isset($this->bsf_rt_options['bsf_rt_position_of_progress_bar']) && ( 'top_of_the_page' === $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) ) {
           
            add_action('wp_footer', array($this,'hook_header_top'));
            
            } elseif (isset($this->bsf_rt_options['bsf_rt_position_of_progress_bar']) && ( 'bottom_of_the_page' === $this->bsf_rt_options['bsf_rt_position_of_progress_bar'] ) ) {
            add_action('wp_footer', array($this,'hook_header_bottom'));
           
        }

        if (isset($this->bsf_rt_options['bsf_rt_progress_bar_styles']) && ('Normal' === $this->bsf_rt_options['bsf_rt_progress_bar_styles'])  ) {

            if (isset($this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_background_color']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_thickness']) ) {
                
                add_action('wp_head', array( $this, 'bsf_rt_set_progressbar_colors_normal'));
                 // $this->bsf_rt_set_progressbar_colors_normal();
            }
        } elseif (isset($this->bsf_rt_options['bsf_rt_progress_bar_styles']) && ('Gradient' === $this->bsf_rt_options['bsf_rt_progress_bar_styles'])  ) {

            if (isset($this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_gradiant_two']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_background_color']) && isset($this->bsf_rt_options['bsf_rt_progress_bar_thickness']) ) {

                      add_action('wp_head', array( $this, 'bsf_rt_set_progressbar_colors_gradient'));
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
    public function bsf_rt_add_reading_time_before_content( $content )
    {
        if (in_the_loop() && is_singular()) {
            // die();
            

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
    		<span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
            $content .= $original_content;
            return $content;
        }
        else {
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
    public function bsf_rt_add_reading_time_above_the_post_title( $title)
    {
        // die();
        if (in_the_loop() && is_singular() ) {
        
  
            

            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();
            //var_dump($this->bsf_rt_options['bsf_rt_post_types']);
        
            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
    		if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
    			    
    			return $title;
    			
    		}
    		 if ($this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {
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
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
            // $title = '<span class="bsf_rt_display_label" title="'.$label.'"></span>';
            $title .= $original_title;
            return $title;
        } else {
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
        if (in_the_loop() && is_singular() ) {
        
  
            


            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();

        
            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
    		if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
    			return $title;
    		}
    		if ($this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {
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
           <br> <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
            $original_title .= $title;
            $title=$original_title;
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
    public function bsf_rt_add_reading_time_before_content_excerpt( $content ) {
        if (in_the_loop() && is_home() && !is_archive() ) {
            

            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();

            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
           if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
        			return $content;
        		}
        		if ($this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {
                return $content;
            }
            if (isset($this->bsf_rt_options['bsf_rt_post_types']) && !in_array($bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types']) ) {
                return $content;
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

            $content  = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
            $content .= $original_content;
            return $content;
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
    public function bsf_rt_add_reading_time_before_title_excerpt( $title )
    {
         if (in_the_loop() && is_home() && !is_archive() ) {
        
  
            

            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();
            //var_dump($this->bsf_rt_options['bsf_rt_post_types']);
        
            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
            if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
                    
                return $title;
                
            }
             if ($this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {
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
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
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
    public function bsf_rt_add_reading_time_after_title_excerpt( $title )
    {
        if (in_the_loop() && is_home() && !is_archive() ) {
        
  
            


            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();

        
            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
            if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
                return $title;
            }
            if ($this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {
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
        <br><span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
            $original_title .= $title;
            $title=$original_title;
            return $title;
        } else {
            return $title;
        }
    }
    /**
     * Adds the reading time before the archive content.
     *
     * If the options is selected to automatically add the reading time before
     * the_excerpt, the reading time is calculated and added to the beginning of the_excerpt.
     *
     * @since 1.0.0
     *
     * @param  string $content The original content of the_excerpt.
     * @return string The excerpt content with reading time prepended.
     */
    public function bsf_rt_add_reading_time_before_content_archive( $content )
    {
        if (in_the_loop() && is_archive() ) { 
            

            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();

            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
           if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
                    return $content;
                }
                if ($this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {
                return $content;
            }
            if (isset($this->bsf_rt_options['bsf_rt_post_types']) && !in_array($bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types']) ) {
                return $content;
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

            $content  = '
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
            $content .= $original_content;
            return $content;
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
    public function bsf_rt_add_reading_time_before_title_archive( $title )
    {
         if (in_the_loop() && is_archive() ) {
        
  
            

            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();
            //var_dump($this->bsf_rt_options['bsf_rt_post_types']);
        
            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
            if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
                    
                return $title;
                
            }
             if ($this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {
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
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
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
    public function bsf_rt_add_reading_time_after_title_archive( $title )
    {
        if (in_the_loop() && is_archive() ) {
        
  
            


            // Get the post type of the current post.
            $bsf_rt_current_post_type = get_post_type();

        
            // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
            if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
                return $title;
            }
            if ($this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {
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

            $title  = '<br>
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
            $original_title .= $title;
            $title=$original_title;
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
     * Adds the Progress Bar at the bottom.
     * @since 1.0.0
     *
     * @param  Nothing.
     * @return Nothing.
     */

     public function hook_header_bottom () {
                 


                // Get the post type of the current post.
                $bsf_rt_current_post_type = get_post_type();

            
                // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
                if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
                    return ;
                }
                if ($this->bsf_rt_options['bsf_rt_post_types'] == 'post' && $bsf_rt_current_post_type !== $this->bsf_rt_options['bsf_rt_post_types'] ) {
                    return ;
                }
                if (isset($this->bsf_rt_options['bsf_rt_post_types']) && !in_array($bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types']) ) {
                    return ;
                }
                      echo '<div id="bsf_rt_progress_bar_container" class="progress-container-bottom">
                    <div class="progress-bar" id="bsf_rt_progress_bar"></div>
                    </div>';
            }

     /**
     * Adds the Progress Bar at the top.
     * @since 1.0.0
     *
     * @param  Nothing.
     * @return Nothing.
     */        
    public function hook_header_top()
            {  
                 
              
                // Get the post type of the current post.
                $bsf_rt_current_post_type = get_post_type();

            
                // If the current post type isn't included in the array of post types or it is and set to false, don't display it.
                if ($this->bsf_rt_options['bsf_rt_post_types'] == NULL) {
                    return ;
                }

                if (isset($this->bsf_rt_options['bsf_rt_post_types']) && !in_array($bsf_rt_current_post_type, $this->bsf_rt_options['bsf_rt_post_types']) ) {
                    return ;
                }
                if (self::$bsf_rt_is_admin_bar_showing == true ) {
                    
                    echo '<div id="bsf_rt_progress_bar_container" class="progress-container-top-admin-bar">
                <div class="progress-bar" id="bsf_rt_progress_bar"></div>
                </div>';
                } elseif (self::$bsf_rt_is_admin_bar_showing == false ) {
                     
                            echo '<div id="bsf_rt_progress_bar_container" class="progress-container-top">
                <div class="progress-bar" id="bsf_rt_progress_bar"></div>
                </div>';
                }
        
    }   
    /**
     * Checks if admin bar is showing or not.
     * @since 1.0.0
     *
     * @param  Nothing.
     * @return Nothing.
     */  
    public function bsf_rt_is_admin_bar_showing() {
       
        self::$bsf_rt_is_admin_bar_showing=is_admin_bar_showing();
           
     }
     /**
     * Function of the read_meter shortcode.
     * @since 1.0.0
     *
     * @param  Nothing.
     * @return shortcode display value.
     */     
     public function read_meter_shortcode() {

            $bsf_rt_post          = get_the_ID();
           
            $this->bsf_rt_calculate_reading_time($bsf_rt_post, $this->bsf_rt_options);
    
            $label            = $this->bsf_rt_options['bsf_rt_reading_time_label'];
            $postfix          = $this->bsf_rt_options['bsf_rt_reading_time_postfix_label'];
        

            if ($this->reading_time > 1 ) {
                $calculated_postfix = $postfix;
            } else {
                $calculated_postfix = 'mins';
            }

            $shortcode_output = '<br>
            <span class="bsf_rt_reading_time_before_content"><span class="bsf_rt_display_label" prefix="' . $label . '"></span> <span class="bsf_rt_display_time" reading_time="' . $this->reading_time . '"></span> <span class="bsf_rt_display_postfix" postfix="' . $calculated_postfix . '"></span></span><br>';
            return $shortcode_output;
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
    public function bsf_rt_set_progressbar_colors_normal()
    {
        
        ?>
        <style type="text/css">
                .progress-container-top-admin-bar{
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
                    height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
                    
                }
                .progress-container-top {
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
                    height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
                    
                }
                .progress-container-bottom {
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
                    height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
                    
                } 
                .progress-bar {
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_gradiant_one']; ?>;
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
               .progress-container-top-admin-bar{
                    background: <?php echo $this->bsf_rt_options['bsf_rt_progress_bar_background_color']; ?>;
                    height: <?php  echo $this->bsf_rt_options['bsf_rt_progress_bar_thickness']; ?>px;
                    
                }
                .progress-container-top {
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
