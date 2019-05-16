<?php
?>
<div class="bsf_rt_global_settings" id="bsf_rt_global_settings">
    <h3> Global Settings </h3>
    <form action="<?php echo "?page=bsf_rt&tab=bsf_rt_settings_backend"; ?>" method="post" name="bsf_rt_settings_form">
    <table class="form-table" > 
            <tr>
                  <th scope="row">
                    <label for="ReadingTimeLabel">Reading Time Label :</label>
                  </th>
                  <td>
                    <input type="text"  name="bsf_rt_reading_time_label" placeholder="Reading Time" class="regular-text">
                    <p class="description">
                        This value will Display Before the Reading Time , Keep Blank for None.
                    </p>
                </td>
            </tr>
            <tr>
                  <th scope="row">
                    <label for="ReadingTimePostfixLabel">Reading Time PostFix :</label>
                  </th>
                 <td>
                    <input type="text"  name="bsf_rt_reading_time_postfix_label" placeholder="mins" value="mins" class="regular-text">
                    <p class="description">
                     
                            Default is mins , This value will Display after the Reading Time.
                     
                    </p>  
                  </td>
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
                    <label for="PositionofDisplayReadTime">Display Position for Reading Time :</label>
                  </th>
                  <td>
                    <select required name="bsf_rt_position_of_read_time" class="select short">
                        <option value="below_ast_header">Below The Astra header.</option>
                        <option value="above_the_content">Above The Post Content.</option>
                    </select>
                    <p class="description">
                        
                      Deafults to Above Post Content , Specify Position Where Do you want to display the Reading Time
                        
                    </p>  
                  </td>
            </tr>
             <tr>
                  <th scope="row">
                    <label for="PostTypes">Post types :</label>
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
                            
                          Deafults to Above Post Content , Specify Position Where Do you want to display the Reading Time
                            
                        </p>  
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
<script type="text/javascript">
    var expanded = false;
    function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>