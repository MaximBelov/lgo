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

// Yoast Changes
add_action( 'wpseo_opengraph', 'my_gv_wpseo_opengraph_image', 10, 1);
function my_gv_wpseo_opengraph_image( $img ) {
    
    if( is_single()) {
        $FBCrop = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'facebook' );
        if($FBCrop != false) {
            $FBCard = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'facebook' );
            // $FBThumbnail = $FBCard[0];
            $img = $FBCard[0];
        } else {
            $img = get_the_post_thumbnail_url(get_the_ID(), 'large' );
        }
    } else {
        return;
    }

    $GLOBALS['wpseo_og']->image_output( $img ); 
}

// function enable_wpseo_twitter_image(){
//     if(is_single()){
//         $object = get_queried_object();
//         if($object && isset($object->name)){
//             $ID = getRelatedPageForCPT($object->name);
//             //first check if yoast seo metabox contains the image url
//             if($ID && get_post_meta($ID,'_yoast_wpseo_opengraph-image', true)){
//                 $img = get_post_meta($ID,'_yoast_wpseo_opengraph-image', true);
//                 $property = 'twitter:image';
//                 $content = $img[0];
//                 echo '<meta name="', esc_attr( $property ), '" content="', esc_attr( $content ), '" />', "\n";
//                 return;
//             }
//             if($ID && get_post_thumbnail_id($ID) != ''){
//                 $img = wp_get_attachment_image_src(get_post_thumbnail_id($ID),'full');
//                 $property = 'twitter:image';
//                 $content = $img[0];
//                 echo '<meta name="', esc_attr( $property ), '" content="', esc_attr( $content ), '" />', "\n";
//                 return;
//             }
//         }
//         $options = get_site_option('wpseo_social',null);
//         if($options && is_array($options)){
//             $property = 'twitter:image';
//             $content = $options['og_default_image'];
//             echo '<meta name="', esc_attr( $property ), '" content="', esc_attr( $content ), '" />', "\n";
//         }
//     }
// }

// add_action( 'wpseo_twitter_image', 'my_gv_wpseo_twitter_image', 10, 1);
// function my_gv_wpseo_twitter_image( $img ) {
    
//     if( is_single()) {
//         $TwitterCrop = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'twitter' );
//         if($TwitterCrop != false) {
//             $TwitterCard = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'twitter' );
//             $img = 'https://google.com/twitter.png';
//         } else {
//             $img = 'https://google.com/twitter.png';
//         }
//     } else {
//         return;
//     }

//     $GLOBALS['wpseo_twitter_image']->image_output( $img ); 
// }

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