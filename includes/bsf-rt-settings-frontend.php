<?php
?>
<div class="bsf_rt_global_settings" id="bsf_rt_global_settings">
    <form action="<?php echo "?page=bsf_rt&tab=bsf_rt_settings_backend"; ?>" method="post" name="bsf_rt_settings_form">
    <table class="form-table" > 
        <tr>
            <th>
                <h3> General Settings </h3>
            </th>
        </tr>
            <tr>
                  <th scope="row">
                    <label for="WordsPerMinute">Words Per Minute :</label>
                  </th>
                  <td>
                    <input type="number" required name="bsf_rt_words_per_minute" placeholder="275" value="275" class="regular-text">
                    <p class="description">
                        
                            Defaults to 275 , The average number of words an adult can read in a minute.
                        
                    </p>  
                  </td>
            </tr>
             <tr>
                  <th scope="row">
                    <label for="SelectPostTypes">Select Post Types</label>
                  </th>
                 <td>
                    <div class="multiselect">
                            <div class="selectBox" onclick="showCheckboxes()">
                              <select>
                                <option>Select an option</option>
                              </select>
                              <div class="overSelect"></div>
                            </div>
                            <div id="checkboxes">
                                    <?php
                              foreach ( get_post_types( '', 'names' ) as $post_type ) {
                                
                             echo '<br>'.'<input type="checkbox" name="posts[]" value="'.$post_type.'"/>' . $post_type;
                            }
                                ?>
                            </div>
                      </div>
                    <p class="description">
                     
                            Deafults to Above Post Content , Specify Position   Where Do you want to display the Reading Time
                     
                    </p>  
                  </td>
            </tr>
            <tr>
                <th>
                    <h3>Read Time</h3>
                  </th>
            </tr>
            <tr>
                  <th scope="row">
                    <label for="ShowEstimatedReadTime">Show Estimated Read Time On:</label>
                  </th>
                 <td>
                    <label for="ForSinglePage">
                        <input type="checkbox" name="Single Page" value="1">
                    Single Page</label> 
                  </td>
            </tr>
             <tr>
                  <th scope="row">
                    <label for="PositiontoDisplayReadTime">Position to Display Read Time:</label>
                  </th>
                 <td>
                         <select required name="bsf_rt_position_of_read_time">
                            <option value="<?php $options=get_option('bsf_rt'); echo $options['bsf_rt_position_of_read_time'];?>"><?php $options=get_option('bsf_rt'); echo $options['bsf_rt_position_of_read_time'];?></option>
                            <option value="none">None</option>
                            <option value="above_the_content">Above the Content</option>
                            <option value="above_the_post_title">Above the Post Title</option>
                            <option value="below_the_post_title">Below the Post Title</option>
                         </select>
                         <p class="description">
                        
                      Deafults to Above Post Content , Specify Position Where Do you want to display the Reading Time
                        
                    </p>  
                  </td>
            </tr>
             <tr>
                  <th scope="row">
                    <label for="ReadingTimePostfixLabel">Reading Time PreFix :</label>
                  </th>
                 <td>
                    <input type="text"  name="bsf_rt_reading_time_prefix_label" placeholder="mins" value="<?php $options=get_option('bsf_rt'); echo $options['bsf_rt_reading_time_label'];?>" class="regular-text">
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
                    <input type="text"  name="bsf_rt_reading_time_postfix_label" placeholder="mins" value="<?php $options=get_option('bsf_rt'); echo $options['bsf_rt_reading_time_postfix_label'];?>" class="regular-text">
                    <p class="description">
                     
                            This value will Display after the Reading Time , Keep Blank for mins.
                     
                    </p>  
                  </td>
            </tr>
             <tr>
                <th>
                    <h3>Progress Bar</h3>
                  </th>
            </tr>
            <tr>
                  <th scope="row">
                    <label for="PositionofDisplayProgressBar">Display Position:</label>
                  </th>
                  <td>
                    <select required name="bsf_rt_position_of_progress_bar">
                        <option value="none">None</option>
                        <option value="top_of_the_page">Top of the Page</option>
                        <option value="bottom_of_the_page">Bottom of the Page</option>
                    </select>
                   
                  </td>
            </tr>
             <tr>
                  <th scope="row">
                    <label for="ProgressBarStyle">Styles :</label>
                  </th>
                  <td>
                    <select required name="bsf_rt_progress_bar_styles">
                        <option value="Normal">Normal</option>
                        <option value="Gradient">Gradient</option>
                     </select>
                   
                  </td>
            </tr>
            <tr>
                  <th scope="row">
                    <label for="ProgressBarColor">Color :</label>
                  </th>
                  <td>
                   <input type="color" name="bsf_rt_progress_bar_color">
                  </td>
            </tr>
             <tr>
                  <th scope="row">
                    <label for="ProgressBarBackgroundColor">Background Color :</label>
                  </th>
                 <td>
                   <input type="color" name="bsf_rt_progress_bar_background_color">
                 </td>
            </tr>
             <tr>
                  <th scope="row">
                    <label for="Thickness">Thickness :</label>
                  </th>
                  <td>
                   <input type="number" name="bsf_rt_progress_bar_thickness">px
                  </td>
            </tr>
            
            <tr>
                      <th>
                      <input type="submit" value="Save" class="bt button button-primary" name="submit">
                      </th>
           </tr>
        </table>
    </form>
</div>