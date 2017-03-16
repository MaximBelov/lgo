<?php

/**
* Remove junk from header
*/

remove_action('wp_head', 'rsd_link'); 				//Remove Really Simple Discovery (only really need this if you're using Flickr or similiar service)
remove_action('wp_head', 'wlwmanifest_link'); 		//Remove Windows Live Writer
remove_action('wp_head', 'start_post_rel_link');	//Remove Post Relational Links
remove_action('wp_head', 'index_rel_link');        	//Remove Post Relational Links
remove_action('wp_head', 'adjacent_posts_rel_link');//Remove Post Relational Links
remove_action('wp_head', 'wp_generator'); 			//Remove WP Generator
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles' );

?>