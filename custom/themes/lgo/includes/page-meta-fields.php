<?php

add_filter( 'rwmb_meta_boxes', 'meta_box_group_accordion_register' );
function meta_box_group_accordion_register( $meta_boxes ) {

	$prefix = 'rw_';
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
	return $meta_boxes;
}
?>