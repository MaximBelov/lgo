<?php

/**
* Register Wordpress sidebar widget
*/

register_sidebar(array(
 	'name' => __( 'Homepage Testimonial' ),
 	'id' => 'homepage-testimonial',
 	'description' => __( 'Widgets in this area will be shown on the homepage in the customer experience section.' ),
  	'before_widget' => '',
  	'after_widget' => '',
  	'before_title' => '<span class="hidden" style="display: none;">',
  	'after_title' => '</span>'
));

?>