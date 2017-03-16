<?php

/**
* Remove top admin wp bar
*/

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin() && !defined( 'DOING_AJAX' ) ) {
  		show_admin_bar(false);
		}
	}
?>