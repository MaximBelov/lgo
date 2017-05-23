<?php
add_action('admin_init', 'lgo_admin_init');
function lgo_admin_init(){
	// register_setting(
	// 	'writing',                 // settings page
	// 	'ozhwpe_options',          // option name
	// 	'ozhwpe_validate_options'  // validation callback
	// );
	
	// add_settings_field(
	// 	'ozhwpe_notify_boss',      // id
	// 	'Boss Email',              // setting title
	// 	'ozhwpe_setting_input',    // display callback
	// 	'writing',                 // settings page
	// 	'default'                  // settings section
	// );

	register_setting(
		'general',                 // settings page
		'lgo_sm-options',          // option name
		'lgo_validate_options'  // validation callback
	);

	add_settings_field(
		'lgo_twitter-handle',
		'LGO Twitter Handle',
		'lgo_setting_callback',
		'general',
		'lgo_social-accounts',
		array( 'label_for' => 'lgo_twitter-handle' )
	);

}
?>