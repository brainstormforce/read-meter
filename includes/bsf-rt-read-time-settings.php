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
<form action="" method="post" name="bsf_rt_settings_form">
<table class="form-table" >
       <br>     
       <p class="description">
        Control the position & appearance of the estimated read time of the post.
      </p> 
      <tr>
        <th scope="row">
        <label for="ShowEstimatedReadTime">Show Estimated Read Time On:</label>
        </th>
        <td>
          <label id="bsf_rt_single_checkbox_label" for="ForSinglePage" class="bsf_rt_show_readtime_label" >
            <?php
            if (isset($bsf_rt_show_read_time) && is_array($bsf_rt_show_read_time)) {
              if ( in_array('bsf_rt_single_page', $bsf_rt_show_read_time)) {
                  echo ' <input id="bsf_rt_single_page" type="checkbox" checked name="bsf_rt_show_read_time[]" onclick="singlePage()" value="bsf_rt_single_page">';
              } else {
                  echo ' <input id="bsf_rt_single_page" type="checkbox" name="bsf_rt_show_read_time[]" onclick="singlePage()" value="bsf_rt_single_page">';
              }
            } else {
              echo '  <input id="bsf_rt_single_page" type="checkbox" checked name="bsf_rt_show_read_time[]" onclick="singlePage()" value="bsf_rt_single_page">'; 
            }
            ?>
         
          Single Post</label> 
    
       <br>
            <label for="ForHomeBlogPage" class="bsf_rt_show_readtime_label">
            <?php
            if (isset($bsf_rt_show_read_time) && is_array($bsf_rt_show_read_time) && in_array('bsf_rt_home_blog_page', $bsf_rt_show_read_time) ) {
                echo ' <input id="bsf_rt_home_blog_page" type="checkbox" checked name="bsf_rt_show_read_time[]" value="bsf_rt_home_blog_page" onclick="homePage()">';
            } else {
                echo '  <input id="bsf_rt_home_blog_page" type="checkbox" name="bsf_rt_show_read_time[]" value="bsf_rt_home_blog_page" onclick="homePage()">';
            }
            ?>
         
          Home / Blog Page</label> 
    
         <br>
            <label for="ForArchivePage" class="bsf_rt_show_readtime_label">
            <?php
            if (isset($bsf_rt_show_read_time) && is_array($bsf_rt_show_read_time) && in_array('bsf_rt_archive_page', $bsf_rt_show_read_time) ) {
                echo ' <input id="bsf_rt_archive_page" type="checkbox" checked name="bsf_rt_show_read_time[]" value="bsf_rt_archive_page" onclick="archivePage()">';
            } else {
                echo ' <input id="bsf_rt_archive_page"  type="checkbox" name="bsf_rt_show_read_time[]" value="bsf_rt_archive_page" onclick="archivePage()">';
            }
            ?>
         
          Archive Page</label> 
    
          
        </td>
         
      </tr>
      <tr>
        <th scope="row">
          <label for="ShowReadTimePosition">Read Time Position :</label>
        </th>
        <td>
         <select id="bsf_rt_position_of_read_time" required name="bsf_rt_position_of_read_time" onchange="bsf_rt_readtimepositioncheck(this);">
            <?php 
            if (isset($bsf_rt_position_of_read_time)) {
                if ('above_the_content' === $bsf_rt_position_of_read_time) {
                    echo '<option selected value="above_the_content">Above the Content</option>';
                } else {
                    echo '<option  value="above_the_content">Above the Content</option>';
                }
                if ('above_the_post_title' === $bsf_rt_position_of_read_time) {
                    echo '<option selected value="above_the_post_title">Above the Post Title</option>';
                } else {
                    echo '<option value="above_the_post_title">Above the Post Title</option>';
                }
                if ('below_the_post_title' === $bsf_rt_position_of_read_time) {
                    echo '<option selected value="below_the_post_title">Below the Post Title</option>';
                } else {
                    echo '<option value="below_the_post_title">Below the Post Title</option>';
                }
                if ('none' === $bsf_rt_position_of_read_time) {
                    echo '<option selected value="none">None</option>';
                } else {
                    echo '<option value="none">None</option>';
                }


            } else {

                echo '<option  value="above_the_content">Above the Content</option>';
                echo '<option value="above_the_post_title">Above the Post Title</option>';
                echo '<option value="below_the_post_title">Below the Post Title</option>';
                echo '<option value="none">None</option>';
            }

            ?>
            </select> 
        </td>
      </tr>
      </table>
      <table class="form-table" id="bsf_rt_read_time_option">
      <tr>
        <th scope="row">
          <label for="ReadingTimeMargin">Margin :</label>
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
          <label for="ReadingTimePadding">Padding :</label>
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
          <label for="ReadingTimePostfixLabel">Reading Time PreFix :</label>
        </th>
        <td>
          <?php if( isset($bsf_rt_reading_time_label) ) { ?>
          <input type="text"  name="bsf_rt_reading_time_prefix_label"  value="<?php echo $bsf_rt_reading_time_label;?>" class="regular-text">
        <?php } else { ?>
           <input type="text"  name="bsf_rt_reading_time_prefix_label" value="Reading Time" class="regular-text">
           <?php } ?>

          <p class="description">

          This value will Display before the Reading Time , Keep Blank for mins.

          </p>  
        </td>
      </tr>
      <tr>
        <th scope="row">
         <label for="ReadingTimePrefixLabel">Reading Time PostFix :</label>
        </th>
        <td>
           <?php if( isset($bsf_rt_reading_time_postfix_label) ) { ?>
          <input type="text"  name="bsf_rt_reading_time_postfix_label" placeholder="mins" value="<?php echo $bsf_rt_reading_time_postfix_label;?>" class="regular-text">
            <?php } else { ?>
              <input type="text"  name="bsf_rt_reading_time_postfix_label" placeholder="mins" value="mins" class="regular-text">
              <?php } ?>
          <p class="description">                    
          This value will Display after the Reading Time , Keep Blank for mins.
          </p>  
        </td>
      </tr>
      <tr >
          <th scope="row">
            <label for="ReadtimeFontSize">Font Size :</label>
          </th>
          <td>
                <input type="number" name="bsf_rt_read_time_font_size" class="small-text" value="<?php echo $bsf_rt_read_time_font_size; ?>"  >&nbsp px
          </td>
        </tr> 
      <tr >
          <th scope="row">
            <label for="ReadtimeBackgroundColor">Background Color :</label>
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
            <label for="ReadTimeColor"> Color :</label>
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
          <input type="submit" value="Save" class="bt button button-primary" name="submit">
          </th>
       </tr>
  </table>
  </form>
</div>

<?php
if (isset($_POST['submit'])) {

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
    echo '<meta http-equiv="refresh" content="0.1" />';
}
