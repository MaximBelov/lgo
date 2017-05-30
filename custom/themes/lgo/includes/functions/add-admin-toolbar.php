<?php
if (is_admin()) {
	if ($_GET['post']) {
		$post_id = $_GET['post'];
		$the_ID = (int)$post_id;
		$the_post = get_post($the_ID);

		print_r($the_post);

		if ($the_post->post_parent) {

			$parent = wp_get_post_parent_id($the_post->ID);
			$the_p_post = get_post($parent);
			$url = get_permalink($parent);
			// $string =(string)$url;

			print_r($the_p_post->guid);

			function webriti_toolbar_link($wp_admin_bar) {
				$args = array(
				'id' => 'parentpage',
				'title' => 'View Parent Page',
				'href' => $the_p_post->guid,
				'meta' => array(
					'class' => 'customlink',
					'title' => 'Parent'
					)
				);
				$wp_admin_bar->add_node($args);
			}
			add_action('admin_bar_menu', 'webriti_toolbar_link', 999);
		}

	}
}
?>