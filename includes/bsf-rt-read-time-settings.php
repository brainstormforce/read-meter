<?php

$options=get_option('bsf_rt_read_time_settings');

$bsf_rt_show_read_time = array('bsf_rt_single_page');

$bsf_rt_position_of_read_time = '';

$bsf_rt_reading_time_label = '';

$bsf_rt_reading_time_postfix_label = '';

$bsf_rt_read_time_font_size = 15;

$bsf_rt_read_time_bg_option = '';

$bsf_rt_read_time_background_color = '#eeeeee';

$bsf_rt_read_time_color = '#333333';

$bsf_rt_read_time_margin_top = 5;

$bsf_rt_read_time_margin_right = 0;

$bsf_rt_read_time_margin_bottom = 5;

$bsf_rt_read_time_margin_left = 0;

$bsf_rt_read_time_padding_top = 0.5;

$bsf_rt_read_time_padding_right = 0.7;

$bsf_rt_read_time_padding_bottom = 0.5;

$bsf_rt_read_time_padding_left = 0.7;

$bsf_rt_padding_unit = 'em';

$bsf_rt_margin_unit = 'px';

if (isset($options['bsf_rt_show_read_time'])) {

    $bsf_rt_show_read_time = $options['bsf_rt_show_read_time'];
}

if (isset($options['bsf_rt_position_of_read_time'])) {

    $bsf_rt_position_of_read_time = $options['bsf_rt_position_of_read_time'];
}

if (isset($options['bsf_rt_reading_time_label'])) {

    $bsf_rt_reading_time_label = $options['bsf_rt_reading_time_label'];
}

if (isset($options['bsf_rt_reading_time_postfix_label'])) {

    $bsf_rt_reading_time_postfix_label = $options['bsf_rt_reading_time_postfix_label'];
}

if (isset($options['bsf_rt_read_time_font_size'])) {

    $bsf_rt_read_time_font_size = $options['bsf_rt_read_time_font_size'];
}

if (isset($options['bsf_rt_read_time_bg_option'])) {

    $bsf_rt_read_time_bg_option = $options['bsf_rt_read_time_bg_option'];
}

if (isset($options['bsf_rt_read_time_background_color'])) {

    $bsf_rt_read_time_background_color = $options['bsf_rt_read_time_background_color'];
}

if (isset($options['bsf_rt_read_time_color'])) {

    $bsf_rt_read_time_color = $options['bsf_rt_read_time_color'];
}

if (isset($options['bsf_rt_read_time_margin_top'])) {

    $bsf_rt_read_time_margin_top = $options['bsf_rt_read_time_margin_top'];
}

if (isset($options['bsf_rt_read_time_margin_right'])) {

    $bsf_rt_read_time_margin_right = $options['bsf_rt_read_time_margin_right'];
}

if (isset($options['bsf_rt_read_time_margin_bottom'])) {

    $bsf_rt_read_time_margin_bottom = $options['bsf_rt_read_time_margin_bottom'];
}

if (isset($options['bsf_rt_read_time_margin_left'])) {

    $bsf_rt_read_time_margin_left = $options['bsf_rt_read_time_margin_left'];
}

if (isset($options['bsf_rt_read_time_padding_top'])) {

    $bsf_rt_read_time_padding_top = (float) $options['bsf_rt_read_time_padding_top'];
}

if (isset($options['bsf_rt_read_time_padding_right'])) {

    $bsf_rt_read_time_padding_right = (float) $options['bsf_rt_read_time_padding_right'];
}

if (isset($options['bsf_rt_read_time_padding_bottom'])) {

    $bsf_rt_read_time_padding_bottom = (float) $options['bsf_rt_read_time_padding_bottom'];
}

if (isset($options['bsf_rt_read_time_padding_left'])) {

    $bsf_rt_read_time_padding_left = (float) $options['bsf_rt_read_time_padding_left'];
}

if (isset($options['bsf_rt_padding_unit'])) {

    $bsf_rt_padding_unit = $options['bsf_rt_padding_unit'];
}

