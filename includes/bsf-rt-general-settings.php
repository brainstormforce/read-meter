<?php
$options=get_option('bsf_rt_general_settings');
?>
<div class="bsf_rt_global_settings" id="bsf_rt_global_settings">
  <form action="" method="post" name="bsf_rt_settings_form">
    <table class="form-table" > 
      <tr>
        <h3> General Settings </h3>
      </tr>
      <p class="description">
        Control the core settings of a read meter, e.g. the average count of words that humans can read in a minute & allow a read meter on particular post types, etc.
      </p>  
      
      <tr>
        <th scope="row">
          <label for="WordsPerMinute">Words Per Minute :</label>
        </th>
        <td>
          <input type="number" required name="bsf_rt_words_per_minute" placeholder="275" value="<?php  echo $options['bsf_rt_words_per_minute'];?>" class="small-text">
        </td>
      </tr>

      <tr>
        <th scope="row">
          <label for="SelectPostTypes">Select Post Types :</label>
        </th>
        <td class="post_type_name">
            <?php
            $args = array(
            'public'   => true,
            
            );
           
            $exclude=array('attachment','elementor_library','Media','My Templates');

            foreach ( get_post_types($args, 'objects') as $post_type ) {

                if (in_array($post_type->labels->name, $exclude)  ) {
                    continue;
                } 
                if ($options['bsf_rt_post_types'] !== 'post') {
                if (isset($options['bsf_rt_post_types'])) {
                    if (in_array($post_type->name, $options['bsf_rt_post_types'])) {
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
        <th scope="row">
         <label for="IncludeComments">Include Comments :</label>
        </th>
        <td>
          <?php if (isset($options['bsf_rt_include_comments']) && $options['bsf_rt_include_comments'] == 'yes') {
             echo '<input type="checkbox" checked name="bsf_rt_include_comments" value="yes">';
          } else {
            echo '<input type="checkbox" name="bsf_rt_include_comments" value="yes">';
          }
         ?>
          <p class="description">                    
         Check if you want to count the comments in the Reading time.
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

$bsf_rt_words_per_minute=$_POST['bsf_rt_words_per_minute'];
$bsf_rt_post_types=$_POST['posts'];
$bsf_rt_include_comments=$_POST['bsf_rt_include_comments'];



$update_options = array(
  'bsf_rt_words_per_minute'   => $bsf_rt_words_per_minute,
  'bsf_rt_post_types'     => $bsf_rt_post_types,
  'bsf_rt_include_comments' => $bsf_rt_include_comments,

);
update_option('bsf_rt_general_settings', $update_options);
echo '<meta http-equiv="refresh" content="0.1" />';
}
