<?php

/**
* Featured image support
*/

add_theme_support( 'post-thumbnails' );
add_image_size( 'banner', 1200, 800, true );
add_image_size( 'event-card', 500, 620, true);


add_filter( 'image_size_names_choose', 'wpshout_custom_sizes' );
function wpshout_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'banner' => __( 'Banner' ),
        'event-card' => __( 'Event Card' )
    ) );
}
?>