if (isset($options['bsf_rt_margin_unit'])) {

    $bsf_rt_margin_unit = $options['bsf_rt_margin_unit'];
}
?>
<div class="bsf_rt_global_settings" id="bsf_rt_global_settings">
<form method="post" name="bsf_rt_settings_form">
  <table class="form-table" >
       <br>     
       <p class="description">
          <?php _e('Control the position & appearance of the estimated read time of the post.' , 'bsf_rt_textdomain') ?>
      </p> 
      <tr>
        <th scope="row">
        <label for="ShowEstimatedReadTime"><?php _e('Show Estimated Read Time On' , 'bsf_rt_textdomain') ?>:</label>
        </th>
        <td>
          <label id="bsf_rt_single_checkbox_label" for="ForSinglePage" class="bsf_rt_show_readtime_label" >
            <?php
            if (isset($bsf_rt_show_read_time) && is_array($bsf_rt_show_read_time)) {
                if (in_array('bsf_rt_single_page', $bsf_rt_show_read_time)) {
                    echo ' <input id="bsf_rt_single_page" type="checkbox" checked name="bsf_rt_show_read_time[]" onclick="singlePage()" value="bsf_rt_single_page">';
                } else {
                    echo ' <input id="bsf_rt_single_page" type="checkbox" name="bsf_rt_show_read_time[]" onclick="singlePage()" value="bsf_rt_single_page">';
                }
            } else {
                echo '  <input id="bsf_rt_single_page" type="checkbox" checked name="bsf_rt_show_read_time[]" onclick="singlePage()" value="bsf_rt_single_page">'; 
            }
            ?>
         <?php _e('Single Post' , 'bsf_rt_textdomain') ?>
          </label> 
    
       <br>
            <label for="ForHomeBlogPage" class="bsf_rt_show_readtime_label">
            <?php
            if (isset($bsf_rt_show_read_time) && is_array($bsf_rt_show_read_time) && in_array('bsf_rt_home_blog_page', $bsf_rt_show_read_time) ) {
                echo ' <input id="bsf_rt_home_blog_page" type="checkbox" checked name="bsf_rt_show_read_time[]" value="bsf_rt_home_blog_page" onclick="homePage()">';
            } else {
                echo '  <input id="bsf_rt_home_blog_page" type="checkbox" name="bsf_rt_show_read_time[]" value="bsf_rt_home_blog_page" onclick="homePage()">';
            }
            ?>
         <?php _e('Home / Blog Page' , 'bsf_rt_textdomain') ?>
          </label> 
    
         <br>
            <label for="ForArchivePage" class="bsf_rt_show_readtime_label">
            <?php
            if (isset($bsf_rt_show_read_time) && is_array($bsf_rt_show_read_time) && in_array('bsf_rt_archive_page', $bsf_rt_show_read_time) ) {
                echo ' <input id="bsf_rt_archive_page" type="checkbox" checked name="bsf_rt_show_read_time[]" value="bsf_rt_archive_page" onclick="archivePage()">';
            } else {
                echo ' <input id="bsf_rt_archive_page"  type="checkbox" name="bsf_rt_show_read_time[]" value="bsf_rt_archive_page" onclick="archivePage()">';
            }
            ?>
         <?php _e('Archive Page' , 'bsf_rt_textdomain') ?>
          </label> 
    
          
        </td>
         
      </tr>
      <tr>
        <th scope="row">
          <label for="ShowReadTimePosition"> <?php _e('Read Time Position' , 'bsf_rt_textdomain') ?>:</label>
        </th>
        <td>
         <select id="bsf_rt_position_of_read_time" required name="bsf_rt_position_of_read_time" onchange="bsf_rt_readtimepositioncheck(this);">
            <?php 
            if (isset($bsf_rt_position_of_read_time)) {
                if ('above_the_content' === $bsf_rt_position_of_read_time) {
                    echo '<option selected value="above_the_content">';
                     _e('Above the Content' , 'bsf_rt_textdomain'); 
                     echo '</option>';
                } else {
                      echo '<option value="above_the_content">';
                     _e('Above the Content' , 'bsf_rt_textdomain'); 
                     echo '</option>';                }
                if ('above_the_post_title' === $bsf_rt_position_of_read_time) {

                    echo '<option selected value="above_the_post_title">';
                    _e('Above the Post Title' , 'bsf_rt_textdomain');
                    echo'</option>';
                } else {
                    echo '<option  value="above_the_post_title">';
                    _e('Above the Post Title' , 'bsf_rt_textdomain');
                    echo'</option>';
                }
                if ('below_the_post_title' === $bsf_rt_position_of_read_time) {
                    echo '<option selected value="below_the_post_title">';
                    _e('Below the Post Title' , 'bsf_rt_textdomain');
                    echo '</option>';
                } else {
                    echo '<option  value="below_the_post_title">';
                    _e('Below the Post Title' , 'bsf_rt_textdomain');
                    echo '</option>';
                }
                if ('none' === $bsf_rt_position_of_read_time) {
                    echo '<option selected value="none">';
                    _e('None' , 'bsf_rt_textdomain');
                    echo '</option>';
                } else {
                    echo '<option  value="none">';
                    _e('None' , 'bsf_rt_textdomain');
                    echo '</option>';
                }


            } else {

                      echo '<option value="above_the_content">';
                       _e('Above the Content' , 'bsf_rt_textdomain'); 
                      echo '</option>';
                      echo '<option  value="above_the_post_title">';
                      _e('Above the Post Title' , 'bsf_rt_textdomain');
                      echo'</option>';
                      echo '<option  value="below_the_post_title">';
                      _e('Below the Post Title' , 'bsf_rt_textdomain');
                      echo '</option>';
                      echo '<option  value="none">';
                      _e('None' , 'bsf_rt_textdomain');
                      echo '</option>';
                
            }

            ?>
            </select> 
        </td>
      </tr>
      </table>
      <table class="form-table" id="bsf_rt_read_time_option">
      <tr>
        <th scope="row">
          <label for="ReadingTimeMargin"><?php _e('Margin' , 'bsf_rt_textdomain'); ?> :</label>
        </th>
        <td>
           <input step="any" id="bsf_rt_margin" type="number" name="bsf_rt_read_time_margin_top" class="small-text" value="<?php echo $bsf_rt_read_time_margin_top; ?>" > 
           <input step="any" id="bsf_rt_margin" type="number" name="bsf_rt_read_time_margin_right" class="small-text" value="<?php echo $bsf_rt_read_time_margin_right; ?>" >
           <input step="any" id="bsf_rt_margin" type="number" name="bsf_rt_read_time_margin_bottom" class="small-text" value="<?php echo $bsf_rt_read_time_margin_bottom; ?>" > 
           <input step="any" id="bsf_rt_margin" type="number" name="bsf_rt_read_time_margin_left" class="small-text" value="<?php echo $bsf_rt_read_time_margin_left; ?>" >
           <select name="bsf_rt_margin_unit">
            <?php
            if ($bsf_rt_margin_unit == 'px') {

                echo '<option selected value="px">px</option>';
            } else {

                echo '<option  value="px">px</option>';
            }
            if ($bsf_rt_margin_unit == 'em') {

                echo '<option selected value="em">em</option>';
            } else {

                echo '<option  value="em">em</option>';
            }
            ?>
           </select>
        </td>
      
      </tr>
      <tr>
        <th scope="row">
          <label for="ReadingTimePadding"><?php _e('Padding' , 'bsf_rt_textdomain'); ?> :</label>
        </th>
        <td>
           <input step="any" id="bsf_rt_padding" type="number" name="bsf_rt_read_time_padding_top" class="small-text" value="<?php echo $bsf_rt_read_time_padding_top; ?>" >
           <input step="any" id="bsf_rt_padding" type="number" name="bsf_rt_read_time_padding_right" class="small-text" value="<?php echo $bsf_rt_read_time_padding_right; ?>" > 
           <input step="any" id="bsf_rt_padding" type="number" name="bsf_rt_read_time_padding_bottom" class="small-text" value="<?php echo $bsf_rt_read_time_padding_bottom; ?>" > 
           <input step="any" id="bsf_rt_padding" type="number" name="bsf_rt_read_time_padding_left" class="small-text" value="<?php echo $bsf_rt_read_time_padding_left; ?>" >
           <select name="bsf_rt_padding_unit">
            <?php
            if ($bsf_rt_padding_unit == 'px') {

                echo '<option selected value="px">px</option>';
            } else {

                echo '<option  value="px">px</option>';
            }
            if ($bsf_rt_padding_unit == 'em') {

                echo '<option selected value="em">em</option>';
            } else {

                echo '<option  value="em">em</option>';
            }
            ?>
           </select>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <label for="ReadingTimePostfixLabel"> <?php _e('Reading Time PreFix' , 'bsf_rt_textdomain'); ?>:</label>
        </th>
        <td>
            <?php if (isset($bsf_rt_reading_time_label) ) { ?>
          <input type="text"  name="bsf_rt_reading_time_prefix_label"  value="<?php echo $bsf_rt_reading_time_label;?>" class="regular-text">
            <?php } else { ?>
           <input type="text"  name="bsf_rt_reading_time_prefix_label" value="Reading Time" class="regular-text">
            <?php } ?>

          <p class="description">
            <?php _e('This value will Display before the Reading Time , Keep Blank for Reading Time.' , 'bsf_rt_textdomain'); ?>
          

          </p>  
        </td>
      </tr>
      <tr>
        <th scope="row">
         <label for="ReadingTimePrefixLabel"><?php _e('Reading Time PostFix' , 'bsf_rt_textdomain'); ?> :</label>
        </th>
        <td>
            <?php if (isset($bsf_rt_reading_time_postfix_label) ) { ?>
          <input type="text"  name="bsf_rt_reading_time_postfix_label" placeholder="mins" value="<?php echo $bsf_rt_reading_time_postfix_label;?>" class="regular-text">
            <?php } else { ?>
              <input type="text"  name="bsf_rt_reading_time_postfix_label" placeholder="mins" value="mins" class="regular-text">
            <?php } ?>
          <p class="description">  
          <?php _e('This value will Display after the Reading Time , Keep Blank for mins.' , 'bsf_rt_textdomain'); ?>                  
          
          </p>  
        </td>
      </tr>
      <tr >
          <th scope="row">
            <label for="ReadtimeFontSize"><?php _e('Font Size' , 'bsf_rt_textdomain'); ?>  :</label>
          </th>
          <td>
                <input type="number" name="bsf_rt_read_time_font_size" class="small-text" value="<?php echo $bsf_rt_read_time_font_size; ?>"  >&nbsp px
          </td>
        </tr> 
      <tr >
          <th scope="row"> 
            <label for="ReadtimeBackgroundColor"> <?php _e('Background Color' , 'bsf_rt_textdomain'); ?>:</label>
          </th>
          <td>
                <?php
                echo '<div id="bsf_rt_bg">';
                if (isset($bsf_rt_read_time_background_color)) { ?>
              <input  name="bsf_rt_read_time_background_color" class="my-color-field" value=" <?php echo $bsf_rt_read_time_background_color; ?>">
                <?php } else { ?>
               <input  name="bsf_rt_read_time_background_color" class="my-color-field" value="#eeeeee">
                <?php }
                echo '</div>';
                ?>
            
          </td>
        </tr> 
        <tr >
          <th scope="row">
            <label for="ReadTimeColor"> <?php _e('Color' , 'bsf_rt_textdomain'); ?> :</label>
          </th>  
          <td>
            <?php
            if (isset($bsf_rt_read_time_color)) { ?>
              <input name="bsf_rt_read_time_color" class="my-color-field" value="<?php echo $bsf_rt_read_time_color; ?>">
            <?php } else { ?>
              <input name="bsf_rt_read_time_color" class="my-color-field" value="#333333">
            <?php }
            ?>
           
          </td>
        </tr>
      </div>
</table>
<table class="form-table">
       <tr>
          <th>
            <?php wp_nonce_field( 'bsf-rt-nonce-reading', 'bsf-rt-reading' ); ?>
            <input type="submit" value="Save" class="bt button button-primary" name="submit">
          </th>
       </tr>
  </table>
  </form>
</div>


