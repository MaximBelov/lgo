<?php
add_filter( 'rwmb_meta_boxes', 'lgo_register_list' );
function lgo_register_list( $meta_boxes ) {

	$prefix = 'rw_';

	$meta_boxes[] = array(
        'title'      => __( 'Details', 'textdomain' ),
        'post_types' => array( 'lg'),
        'context'    => 'normal',
        'priority'   => '',
        'fields' => array(
            array(
                'name'  => __( 'Date of Mandate', 'textdomain' ),
                'desc'  => '',
                'id'    => $prefix . 'lg_dates',
                'type'  => 'text',
                'clone' => false,
            ),
            array(
                'name'  => __( 'Number (Weight)', 'textdomain' ),
                'desc'  => '',
                'id'    => $prefix . 'lg_weight',
                'type'  => 'text',
                'clone' => false,
            ),
            array(
                'name'  => __( 'Years of Service', 'textdomain' ),
                'desc'  => '',
                'id'    => $prefix . 'lg_yos',
                'type'  => 'text',
                'clone' => false,
            ),
        )
    );

	return $meta_boxes;
}
?>