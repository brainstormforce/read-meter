<?php
$site_url=site_url();
$bsf_rt_reading_time_label=$_POST['bsf_rt_reading_time_label'];
$bsf_rt_reading_time_postfix_label=$_POST['bsf_rt_reading_time_postfix_label'];
$bsf_rt_words_per_minute=$_POST['bsf_rt_words_per_minute'];
$bsf_rt_position_of_read_time=$_POST['bsf_rt_position_of_read_time'];
$bsf_rt_post_types=$_POST['posts'];

$update_options = array(
		'bsf_rt_reading_time_label'=> $bsf_rt_reading_time_label,
		'bsf_rt_reading_time_postfix_label'=> $bsf_rt_reading_time_postfix_label,
		'bsf_rt_words_per_minute'   => $bsf_rt_words_per_minute,
		'bsf_rt_position_of_read_time' => $bsf_rt_position_of_read_time,
		'bsf_rt_post_types'     => $bsf_rt_post_types,
	);

update_option('bsf_rt',$update_options);
// var_dump(BSF_RT_PLUGIN_URL);

header('Location:'.$site_url.'/wp-admin/tools.php?page=bsf_rt');