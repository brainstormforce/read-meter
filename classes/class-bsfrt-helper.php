<?php

class BSF_ReadTime_Helper {

	function __construct() {
		add_filter( 'the_content', function( $content ){
	    ob_start();

	    echo do_action( 'bsf_rt_before_content' );

	    $before_content = ob_get_clean();

	    ob_start();

	    echo do_action( 'bsf_rt_after_content' );

	    $after_content = ob_get_clean();

	    return $before_content . $content . $after_content;
	}
} );

new BSF_ReadTime_Helper();


add_action( 'bsf_rt_before_content', function () {
   
} );