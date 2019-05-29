<?php
$options = get_option('bsf_rt_general_settings');

$bsf_rt_words_per_minute = '';

$bsf_rt_post_types = array();

$bsf_rt_include_images = '';

$bsf_rt_include_comments = '';

if (isset($options['bsf_rt_words_per_minute'])) {

    $bsf_rt_words_per_minute = $options['bsf_rt_words_per_minute'];
}

if (isset($options['bsf_rt_post_types'])) {

    $bsf_rt_post_types = $options['bsf_rt_post_types'];
}

if (isset($options['bsf_rt_include_images'])) {

    $bsf_rt_include_images = $options['bsf_rt_include_images'];
}

if (isset($options['bsf_rt_include_comments'])) {

    $bsf_rt_include_comments = $options['bsf_rt_include_comments'];
}

$args = array(
            'public'   => true,
            
            );
           
$exclude=array('attachment','elementor_library','Media','My Templates');
?>
<div class="bsf_rt_global_settings" id="bsf_rt_global_settings">
  <form method="post" name="bsf_rt_settings_form">
    <table class="form-table" > 
          <br>
          <p class="description">
              <?php 
                _e('Control the core settings of a read meter, e.g. the average count of words that humans can read in a minute & allow a read meter on particular post types, etc.' , 'bsf_rt_textdomain');
               ?>
              
          </p>  
        <tr>
            <th scope="row">
              <label for="SelectPostTypes"><?php _e('Select Post Types' , 'bsf_rt_textdomain') ?> :</label>
            </th>
            <td class="post_type_name">
                  
                    <?php
                
                    foreach ( get_post_types($args, 'objects') as $post_type ) {

                        if (in_array($post_type->labels->name, $exclude)  ) {

                            continue;
                        } 
                        if ($bsf_rt_post_types !== 'post') {
                            if (isset($bsf_rt_post_types)) {
                                if (in_array($post_type->name, $bsf_rt_post_types)) {
                                    echo'<label for="ForPostType">
                             <input type="checkbox" checked name="posts[]" value="'.$post_type->name.'">
                             '.$post_type->labels->name.'</label><br> ';
                                } else {
                                    echo'<label for="ForPostType">
                             <input type="checkbox"  name="posts[]" value="'.$post_type->name.'">
                             '.$post_type->labels->name.'</label><br> ';
                                }
                            } else {
                                echo'<label for="ForPostType">
                             <input type="checkbox"  name="posts[]" value="'.$post_type->name.'">
                             '.$post_type->labels->name.'</label><br> ';
                            }
                        } else {
                            if ($post_type->name == 'post') {
                                echo'<label for="ForPostType">
                         <input type="checkbox" checked name="posts[]" value="'.$post_type->name.'">
                         '.$post_type->labels->name.'</label><br> ';
                            }
                            echo'<label for="ForPostType">
                         <input type="checkbox"  name="posts[]" value="'.$post_type->name.'">
                         '.$post_type->labels->name.'</label><br> ';
                        }
                    }
                    ?>
           </td>
        </tr>
        <tr>
        <tr>
          <th scope="row">
            <label for="WordsPerMinute"><?php _e('Words Per Minute' , 'bsf_rt_textdomain') ?> :</label>
          </th>
          <td>
            <input type="number" required name="bsf_rt_words_per_minute" placeholder="275" value="<?php  echo $bsf_rt_words_per_minute; ?>" class="small-text">
          </td>
        </tr>
          <th scope="row">

            <label for="IncludeComments"> <?php _e('Include Comments' , 'bsf_rt_textdomain') ?> :</label>
          </th>
          <td>
                <?php if (isset($bsf_rt_include_comments) && $bsf_rt_include_comments == 'yes') {
                    echo '<input type="checkbox" checked name="bsf_rt_include_comments" value="yes">';
                } else {
                    echo '<input type="checkbox" name="bsf_rt_include_comments" value="yes">';
                }
                ?>
              <p id="bsf_rt_description" class="description">
                 <?php _e("Check this to include comment's text in reading time." , "bsf_rt_textdomain") ?>
                 
              </p>  
          </td>
        </tr>
        <tr>
          <th scope="row">

             <label for="IncludeImages"> <?php _e('Include Images' , 'bsf_rt_textdomain') ?> :</label>
          </th>
          <td>
            <?php if (isset($bsf_rt_include_images) && $bsf_rt_include_images == 'yes') {

                echo '<input type="checkbox" checked name="bsf_rt_include_images" value="yes">';
            } else {

                echo '<input type="checkbox" name="bsf_rt_include_images" value="yes">';
            }
            ?>
            <p id="bsf_rt_description" class="description">   
              <?php _e(" Check this to include post images in reading time." , "bsf_rt_textdomain") ?>
             
            </p>  
          </td>
        </tr>
    </table>
    <table class="form-table">
       <tr>
          <th>
            <?php wp_nonce_field( 'bsf-rt-nonce-general', 'bsf-rt-general' ); ?>
            <input type="submit" value="Save" class="bt button button-primary" name="submit">
          </th>
       </tr>
    </table>
  </form>
</div>