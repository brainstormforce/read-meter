<?php 
/**
 * Add submenu of Global settings Page to admin menu.
 *
 * @since  1.0.0
 * @return void
 */

if (! class_exists('BSF_RT_Page') ) :
	
	class BSF_RT_Page {
		 /**
		 * Constructor
		 */
		public function __construct() {
			add_action('admin_menu', array($this,'BSF_RT_Settings_page'));
		}
		public function BSF_RT_Settings_page()
		{
		    add_submenu_page(
		        'options-general.php',
		        'Read Meter',
		        'Read Meter',
		        'manage_options',
		        'bsf_rt',
		        array($this,'BSF_RT_Page_html'),
		    );
		}
		/**
		 * Main Frontpage.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function BSF_RT_Page_html()
		{
		    
		    require_once BSF_RT_ABSPATH.'includes/bsf-rt-main-frontend.php';   
		}
	}	
$fl = new BSF_RT_Page();
endif;