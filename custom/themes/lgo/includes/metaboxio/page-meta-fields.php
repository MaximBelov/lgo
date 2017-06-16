<?php
add_filter( 'rwmb_meta_boxes', 'meta_box_group_accordion_register' );
function meta_box_group_accordion_register( $meta_boxes ) {

	$prefix = 'rw_';

	$meta_boxes[] = array(
	    'title'      => __( 'Page Details', 'textdomain' ),
	    'post_types' => array( 'page'),
	    'exclude' => array(
	    	'relation'        => 'OR',
	    	'template'        => array( 'template-splash-page.php' ),
	    ),
	    'fields' => array(
	        array(
	           'id'   => $prefix . 'banner_heading',
	           'name' => __( 'Banner Heading', 'textdomain' ),
	           'type' => 'text',
	        ),
	        array(
	           'id'   => $prefix . 'banner_subheading',
	           'name' => __( 'Banner Subheading', 'textdomain' ),
	           'type' => 'wysiwyg',
	        ),
	        array(
	           'id'   => $prefix . 'banner_sidebar_bg',
	           'name' => __( 'Sidebar Background', 'textdomain' ),
	           'type' => 'file_input',
	        ),
	    ),
	);

	$meta_boxes[] = array(
	    'title'      => __( 'Post Options', 'textdomain' ),
	    'post_types' => array( 'post'),
	    'exclude' => array(
	    	'relation'        => 'OR',
	    	'template'        => array( 'template-splash-page.php' ),
	    ),
	    'fields' => array(
	        // array(
	        //    'id'   => $prefix . 'post_speech',
	        //    'name' => __( 'Speech?', 'textdomain' ),
	        //    'type' => 'checkbox',
	        //    // 'options' => array(
	        //    // 		'yes' => 'Yes',
	        //    // 		'no' => 'No'
	        //    // 	)
	        // ),
	        // array(
	        //    'id'   => $prefix . 'post_media',
	        //    'name' => __( 'Media document?', 'textdomain' ),
	        //    'type' => 'checkbox',
	        // ),
	        array(
	           'id'   => $prefix . 'post_template',
	           'name' => __( 'Split template?', 'textdomain' ),
	           'type' => 'checkbox',
	        ),
	    ),
	);

	$meta_boxes[] = array(
		'title'   => 'Home Feed Posts/Pages',
		'post_types' => array( 'page'),
		'include' => array(
			'relation'        => 'OR',
			'template'        => array( 'template-home.php' ),
		),

		'fields' => array(
			array(
			   'id'   => $prefix . 'featured_page_1',
			   'name' => __( 'Featured Page #1', 'textdomain' ),
			   'type' => 'post',
			   'post_type' => 'page',
			   'field_type' => 'select'
			),
			array(
			   'id'   => $prefix . 'featured_page_2',
			   'name' => __( 'Featured Page #2', 'textdomain' ),
			   'type' => 'post',
			   'post_type' => 'page',
			   'field_type' => 'select'
			),
			array(
			   'id'   => $prefix . 'featured_page_3',
			   'name' => __( 'Featured Page #3', 'textdomain' ),
			   'type' => 'post',
			   'post_type' => 'page',
			   'field_type' => 'select'
			),
			array(
			   'id'   => $prefix . 'featured_page_4',
			   'name' => __( 'Featured Page #4', 'textdomain' ),
			   'type' => 'post',
			   'post_type' => 'page',
			   'field_type' => 'select'
			),
			array(
			   'id'   => $prefix . 'featured_page_5',
			   'name' => __( 'Featured Page #5', 'textdomain' ),
			   'type' => 'post',
			   'post_type' => 'page',
			   'field_type' => 'select'
			),
			array(
			   'id'   => $prefix . 'featured_page_6',
			   'name' => __( 'Featured Page #6', 'textdomain' ),
			   'type' => 'post',
			   'post_type' => 'page',
			   'field_type' => 'select'
			),
			array(
			   'id'   => $prefix . 'featured_page_7',
			   'name' => __( 'Featured Page #7', 'textdomain' ),
			   'type' => 'post',
			   'post_type' => 'page',
			   'field_type' => 'select'
			),
			array(
			   'id'   => $prefix . 'featured_page_8',
			   'name' => __( 'Featured Page #8', 'textdomain' ),
			   'type' => 'post',
			   'post_type' => 'page',
			   'field_type' => 'select'
			)
		),
	);

	$meta_boxes[] = array(
		'title'   => 'Home Feed CTAs',
		'post_types' => array( 'page'),
		'include' => array(
			'relation'        => 'OR',
			'template'        => array( 'template-home.php' ),
		),

		'fields' => array(
			array(
			   'id'   => $prefix . 'cta_1_title',
			   'name' => __( 'CTA #1 Title', 'textdomain' ),
			   'type' => 'text',
			),
			array(
			   'id'   => $prefix . 'cta_1_link',
			   'name' => __( 'CTA #1 Link', 'textdomain' ),
			   'type' => 'text',
			),
			array(
			   'id'   => $prefix . 'cta_2_title',
			   'name' => __( 'CTA #2 Title', 'textdomain' ),
			   'type' => 'text',
			),
			array(
			   'id'   => $prefix . 'cta_2_link',
			   'name' => __( 'CTA #2 Link', 'textdomain' ),
			   'type' => 'text',
			),
			array(
			   'id'   => $prefix . 'cta_3_title',
			   'name' => __( 'CTA #3 Title', 'textdomain' ),
			   'type' => 'text',
			),
			array(
			   'id'   => $prefix . 'cta_3_link',
			   'name' => __( 'CTA #3 Link', 'textdomain' ),
			   'type' => 'text',
			)
		),
	);

	$meta_boxes[] = array(
		'title'   => 'Welcome Page Options',
		'post_types' => array( 'page'),
		'include' => array(
			'relation'        => 'OR',
			'template'        => array( 'template-splash-page.php' ),
		),

		'fields' => array(
			array(
			   'id'   => $prefix . 'splash_en_heading',
			   'name' => __( 'EN Heading', 'textdomain' ),
			   'type' => 'text',
			),
			array(
			   'id'   => $prefix . 'splash_en_copy',
			   'name' => __( 'EN Copy', 'textdomain' ),
			   'type' => 'wysiwyg',
			),
			array(
			   'id'   => $prefix . 'splash_fr_heading',
			   'name' => __( 'FR Heading', 'textdomain' ),
			   'type' => 'text',
			),
			array(
			   'id'   => $prefix . 'splash_fr_copy',
			   'name' => __( 'FR Copy', 'textdomain' ),
			   'type' => 'wysiwyg',
			)
		),
	);

	$meta_boxes[] = array(
		'title'  => __( 'More Info - Accordion Format' ),
		'post_types' => array('page', 'post' ),
		'exclude' => array(
			'relation'        => 'OR',
			'template'        => array( 'template-splash-page.php' ),
		),
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
		'title'  => __( 'Photo Gallery' ),
		'post_types' => array('page', 'post'),
		'exclude' => array(
			'relation'        => 'OR',
			'template'        => array( 'template-splash-page.php' ),
		),
		'fields' => array(
			array(
				'id'     => 'gallery_content',
				'type'   => 'group',
				'clone'  => true,
				'sort_clone' => true,
				'collapsible' => true,
				'group_title' => array( 'field' => $prefix . 'gal_title' ), // ID of the subfield
				'save_state' => true,
				'fields' => array(
					array(
						'name' => __( 'Title', 'rwmb' ),
						'id'   => $prefix . 'gal_title',
						'type' => 'text',
					),
					array(
						'name' => __( 'Image', 'rwmb' ),
						'id'   => $prefix . 'gal_photo',
						'type' => 'file_input',
					),
					array(
						'name' => __( 'Content', 'rwmb' ),
						'id'   => $prefix . 'gal_content',
						'type' => 'wysiwyg',
					),
				),
			),
		),
	);

	$meta_boxes[] = array(
		'title'  => __( 'Call to Action Section' ),
		'post_types' => array('page' ),
		'exclude' => array(
			'relation'        => 'OR',
			'template'        => array( 'template-splash-page.php' ),
		),
		'fields' => array(
			array(
			   'id'   => $prefix . 'cta_blurb',
			   'name' => __( 'CTA Intro', 'textdomain' ),
			   'type' => 'wysiwyg',
			),
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
        'exclude' => array(
			'relation'        => 'OR',
			'template'        => array( 'template-splash-page.php' ),
		),
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