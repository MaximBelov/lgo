<?php
add_filter( 'rwmb_meta_boxes', 'meta_box_group_accordion_register' );
function meta_box_group_accordion_register( $meta_boxes ) {

	$prefix = 'rw_';

	$meta_boxes[] = array(
	    'title'      => __( 'Banner', 'textdomain' ),
	    'post_types' => array( 'page'),
	    'fields' => array(
	        array(
	           'id'   => $prefix . 'banner_heading',
	           'name' => __( 'Heading', 'textdomain' ),
	           'type' => 'text',
	        ),
	        array(
	           'id'   => $prefix . 'banner_subheading',
	           'name' => __( 'Subheading', 'textdomain' ),
	           'type' => 'wysiwyg',
	        ),
	    ),
	);

	$meta_boxes[] = array(
		'title'  => __( 'More Info - Accordion Format' ),
		'post_types' => array('page' ),
		'fields' => array(
			array(
				'id'     => 'accordion_content',
				'type'   => 'group',
				'clone'  => true,
				'sort_clone' => true,
				'collapsible' => true,
				'group_title' => array( 'field' => $prefix . 'title' ), // ID of the subfield
				'save_state' => true,
				'fields' => array(
					array(
						'name' => __( 'Title', 'rwmb' ),
						'id'   => $prefix . 'title',
						'type' => 'text',
					),
					array(
						'name' => __( 'Content', 'rwmb' ),
						'id'   => $prefix . 'content',
						'type' => 'wysiwyg',
					),
				),
			),
		),
	);

	$meta_boxes[] = array(
		'title'  => __( 'Call to Action Buttons' ),
		'post_types' => array('page' ),
		'fields' => array(
			array(
				'id'     => 'cta',
				'type'   => 'group',
				'clone'  => true,
				'sort_clone' => true,
				'collapsible' => true,
				'group_title' => array( 'field' => $prefix . 'btn_label' ), // ID of the subfield
				'save_state' => true,
				'fields' => array(
					array(
						'name' => __( 'Label', 'rwmb' ),
						'id'   => $prefix . 'btn_label',
						'type' => 'text',
					),
					array(
						'name' => __( 'URL', 'rwmb' ),
						'id'   => $prefix . 'btn_url',
						'type' => 'text',
					),
				),
			),
		),
	);

	$meta_boxes[] = array(
        'title'      => __( 'Extra', 'textdomain' ),
        'post_types' => array( 'page'),
        'context'    => 'normal',
        'priority'   => '',
        'fields' => array(
            array(
                'name'  => __( 'Content', 'textdomain' ),
                'desc'  => '',
                'id'    => $prefix . 'extra_content',
                'type'  => 'wysiwyg',
                'clone' => false,
            ),
        )
    );

	return $meta_boxes;
}
?>