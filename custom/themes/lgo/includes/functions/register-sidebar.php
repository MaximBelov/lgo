<?php

/**
* Register Wordpress sidebar widget
*/

function translation_widgets_init() {

	register_sidebar(
		array(
	 	'name' => __( 'Translation' ),
	 	'id' => 'translation-widget',
	 	'description' => __( 'This contains the translation switcher.' ),
	  	'before_widget' => '',
	  	'after_widget' => '',
	  	'before_title' => '',
	  	'after_title' => '')
	);
}

add_action( 'widgets_init', 'translation_widgets_init' );


?>