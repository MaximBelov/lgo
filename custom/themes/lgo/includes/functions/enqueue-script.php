<?php

/**
* Enqueue scripts
*/

function my_scripts() {
	wp_enqueue_script('jquery');
	wp_deregister_script('wp-embed');
	//wp_deregister_script('jquery');
	wp_enqueue_script('lity', get_template_directory_uri() . '/src/js/lity.min.js', array(), '', true);
  	wp_enqueue_script('app', get_template_directory_uri() . '/dist/js/app.min.js?v=180202506p', array(), '', true);
}

add_action( 'wp_enqueue_scripts', 'my_scripts' );

function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$jquery_dependencies = $scripts->registered['jquery']->deps;
		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}
}
add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );
?>