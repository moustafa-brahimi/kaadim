<?php

//  ============== TGM ================ // 

require_once get_template_directory() . "/includes/tgm/class-tgm-plugin-activation.php";

if( !function_exists( "kadim_register_required_plugins" ) ):

    function kadim_register_required_plugins() {

        	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// // This is an example of how to include a plugin bundled with a theme.
		// array(
		// 	'name'               => 'TGM Example Plugin', // The plugin name.
		// 	'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
		// 	'source'             => get_template_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
		// 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
		// 	'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
		// 	'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		// 	'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		// 	'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		// 	'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		// ),

		// This is an example of how to include a plugin from an arbitrary external source in your theme.
		// array(
		// 	'name'         => 'TGM New Media Plugin', // The plugin name.
		// 	'slug'         => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
		// 	'source'       => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
		// 	'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		// 	'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
		// ),

		// This is an example of how to include a plugin from a GitHub repository in your theme.
		// This presumes that the plugin code is based in the root of the GitHub repository
		// and not in a subdirectory ('/src') of the repository.
		// array(
		// 	'name'      => 'Adminbar Link Comments to Pending',
		// 	'slug'      => 'adminbar-link-comments-to-pending',
		// 	'source'    => 'https://github.com/jrfnl/WP-adminbar-comments-to-pending/archive/master.zip',
		// ),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Kirki Customizer Framework',
			'slug'      => 'kirki',
			'required'  => true,
		),

		// This is an example of the use of 'is_callable' functionality. A user could - for instance -
		// have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
		// 'wordpress-seo-premium'.
		// By setting 'is_callable' to either a function from that plugin or a class method
		// `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
		// recognize the plugin as being installed.
		// array(
		// 	'name'        => 'WordPress SEO by Yoast',
		// 	'slug'        => 'wordpress-seo',
		// 	'is_callable' => 'wpseo_init',
		// ),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(

		'id'           => 'kadim',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'kadim' ),
			'menu_title'                      => __( 'Install Plugins', 'kadim' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'kadim' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'kadim' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'kadim' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'kadim'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'kadim'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'kadim'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'kadim'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'kadim'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'kadim'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'kadim'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'kadim'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'kadim'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'kadim' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'kadim' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'kadim' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'kadim' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'kadim' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'kadim' ),
			'dismiss'                         => __( 'Dismiss this notice', 'kadim' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'kadim' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'kadim' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	    );

	    tgmpa( $plugins, $config );

    }

endif;


add_action( 'tgmpa_register', 'kadim_register_required_plugins' );

//  ============== Customizer ================ // 
 

if( class_exists( 'Kirki' ) ):
    require_once get_template_directory() . "/includes/customizer.php";
endif;

//  ============== Menu Walker ================ // 

require_once get_template_directory() . "/includes/BEM-menu-walker.php";


//  ============== Functions ================ // 


if( !function_exists( "is_true" ) ):

    function is_true( $val, $return_null=false ){

        $boolval = ( is_string($val) ? filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) : (bool) $val );

        return ( $boolval===null && !$return_null ? false : $boolval );

    }

endif;

 
//  ==============  // 


if( !function_exists( "kadim_scripts_styles" ) ):

    function kadim_scripts_styles() {

        wp_enqueue_script( "kadim-script", get_template_directory_uri() . "/assets/dist/js/bundle.js", array(), "0.0.1", true );

        wp_enqueue_style( "kadim-style", get_template_directory_uri() . "/assets/dist/css/style.css", array(), "0.0.1", "all" );

        wp_enqueue_style( "albert-sans-font", "https://fonts.googleapis.com/css2?family=Albert+Sans:wght@400;700&display=swap", array(), false, "all" );

		wp_localize_script( "kadim-script", "globals", array(

			"ajaxUrl" => admin_url('admin-ajax.php'),
			"loadMorePostsNonce" => wp_create_nonce("loadmore_posts_nonce")

		) );

    }

    
endif;

