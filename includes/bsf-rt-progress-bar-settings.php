<?php
$options=get_option('bsf_rt_progress_bar_settings');
?>
<div class="bsf_rt_global_settings" id="bsf_rt_global_settings">
<form action="" method="post" name="bsf_rt_settings_form">
<table class="form-table">
      <tr>
        <h3>Progress Bar</h3>
      </tr>
       <p class="description">
        Control the position & appearance of the progress bar. Progress bar acts with the content that the user has read.
      </p> 
      <tr>
        <th scope="row">
        <label for="PositionofDisplayProgressBar">Display Position:</label>
        </th>
        <td>
          <select required id="bsf_rt_position_of_progress_bar" name="bsf_rt_position_of_progress_bar" onchange="bsd_rt_Progressbarpositioncheck(this);">
            <?php 
            if (isset($options['bsf_rt_position_of_progress_bar'])) {
                if ('top_of_the_page' === $options['bsf_rt_position_of_progress_bar']) {
                    echo '<option selected value="top_of_the_page">Top of the Page</option>';
                } else {
                    echo '<option value="top_of_the_page">Top of the Page</option>';
                }
                if ('bottom_of_the_page' === $options['bsf_rt_position_of_progress_bar']) {
                    echo '<option selected value="bottom_of_the_page">Bottom of the Page</option>';
                } else {
                    echo '<option value="bottom_of_the_page">Bottom of the Page</option>';
                }
                if ('none' === $options['bsf_rt_position_of_progress_bar']) {
                    echo '<option selected value="none">None</option>';
                } else {
                    echo '<option value="none">None</option>';
                }


            } else {
               echo '<option value="none">None</option>';
               echo '<option value="top_of_the_page">Top of the Page</option>';
               echo '<option value="bottom_of_the_page">Bottom of the Page</option>';
            }

            ?>
          </select>
        </td>
      </tr>
     </table>
     <table class="form-table" id="bsf-rt-progress-bar-options">  
      <tr>
        <th scope="row">
          <label for="ProgressBarStyle">Styles :</label>
        </th>
          <td>
            <select  name="bsf_rt_progress_bar_styles" id="bsf_rt_progress_bar_styles" onchange="bsd_rt_ColorSelectCheck_two(this);">
                <?php 
                if (isset($options['bsf_rt_progress_bar_styles'])) {
                    if ('Normal' === $options['bsf_rt_progress_bar_styles']) {
                        echo '<option id="normalcolor" selected value="Normal">Normal</option>';
                    } else {
                        echo '<option id="normalcolor" value="Normal">Normal</option>';
                    }
                    if ('Gradient' === $options['bsf_rt_progress_bar_styles']) {
                        echo '<option selected id="gradiantcolor" value="Gradient">Gradient</option>';
                    } else {
                        echo '<option id="gradiantcolor" value="Gradient">Gradient</option>';
                    }

                } else {
                    echo '<option id="normalcolor" value="Normal">Normal</option>';
                    echo '<option id="gradiantcolor" value="Gradient">Gradient</option>';
                  }

                ?>
                
                
             </select>
          </td>
        </tr>
           
        <tr id="normal-back-wrap">
          <th scope="row">
            <label for="ProgressBarBackgroundColor">Background Color :</label>
          </th>
          <td>
                <?php
                if (isset($options['bsf_rt_progress_bar_background_color'])) { ?>
              <input name="bsf_rt_progress_bar_background_color" class="my-color-field" value=" <?php echo $options['bsf_rt_progress_bar_background_color']; ?>">
                <?php } else { ?>
               <input name="bsf_rt_progress_bar_background_color" class="my-color-field" value="#E00078">
                <?php }
                ?>
            
          </td>
        </tr> 
        <tr id="normal-color-wrap">
          <th scope="row">
            <label for="ProgressBarColor"> Primary Color :</label>
          </th>  
          <td>
            <?php
            if (isset($options['bsf_rt_progress_bar_gradiant_one'])) { ?>
              <input name="bsf_rt_progress_bar_color_g1" class="my-color-field" value="<?php echo $options['bsf_rt_progress_bar_gradiant_one']; ?>">
            <?php } else { ?>
              <input name="bsf_rt_progress_bar_color_g1" class="my-color-field" value="#00ACE0">
            <?php }
            ?>
           
          </td>
        </tr>
       
        </tr>

        <tr id="gradiant-wrap2">
            <th scope="row">
              <label for="ProgressBarColor">Secondary Color :</label>
            </th>
            <td>
                <?php
                if (isset($options['bsf_rt_progress_bar_gradiant_two'])) { ?>
              <input name="bsf_rt_progress_bar_color_g2" class="my-color-field" value="<?php echo $options['bsf_rt_progress_bar_gradiant_two']; ?>">
                <?php } else { ?>
               <input name="bsf_rt_progress_bar_color_g2" class="my-color-field" value="#E00078">
                <?php }
                ?>
             
            </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="Thickness">Thickness :</label>
          </th>
          <td>
                <?php

                if (isset($options['bsf_rt_progress_bar_thickness'])) { ?>
              <input type="number" name="bsf_rt_progress_bar_thickness" class="small-text" value="<?php echo $options['bsf_rt_progress_bar_thickness']; ?>">&nbsppx
                <?php } else { ?>
               <input type="number" name="bsf_rt_progress_bar_thickness" class="small-text" value="10">&nbsppx
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
$bsf_rt_progress_bar_color=$_POST['bsf_rt_progress_bar_color'];
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
