<?php

/**
* Featured image support
*/

add_theme_support( 'post-thumbnails' );
add_image_size( 'banner', 1200, 800, true );
add_image_size( 'event-card', 500, 620, true);
add_image_size( 'twitter', 800, 418, true );
add_image_size( 'facebook', 1200, 630, true);
add_image_size( 'home-event', 710, 310, true);
add_image_size( 'home-static', 350, 160, true);


add_filter( 'image_size_names_choose', 'wpshout_custom_sizes' );
function wpshout_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'banner' => __( 'Banner' ),
        'event-card' => __( 'News Event Card' ),
        'twitter' => __( 'Twitter' ),
        'facebook' => __( 'Facebook' ),
        'home-event' => __( 'Home Event Card' ),
        'home-static' => __( 'Home Static Page Card' )
    ) );
}
?>