<?php

/**
* Changing the number of posts per page
*/

function textdomain_set_post_per_page( $query ) {
    if ( $query->is_main_query() )
        return;
 
    if ( $query->is_paged() && is_page('630') ) {
        $query->query_vars['posts_per_page'] = 13;
        return;
    }
}

add_action( 'pre_get_posts', 'textdomain_set_post_per_page', 1 );

?>