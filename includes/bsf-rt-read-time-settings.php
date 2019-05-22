<?php
$options=get_option('bsf_rt_read_time_settings');
?>
<div class="bsf_rt_global_settings" id="bsf_rt_global_settings">
<form action="" method="post" name="bsf_rt_settings_form">
<table class="form-table" >
      <tr>
        <h3>Read Time</h3>
      </tr>
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
            if (isset($options['bsf_rt_show_read_time'])) {
              if ( in_array('bsf_rt_single_page', $options['bsf_rt_show_read_time'])) {
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
            if (isset($options['bsf_rt_show_read_time']) && in_array('bsf_rt_home_blog_page', $options['bsf_rt_show_read_time']) ) {
                echo ' <input id="bsf_rt_home_blog_page" type="checkbox" checked name="bsf_rt_show_read_time[]" value="bsf_rt_home_blog_page" onclick="homePage()">';
            } else {
                echo '  <input id="bsf_rt_home_blog_page" type="checkbox" name="bsf_rt_show_read_time[]" value="bsf_rt_home_blog_page" onclick="homePage()">';
            }
            ?>
         
          Home / Blog Page</label> 
    
         <br>
            <label for="ForArchivePage" class="bsf_rt_show_readtime_label">
            <?php
            if (isset($options['bsf_rt_show_read_time']) && in_array('bsf_rt_archive_page', $options['bsf_rt_show_read_time']) ) {
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
         <select id="bsf_rt_position_of_read_time" required name="bsf_rt_position_of_read_time">
            <?php 
            if (isset($options['bsf_rt_position_of_read_time'])) {
                if ('above_the_content' === $options['bsf_rt_position_of_read_time']) {
                    echo '<option selected value="above_the_content">Above the Content</option>';
                } else {
                    echo '<option  value="above_the_content">Above the Content</option>';
                }
                if ('above_the_post_title' === $options['bsf_rt_position_of_read_time']) {
                    echo '<option selected value="above_the_post_title">Above the Post Title</option>';
                } else {
                    echo '<option value="above_the_post_title">Above the Post Title</option>';
                }
                if ('below_the_post_title' === $options['bsf_rt_position_of_read_time']) {
                    echo '<option selected value="below_the_post_title">Below the Post Title</option>';
                } else {
                    echo '<option value="below_the_post_title">Below the Post Title</option>';
                }

            } else {

                echo '<option  value="above_the_content">Above the Content</option>';
                echo '<option value="above_the_post_title">Above the Post Title</option>';
                echo '<option value="below_the_post_title">Below the Post Title</option>';
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
          <?php if( isset($options['bsf_rt_reading_time_label']) ) { ?>
          <input type="text"  name="bsf_rt_reading_time_prefix_label" placeholder="mins" value="<?php echo $options['bsf_rt_reading_time_label'];?>" class="regular-text">
        <?php } else { ?>
           <input type="text"  name="bsf_rt_reading_time_prefix_label" placeholder="mins" value="Reading Time" class="regular-text">
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
           <?php if( isset($options['bsf_rt_reading_time_postfix_label']) ) { ?>
          <input type="text"  name="bsf_rt_reading_time_postfix_label" placeholder="mins" value="<?php echo $options['bsf_rt_reading_time_postfix_label'];?>" class="regular-text">
            <?php } else { ?>
              <input type="text"  name="bsf_rt_reading_time_postfix_label" placeholder="mins" value="mins" class="regular-text">
              <?php } ?>
          <p class="description">                    
          This value will Display after the Reading Time , Keep Blank for mins.
          </p>  
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

$bsf_rt_reading_time_label=$_POST['bsf_rt_reading_time_prefix_label'];
$bsf_rt_reading_time_postfix_label=$_POST['bsf_rt_reading_time_postfix_label'];
$bsf_rt_single_page=$_POST['bsf_rt_single_page'];
$bsf_rt_show_read_time=$_POST['bsf_rt_show_read_time'];
$bsf_rt_single_page_position_of_read_time=$_POST['bsf_rt_single_page_position_of_read_time'];
$bsf_rt_home_blog_page_position_of_read_time=$_POST['bsf_rt_home_blog_page_position_of_read_time'];
$bsf_rt_position_of_read_time=$_POST['bsf_rt_position_of_read_time'];
$update_options = array(
        'bsf_rt_reading_time_label'=> $bsf_rt_reading_time_label,
        'bsf_rt_reading_time_postfix_label'=> $bsf_rt_reading_time_postfix_label,
        'bsf_rt_position_of_read_time' => $bsf_rt_position_of_read_time,
        'bsf_rt_single_page' => $bsf_rt_single_page,
        'bsf_rt_show_read_time' => $bsf_rt_show_read_time,
        'bsf_rt_single_page_position_of_read_time' => $bsf_rt_single_page_position_of_read_time,
        'bsf_rt_home_blog_page_position_of_read_time' => $bsf_rt_home_blog_page_position_of_read_time,
        'bsf_rt_position_of_read_time' => $bsf_rt_position_of_read_time,
);
update_option('bsf_rt_read_time_settings', $update_options);
echo '<meta http-equiv="refresh" content="0.1" />';
}
