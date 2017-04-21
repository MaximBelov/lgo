<?php

// Change the login logo - Image dimensions = 310px/70px
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/dist/images/lgemblem-admin.svg) !important; }
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

// Disable WordPress Login Hints
function no_wordpress_errors(){
  return 'Sorry, nothing to see here';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

// Change the footer text on WordPress dashboard
function remove_footer_admin () {
  echo "Lieutenant Governor of Ontario";
} 

add_filter('admin_footer_text', 'remove_footer_admin');

// Replace "Howdy" with "Logged in as" in WordPress bar
function replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy,', 'Logged in as:', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

// Remove WP blogroll on admin Dashboard
function remove_dashboard_widgets () {
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

?>