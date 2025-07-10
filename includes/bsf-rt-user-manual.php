<?php
/**
 * The Read meter User Manual tab
 *
 * @since      1.0.0
 * @package    BSF
 * @author     Pratik Chaskar.
 */

wp_enqueue_style( 'bsfrt_dashboard' );

?>
<div class="bsf_rt_user_manual">
	<br><label class="bsf_rt_page_title" for="howtouse">
		<?php esc_html_e( 'How to Use?', 'read-meter' ); ?>
		</label><br><br>
	<?php printf(esc_html__( '%1$sStep 1:%2$s Under the %1$sGeneral Settings%2$s Tab, select post types to display the Read Time and Progress bar. Select Words Per Minute and set other options if required.', 'read-meter' ),'<strong>','</strong>'); ?><br><br>
	<?php printf(esc_html__( '%1$sStep 2:%2$s Go to the %1$sRead Time%2$s Tab, and select target pages. Set position, prefix, postfix, and other styling options.', 'read-meter' ),'<strong>','</strong>'); ?><br><br>
	<?php printf(esc_html__( '%1$sStep 3:%2$s Go to the %1$sProgress Bar%2$s Tab, and select the position, colors, and thickness of the progress bar as per your need.', 'read-meter' ),'<strong>','</strong>'); ?><br><br>
	<?php printf(esc_html__( '%1$sStep 4:%2$s That\'s it! Visit Post/Page to see results.', 'read-meter' ),'<strong>','</strong>'); ?><br><br><br>
	<b><?php esc_html_e( 'Shortcode : [read_meter]', 'read-meter' ); ?></b> <br><br>
		<?php esc_html_e( 'You can also display the reading time wherever you want by using this shortcode , You just need to copy it and paste it in any content of Post or Page.', 'read-meter' ); ?><br>
		<?php printf(esc_html__( 'You can provide a simple ID attribute to the shortcode to display reading time of that particular post/page irrespective of where the shortcode is added, eg: %1$s[read_meter id=47]%2$s.', 'read-meter' ),'<strong>','</strong>'); ?>
</div>
