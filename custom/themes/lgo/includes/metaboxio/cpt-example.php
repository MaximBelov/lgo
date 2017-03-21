<?php
add_filter( 'rwmb_meta_boxes', 'mq_register_team' );
function mq_register_team( $meta_boxes ) {
    $prefix = 'rw_';
    $meta_boxes[] = array(
        'title'      => __( 'Staff Meta', 'textdomain' ),
        'post_types' => array( 'team'),
        'context'    => 'normal',
        'priority'   => '',
        'fields' => array(
            array(
                'name'  => __( 'Role', 'textdomain' ),
                'desc'  => '',
                'id'    => $prefix . 'role',
                'type'  => 'text',
                'clone' => false,
            ),
             array(
                'name'  => __( 'Credentials', 'textdomain' ),
                'desc'  => '',
                'id'    => $prefix . 'creds',
                'type'  => 'text',
                'clone' => false,
            ),
            array(
                'name'  => __( 'LinkedIn', 'textdomain' ),
                'desc'  => 'Add LinkedIn profile URL. Example: http://...',
                'id'    => $prefix . 'linkedin',
                'type'  => 'url',
                'clone' => false,
            ),
        )
    );
    
    return $meta_boxes;
}
?>