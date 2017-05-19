<?php
//Load custom functions
require_once('includes/functions/enqueue-style.php');
require_once('includes/functions/enqueue-script.php');
require_once('includes/functions/image-support.php');
require_once('includes/functions/page-excerpts.php');
require_once('includes/functions/posts-per-page.php');
require_once('includes/functions/register-menu.php');
require_once('includes/functions/register-sidebar.php');
require_once('includes/functions/custom-admin-branding.php');
require_once('includes/functions/remove-admin-bar.php');
require_once('includes/functions/remove-header-meta.php');
// require_once('includes/functions/remove-menu-id.php');
// require_once('includes/functions/remove-wp-version.php');
require_once('includes/functions/grabfirstimage.php');
require_once('includes/functions/TwitterAPIExchange.php');
require_once('includes/functions/social-feed.php');
// Metabox.io
require_once('includes/metaboxio/page-meta-fields.php');
require_once('includes/metaboxio/lg-meta-fields.php');
// Adds Modification Column to Page admin
add_action ( 'manage_pages_custom_column',	'hype_heirch_columns',	10,	2	);
add_filter ( 'manage_edit-page_columns',	'hype_page_columns'				);

function hype_heirch_columns( $column, $post_id ) {

	switch ( $column ) {

	case 'modified':
		$m_orig		= get_post_field( 'post_modified', $post_id, 'raw' );
		$m_stamp	= strtotime( $m_orig );
		$modified	= date('n/j/y @ g:i a', $m_stamp );

	       	$modr_id	= get_post_meta( $post_id, '_edit_last', true );
	       	$auth_id	= get_post_field( 'post_author', $post_id, 'raw' );
	       	$user_id	= !empty( $modr_id ) ? $modr_id : $auth_id;
	       	$user_info	= get_userdata( $user_id );
	
	       	echo '<p class="mod-date">';
	       	echo '<em>'.$modified.'</em><br />';
	       	echo 'by <strong>'.$user_info->display_name.'<strong>';
	       	echo '</p>';

		break;

	// end all case breaks
	}

}

function hype_page_columns( $columns ) {

	$columns['modified']	= 'Last Modified';

	return $columns;

}
?>