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
require_once('includes/functions/grabfirstimage.php');
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

// WPML Custom Code
// add_filter('icl_ls_languages', 'wpml_ls_filter');
// function wpml_ls_filter($languages) {
//     global $sitepress;

//     $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
//     if(ICL_LANGUAGE_CODE == 'fr') { 
//         print_r($url);
//         if(is_page_template( array('template-parent-page.php') ) == false){
//             foreach($languages as $lang_code => $language){
//                 if ($lang_code == 'en') {
//                     $new= str_replace("lang=fr&", "", $_SERVER["QUERY_STRING"]);
//                     $languages[$lang_code]['url'] = $languages[$lang_code]['url']. '?'.$new;
//                 } else {
//                     $new= str_replace("lang=fr&", "", $_SERVER["QUERY_STRING"]);
//                     $languages[$lang_code]['url'] = $languages[$lang_code]['url']. '&'.$new;
//                 }
                
//             }
//         }
//         return $languages;
//     } else {
//         print_r($url);
//         if(is_page_template( array('template-parent-page.php') )){
//             foreach($languages as $lang_code => $language){
//                 // print_r($lang_code.' ');
//                 if ($lang_code == 'en') {
//                     // $new= str_replace("lang=fr&", "", $_SERVER["QUERY_STRING"]);
//                     // $languages[$lang_code]['url'] = $languages[$lang_code]['url']. '?'.$new;
//                 } else {
//                     $new= str_replace("lang=fr&", "", $_SERVER["QUERY_STRING"]);
//                     $languages[$lang_code]['url'] = $languages[$lang_code]['url']. '&'.$new;
//                 }
                
//             }
//         }
//         return $languages;
//     }
// }
?>