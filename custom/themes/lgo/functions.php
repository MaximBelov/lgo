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
// require_once('includes/functions/remove-admin-bar.php');
// require_once('includes/functions/remove-header-meta.php');
// require_once('includes/functions/remove-menu-id.php');
// require_once('includes/functions/remove-wp-version.php');
require_once('includes/functions/grabfirstimage.php');
// require_once('includes/functions/TwitterAPIExchange.php');
// require_once('includes/functions/social-feed.php');
// Adds Modification Column to Page admin
require_once('includes/functions/add-admin-columns.php');
// Adds Buttons to Admin Toolbar
// require_once('includes/functions/add-admin-toolbar.php');
// Adds WPML language class to body
require_once('includes/functions/add-language-class.php');
// Metabox.io
require_once('includes/metaboxio/page-meta-fields.php');
require_once('includes/metaboxio/lg-meta-fields.php');
// Adds General Settings Fields
require_once('includes/functions/add-settings.php');

?>