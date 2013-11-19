<?php

/*
Plugin Name: Solvonauts Widget
Description: Facilitates the display of Solvonauts Content
Version: 0.2
Author: pgogy
Author URI: http://www.pgogy.com
*/
 
require_once( 'solvonauts_widget_ajax.php' ); 

add_action("wp_head","solvonauts_widget_add_scripts");		
	
function solvonauts_widget_add_scripts(){
	
	?><script type='text/javascript' src='<?PHP echo site_url(); ?>/wp-includes/js/jquery/jquery.js'></script>
	<link rel="stylesheet" href="<?PHP echo plugins_url("/css/solvonauts_widget.css" , __FILE__ ); ?>" />
	<script type="text/javascript" language="javascript" src="<?PHP echo plugins_url("/js/solvonauts_widget.js" , __FILE__ ); ?>"></script>
	<script type="text/javascript" language="javascript">
	var ajaxurl = '<?PHP echo site_url(); ?>/wp-admin/admin-ajax.php';	
	</script>
	<?PHP
	
}
 

function solvonauts_widget() {
	require_once( 'solvonauts_widget_class.php' );
	register_widget( 'solvonauts_widget' );
}
add_action( 'widgets_init', 'solvonauts_widget', 1 );


?>