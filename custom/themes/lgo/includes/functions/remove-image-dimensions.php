<?php
	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
	function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	    return $html;
	}
?>