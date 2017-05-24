<?php
add_filter('body_class', 'wpml_body_class');
function wpml_body_class($classes) {
    if(defined('ICL_LANGUAGE_CODE'))
    $classes[] = 'lang-' . ICL_LANGUAGE_CODE;
    return $classes;
}
?>