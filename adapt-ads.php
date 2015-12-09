<?php
/*
Plugin Name: Adapt Ads
Plugin URI: http://adaptads.com
Description: Create ad images with text sections that can be replaced.
Version: 1.0
Author: John Cook
Author URI: http://adaptwp.com
License: GPLv2
*/

// Include the TGM_Plugin_Activation class.

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
 
    $plugins = array(

        // Include Advanced Custom Fields
        array(
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => true,
        )
 
    );
 

    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-required-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'The Adapt Ads Plugin requires the following plugin: %1$s.', 'The Adapt Ads Plugin requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'The Adapt Ads Plugin recommends the following plugin: %1$s.', 'The Adapt Ads Plugin recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
 
}
                        

function create_custom_ad_image() {
    register_post_type( 'custom_ad_images',
        array(
            'labels' => array(
                'name' => 'Adapt Ads',
                'singular_name' => 'Adapt Ads',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Image',
                'edit' => 'Edit',
                'edit_item' => 'Edit Image',
                'new_item' => 'New Image',
                'view' => 'View',
                'view_item' => 'View Image',
                'search_items' => 'Search Images',
                'not_found' => 'No Images Found',
                'not_found_in_trash' => 'No Images Found in Trash',
                'parent' => 'Parent Image'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-format-image',
            'has_archive' => true
        )
    );
    
    
    if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_ad-image-fields',
		'title' => 'Ad Image Fields',
		'fields' => array (
			array (
				'key' => 'field_550e1c2b18e21',
				'label' => 'Image',
				'name' => 'image',
				'type' => 'image',
				'required' => 1,
				'save_format' => 'object',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_550e1cb413108',
				'label' => 'Message Font',
				'name' => 'message_font',
				'type' => 'file',
				'instructions' => 'Upload a .ttf Font File',
				'required' => 1,
				'save_format' => 'object',
				'library' => 'all',
			),
			array (
				'key' => 'field_550e1d0b1310a',
				'label' => 'Font Size',
				'name' => 'font_size',
				'type' => 'number',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => '',
				'step' => 1,
			),
			array (
				'key' => 'field_550e1cf913109',
				'label' => 'Message Color',
				'name' => 'message_color',
				'type' => 'color_picker',
				'required' => 1,
				'default_value' => '',
			),
			array (
				'key' => 'field_550e2bae40024',
				'label' => 'Distance from Top',
				'name' => 'distance_from_top',
				'type' => 'number',
				'instructions' => 'Distance from the top of the image in pixels',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => '',
				'step' => 1,
			),
			array (
				'key' => 'field_550e2cd740025',
				'label' => 'Distance from Left',
				'name' => 'distance_from_left',
				'type' => 'number',
				'instructions' => 'Distance from the left of the image in pixels',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => '',
				'step' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'custom_ad_images',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}




// Add Additional MIME Type Support
function my_myme_types($mime_types){
    $mime_types['ttf'] = 'ttf'; //Add ttf extension
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

}

// Initialize the Plugin
add_action( 'init', 'create_custom_ad_image' );




?>