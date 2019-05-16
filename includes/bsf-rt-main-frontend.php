<?php
echo '<h1> BSF ReadTime </h1>';
 
//Navigation

//To get the tab value from URL and store in $active_tab variable
 $active_tab = "bsf_rt_settings";
        if (isset($_GET["tab"])) {
            if ($_GET["tab"] == "bsf_rt_settings") {
                $active_tab = "bsf_rt_settings";
            } elseif ($_GET["tab"] == "bsf_rt_settings_backend") {
                $active_tab = "bsf_rt_settings_backend";
            }
          }  
?>
<?php

 //here we display the sections and options in the settings page based on the active tab
        if (isset($_GET["tab"])) {
            if ($_GET["tab"] == "bsf_rt_settings") {
                   include 'bsf-rt-settings-frontend.php';
            } elseif ($_GET["tab"] == "bsf_rt_settings_backend") {
                   include 'bsf-rt-settings-backend.php';
            }  
        }
        else
        {
            include 'bsf-rt-settings-frontend.php';
        }