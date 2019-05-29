<?php
$options=get_option('bsf_rt_progress_bar_settings');

$bsf_rt_position_of_progress_bar = '';

$bsf_rt_progress_bar_styles = '';

$bsf_rt_progress_bar_background_color = '#e8d5ff';

$bsf_rt_progress_bar_gradiant_one = '#5540D9';

$bsf_rt_progress_bar_gradiant_two = '#ee7fff';

$bsf_rt_progress_bar_thickness = 12;

if (isset($options['bsf_rt_position_of_progress_bar'])) {

    $bsf_rt_position_of_progress_bar = $options['bsf_rt_position_of_progress_bar'];
}

if (isset($options['bsf_rt_progress_bar_styles'])) {

    $bsf_rt_progress_bar_styles = $options['bsf_rt_progress_bar_styles'];
}

if (isset($options['bsf_rt_progress_bar_background_color'])) {

    $bsf_rt_progress_bar_background_color = $options['bsf_rt_progress_bar_background_color'];
}

if (isset($options['bsf_rt_progress_bar_gradiant_one'])) {

    $bsf_rt_progress_bar_gradiant_one = $options['bsf_rt_progress_bar_gradiant_one'];
}

if (isset($options['bsf_rt_progress_bar_gradiant_two'])) {

    $bsf_rt_progress_bar_gradiant_two = $options['bsf_rt_progress_bar_gradiant_two'];
}

if (isset($options['bsf_rt_progress_bar_thickness'])) {

    $bsf_rt_progress_bar_thickness = $options['bsf_rt_progress_bar_thickness'];
}