add_action( "wp_enqueue_scripts", "kadim_scripts_styles" );


//  ==============  // 


if( !function_exists( "kadim_theme_supports" ) ):

	function kadim_theme_supports() {

		$custom_logo_args = array(
			'height'               => 65,
			'width'                => 220,
			'flex-height'          => true,
			'flex-width'           => true,
			'header-text'          => array( 'site-title', 'site-description' ),
			'unlink-homepage-logo' => true, 
		);


		add_theme_support( 'custom-logo', $custom_logo_args );
		add_theme_support( 'post-thumbnails' );

	}

	
endif;

add_action( "after_setup_theme", "kadim_theme_supports" );

//  ==============  //

if( !function_exists( "kadim_nav_menus" ) ):

	function kadim_nav_menus() {

		$menus = [

			'navbar' => __( 'Main Menu', 'kadim' ),
			'footer' => __( 'Footer Menu', 'kadim' ),

		];

		register_nav_menus( $menus );

	}

	add_action( "after_setup_theme", "kadim_nav_menus" );
	

endif;



if( !function_exists( "kadim_widgets" ) ):

	function kadim_widgets() {

		$args = [

			'name' => __( 'Blog sidebar', 'kadim' ),
			'id' => 'kadim-1',
			'description' => __( 'Blog sidebar widgets' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
			'before_sidebar' => '<ul id="%1$s" class="%2$s sidebar__widgets">',
			'after_sidebar' => '</ul>',

		];

		register_sidebar( $args );

	}

	add_action("widgets_init", "kadim_widgets");


endif;


if( !function_exists( 'kadim_image_sizes' ) ):

	function kadim_image_sizes() {	
        add_image_size( 'kadim-macro', 90, 90, true );

		add_image_size( 'kadim-compact-slider-tall', 464, 600, true );
		add_image_size( 'kadim-compact-slider-medium', 464, 350, true );
		add_image_size( 'kadim-compact-slider-short', 464, 250, true );

		add_image_size( 'kadim-full-width-post-thumbnail', 980, 490, true );
	}
	
    add_action( 'after_setup_theme','kadim_image_sizes' );


endif;


if( !function_exists( 'kadim_excerpt_length' ) ):

	function kadim_excerpt_length( $num ) {

		return 30;

	}

	add_filter( 'excerpt_length', 'kadim_excerpt_length' );


endif;

if( !function_exists( 'kadim_excerpt_more' ) ):

	function kadim_excerpt_more() {

		return " &#8230;";

	}

	add_filter( 'excerpt_more', 'kadim_excerpt_more' );


endif;


// ajax load more

function kadim_loadmore_ajax() {

	if( !isset( $_POST[ 'nonce' ] ) || !isset( $_POST[ 'paged' ] ) ) { die(); } 

	// the paged variable sanitize and validate
	$paged = $_POST[ 'paged' ];
	if( !is_numeric( $paged ) ) { die(); };
	$paged =  absint( $paged );


	// the nonce variable sanitize and validate
	$nonce = $_POST[ 'nonce' ];

	if( !( is_string( $nonce ) && !empty( $nonce ) && wp_verify_nonce( $nonce, 'loadmore_posts_nonce' ) ) ) {
		die();
	}

	$query_args = array(

		"post_type"	=> "post",
		"post_status"	=>	"publish",
		"posts_per_page"=>	get_option( "posts_per_rss", 10 ),
		"paged" => $paged
	);

	$query = new WP_Query( $query_args );

	while( $query->have_posts() ):

		$query->the_post();

		get_template_part( "template-parts/content", "post" );


	endwhile;

	echo $query->max_num_pages . " - " . $paged;

	die();


}

add_action( "wp_ajax_loadmore_posts", "kadim_loadmore_ajax" );
add_action( "wp_ajax_nopriv_loadmore_posts", "kadim_loadmore_ajax" );

/**  */

function request($path) {
	return json_decode(file_get_contents($path), true); 
}