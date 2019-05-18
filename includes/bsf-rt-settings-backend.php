<?php
$site_url=site_url();
$bsf_rt_reading_time_label=$_POST['bsf_rt_reading_time_prefix_label'];
$bsf_rt_reading_time_postfix_label=$_POST['bsf_rt_reading_time_postfix_label'];
$bsf_rt_words_per_minute=$_POST['bsf_rt_words_per_minute'];
$bsf_rt_position_of_read_time=$_POST['bsf_rt_position_of_read_time'];
$bsf_rt_post_types=$_POST['posts'];
$bsf_rt_position_of_progress_bar=$_POST['bsf_rt_position_of_progress_bar'];
$bsf_rt_progress_bar_color=$_POST['bsf_rt_progress_bar_color'];
$bsf_rt_progress_bar_background_color=$_POST['bsf_rt_progress_bar_background_color'];
$bsf_rt_progress_bar_thickness=$_POST['bsf_rt_progress_bar_thickness'];
$bsf_rt_progress_bar_styles=$_POST['bsf_rt_progress_bar_styles'];
$bsf_rt_single_page=$_POST['bsf_rt_single_page'];
$bsf_rt_progress_bar_gradiant_one=$_POST['bsf_rt_progress_bar_color_g1'];
$bsf_rt_progress_bar_gradiant_two=$_POST['bsf_rt_progress_bar_color_g2'];


$update_options = array(
        'bsf_rt_reading_time_label'=> $bsf_rt_reading_time_label,
        'bsf_rt_reading_time_postfix_label'=> $bsf_rt_reading_time_postfix_label,
        'bsf_rt_words_per_minute'   => $bsf_rt_words_per_minute,
        'bsf_rt_position_of_read_time' => $bsf_rt_position_of_read_time,
        'bsf_rt_post_types'     => $bsf_rt_post_types,
        'bsf_rt_position_of_progress_bar' => $bsf_rt_position_of_progress_bar,
        'bsf_rt_progress_bar_color' => $bsf_rt_progress_bar_color,
        'bsf_rt_progress_bar_styles' => $bsf_rt_progress_bar_styles,
        'bsf_rt_progress_bar_background_color' => $bsf_rt_progress_bar_background_color,
        'bsf_rt_progress_bar_gradiant_one'=>$bsf_rt_progress_bar_gradiant_one,
        'bsf_rt_progress_bar_gradiant_two'=>$bsf_rt_progress_bar_gradiant_two,
        'bsf_rt_progress_bar_thickness' => $bsf_rt_progress_bar_thickness,
        'bsf_rt_single_page' => $bsf_rt_single_page,

    );

update_option('bsf_rt', $update_options);
// var_dump(BSF_RT_PLUGIN_URL);

header('Location:'.$site_url.'/wp-admin/tools.php?page=bsf_rt');