?>
<div class="bsf_rt_global_settings" id="bsf_rt_global_settings">
  <form action="" method="post" name="bsf_rt_settings_form">
      <table class="form-table">
         <br>
         <p class="description">
          <?php _e('Control the position & appearance of the progress bar. Progress bar acts with the content that the user has read. (Note : The Progress Bar will only display on Singular Posts or Pages)' , 'bsf_rt_textdomain'); ?>
           

        </p> 
        <tr>
          <th scope="row"> 

            <label for="PositionofDisplayProgressBar"><?php _e('Display Position' , 'bsf_rt_textdomain'); ?>:</label>

          </th>
          <td>
            <select required id="bsf_rt_position_of_progress_bar" name="bsf_rt_position_of_progress_bar" onchange="bsf_rt_Progressbarpositioncheck(this);">
                <?php 
                if (isset($bsf_rt_position_of_progress_bar)) {

                    if ('top_of_the_page' === $bsf_rt_position_of_progress_bar) {

                        echo '<option selected value="top_of_the_page">';
                        _e('Top of the Page' , 'bsf_rt_textdomain');
                        echo'</option>';
                    } else {

                        echo '<option  value="top_of_the_page">';
                        _e('Top of the Page' , 'bsf_rt_textdomain');
                        echo'</option>';
                    }
                    if ('bottom_of_the_page' === $bsf_rt_position_of_progress_bar) {

                        echo '<option selected value="bottom_of_the_page">';
                        _e('Bottom of the Page' , 'bsf_rt_textdomain');
                        echo'</option>';
                    } else {

                        echo '<option  value="bottom_of_the_page">';
                        _e('Bottom of the Page' , 'bsf_rt_textdomain');
                        echo'</option>';
                    }
                    if ('none' === $bsf_rt_position_of_progress_bar) {

                        echo '<option selected value="none">';
                        _e('None' , 'bsf_rt_textdomain');
                        echo '</option>';
                    } else {

                        echo '<option  value="none">';
                        _e('None' , 'bsf_rt_textdomain');
                        echo '</option>';
                    }

                } else {
                      echo '<option  value="none">';
                          _e('None' , 'bsf_rt_textdomain');
                          echo '</option>';
                      echo '<option  value="top_of_the_page">';
                          _e('Top of the Page' , 'bsf_rt_textdomain');
                          echo'</option>';
                      echo '<option  value="bottom_of_the_page">';
                          _e('Bottom of the Page' , 'bsf_rt_textdomain');
                          echo'</option>';
                }

                ?>
            </select>
          </td>
        </tr>
       </table>
       <table class="form-table" id="bsf-rt-progress-bar-options">  
        <tr>
          <th scope="row"> 
            <label for="ProgressBarStyle"><?php _e('Styles' , 'bsf_rt_textdomain'); ?> :</label>
          </th>
            <td>
              <select  name="bsf_rt_progress_bar_styles" id="bsf_rt_progress_bar_styles" onchange="bsf_rt_ColorSelectCheck_two(this);">
                    <?php 
                    if (isset($bsf_rt_progress_bar_styles)) {

                        if ('Normal' === $bsf_rt_progress_bar_styles) {

                            echo '<option id="normalcolor" selected value="Normal">';
                            _e('Normal' , 'bsf_rt_textdomain');
                            echo '</option>';

                        } else {

                            echo '<option id="normalcolor"  value="Normal">';
                            _e('Normal' , 'bsf_rt_textdomain');
                            echo '</option>';
                        }
                        if ('Gradient' === $bsf_rt_progress_bar_styles) {

                            echo '<option selected id="gradiantcolor" value="Gradient">';
                            _e('Gradient' , 'bsf_rt_textdomain');
                            echo'</option>';

                        } else {

                            echo '<option  id="gradiantcolor" value="Gradient">';
                            _e('Gradient' , 'bsf_rt_textdomain');
                            echo'</option>';
                        }

                    } else {

                            echo '<option id="normalcolor"  value="Normal">';
                            _e('Normal' , 'bsf_rt_textdomain');
                            echo '</option>';
                            echo '<option  id="gradiantcolor" value="Gradient">';
                            _e('Gradient' , 'bsf_rt_textdomain');
                            echo'</option>';
                    }

                    ?>
              </select>
            </td>
        </tr>
        <tr id="normal-back-wrap">
            <th scope="row">

              <label for="ProgressBarBackgroundColor"><?php _e('Background Color' , 'bsf_rt_textdomain' ); ?> :</label>

            </th>
            <td>
                <?php
                if (isset($bsf_rt_progress_bar_background_color)) { ?>

                      <input name="bsf_rt_progress_bar_background_color" class="my-color-field" value=" <?php echo $bsf_rt_progress_bar_background_color; ?>">
                <?php } else { ?>

                          <input name="bsf_rt_progress_bar_background_color" class="my-color-field" value="#e8d5ff">

                <?php }
                ?>
              
            </td>
        </tr> 
        <tr id="normal-color-wrap">
            <th scope="row">
              <label for="ProgressBarColor"> <?php _e('Primary Color' , 'bsf_rt_textdomain' ); ?> :</label>
            </th>  
            <td>
                <?php
                if (isset($bsf_rt_progress_bar_gradiant_one)) { ?>

                <input name="bsf_rt_progress_bar_color_g1" class="my-color-field" value="<?php echo $bsf_rt_progress_bar_gradiant_one; ?>">

                <?php } else { ?>

                <input name="bsf_rt_progress_bar_color_g1" class="my-color-field" value="#5540D9">

                <?php }
                ?>
             
            </td>
        </tr>
        </tr>
        <tr id="gradiant-wrap2">
              <th scope="row">
                <label for="ProgressBarColor"> <?php _e('Secondary Color' , 'bsf_rt_textdomain' ); ?>:</label>
              </th>
              <td>
                    <?php
                    if (isset($bsf_rt_progress_bar_gradiant_two)) { ?>

                   <input name="bsf_rt_progress_bar_color_g2" class="my-color-field" value="<?php echo $bsf_rt_progress_bar_gradiant_two; ?>">
                    <?php } else { ?>

                      <input name="bsf_rt_progress_bar_color_g2" class="my-color-field" value="#ee7fff">
                    <?php }
                    ?>
               
              </td>
        </tr>
        <tr>
            <th scope="row">
                
              <label for="Thickness"><?php _e('Thickness' , 'bsf_rt_textdomain' ); ?> :</label>

            </th>
            <td>
                    <?php

                    if (isset($bsf_rt_progress_bar_thickness)) { ?>

                      <input type="number" required name="bsf_rt_progress_bar_thickness" class="small-text" value="<?php echo $bsf_rt_progress_bar_thickness; ?>">&nbsppx

                    <?php } else { ?>

                    <input type="number"  name="bsf_rt_progress_bar_thickness" class="small-text" value="12">&nbsppx

                    <?php }
                    ?>
             
            </td>
        </tr>
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
    echo '<meta http-equiv="refresh" content="0.1" />';
}
