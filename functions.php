<?php

/** rouh text domain */

add_action('after_setup_theme', 'rouh_text_domain');

function rouh_text_domain(){
    load_theme_textdomain('rouh', get_template_directory() . '/languages');
}

//  ============== TGM ================ // 

require_once get_template_directory() . "/includes/tgm/class-tgm-plugin-activation.php";

if( !function_exists( "rouh_register_required_plugins" ) ):

    function rouh_register_required_plugins() {

 
	$plugins = array(


		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => __( 'Kirki Customizer Framework', 'rouh'),
			'slug'      => 'kirki',
			'required'  => true,
		),


	);


	$config = array(

		'id'           => 'rouh',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


	    );

	    tgmpa( $plugins, $config );

    }

endif;


add_action( 'tgmpa_register', 'rouh_register_required_plugins' );

//  ============== Customizer ================ // 
 

if( class_exists( 'Kirki' ) ):

	function rouh_customizer_controls() {
    	require_once get_template_directory() . "/includes/customizer.php";
	}

	add_action( 'after_setup_theme', "rouh_customizer_controls" );
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

/** supported body fonts */

function rouh_supported_body_fonts() {

	return apply_filters( "rouh_supported_body_fonts_filter",

		[
			"poppins"	=>	[
				"label"	=>	__( "Poppins", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap",
			],

			"roboto"	=>	[
				"label"	=>	__( "Roboto", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap",
			],

			"cairo"	=>	[
				"label"	=>	__( "Cairo", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap",
			],

			"nunito"	=>	[
				"label"	=>	__( "Nunito", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap",
			],

			"raleway"	=>	[
				"label"	=>	__( "Raleway", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap",
			],

			"alexandria"	=>	[
				"label"	=>	__( "Alexandria", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Alexandria:wght@400;500;600;700&display=swap",
			],

			"tajawal"	=>	[
				"label"	=>	__( "Tajawal", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap",
			],

			"Noto Sans Arabic"	=>	[
				"label"	=>	__( "Noto Sans Arabic", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap",
			],

			"changa"	=>	[
				"label"	=>	__( "Changa", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Changa:wght@400;500;600;700&display=swap",
			],

			"Noto Kufi Arabic"	=>	[
				"label"	=>	__( "Noto Kufi Arabic", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@400;500;600;700&display=swap",
			],

			"El Messiri"	=>	[
				"label"	=>	__( "El Messiri", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap",
			],

			"Readex Pro"	=>	[
				"label"	=>	__( "Readex Pro", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Readex+Pro:wght@400;500;600;700&display=swap",
			],

			"Noto Naskh Arabic"	=>	[
				"label"	=>	__( "Noto Naskh Arabic", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap",
			],

			"kufam"	=>	[
				"label"	=>	__( "Kufam", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Kufam:wght@400;500;600;700&display=swap",
			],

			"vazirmatn"	=>	[
				"label"	=>	__( "Vazirmatn", "rouh" ),
				"src"	=>	"https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700&display=swap",
			],

		]

	);

}



//  ==============  // 


if( !function_exists( "rouh_scripts_styles" ) ):

    function rouh_scripts_styles() {

        wp_enqueue_script( "rouh-script", get_template_directory_uri() . "/assets/dist/js/bundle.js", array(), "1.0.1", true );

        wp_enqueue_style( "rouh-style", get_template_directory_uri() . "/assets/dist/css/style.css", array(), "1.0.1", "all" );

		$supported_fonts = rouh_supported_body_fonts();
		$body_typography = get_theme_mod( "rouh_body_typography", "poppins" );
		$font_src = $supported_fonts[$body_typography]["src"];

		wp_enqueue_style( "rouh-body-font", $font_src );

		$headings_typography = get_theme_mod( "rouh_headings_typography", [ "font-family" => "DM Serif Display" ] );

		if( class_exists( 'Kirki' ) ):
			wp_add_inline_style( "rouh-style", 
			
				sprintf( ':root{--body-font-family:%s; --headlines-font-family:%s;}',
					$body_typography,
					$headings_typography["font-family"]
				) 
			
			);
		endif;

		wp_localize_script( "rouh-script", "globals", array(

			"ajaxUrl" => admin_url('admin-ajax.php'),
			"loadMorePostsNonce" => wp_create_nonce("loadmore_posts_nonce"),
			"accentColor" => get_theme_mod( 'rouh_accent_color', '#c2ece7' )

		) );

		wp_enqueue_script( "comment-reply" );

    }

    
endif;

add_action( "wp_enqueue_scripts", "rouh_scripts_styles" );


//  ==============  // 


if( !function_exists( "rouh_theme_supports" ) ):

	function rouh_theme_supports() {

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
		add_theme_support( "title-tag" );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array(
			// Any or all of these.
			// 'comment-list', 
			'comment-form',
			'search-form',
			'gallery',
			'caption',
		) );
		# add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link' ) );

		add_theme_support( "title-tag" );
		add_theme_support( 'editor-styles' );
		add_editor_style();
		
	}

	
endif;

add_action( "after_setup_theme", "rouh_theme_supports" );

//  ==============  //

if( !function_exists( "rouh_nav_menus" ) ):

	function rouh_nav_menus() {

		$menus = [
			'navbar' => __( 'Main Menu', 'rouh' ),
		];

		register_nav_menus( $menus );

	}

	add_action( "after_setup_theme", "rouh_nav_menus" );
	

endif;



if( !function_exists( "rouh_widgets" ) ):

	function rouh_widgets() {

		$args = [

			'name' => __( 'Blog sidebar', 'rouh' ),
			'id' => 'rouh-1',
			'description' => __( 'Blog sidebar widgets', 'rouh' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
			'before_sidebar' => '<ul id="%1$s" class="%2$s sidebar__widgets">',
			'after_sidebar' => '</ul>',

		];

		register_sidebar( $args );

		register_sidebar(array(
			'name' => __( 'Footer Center', 'rouh' ),
			'id'   => 'rouh-footer-center-widget',
			'description'   => __( 'Centre Footer widget position.', 'rouh' ),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
			'before_sidebar' => '<ul id="%1$s" class="%2$s rouh-footer__widgets">',
			'after_sidebar' => '</ul>',

		));
	

	

	}

	add_action("widgets_init", "rouh_widgets");


endif;


if( !function_exists( 'rouh_image_sizes' ) ):

	function rouh_image_sizes() {	
        add_image_size( 'rouh-macro', 48, 48, true );

		add_image_size( 'rouh-compact-slider-tall', 464, 600, true );
		add_image_size( 'rouh-compact-slider-medium', 464, 350, true );
		add_image_size( 'rouh-compact-slider-short', 464, 250, true );

		add_image_size( 'rouh-full-width-post-thumbnail', 980, 490, true );
	}
	
    add_action( 'after_setup_theme','rouh_image_sizes' );


endif;


if( !function_exists( 'rouh_excerpt_length' ) ):

	function rouh_excerpt_length( $num ) {

		return 30;

	}

	add_filter( 'excerpt_length', 'rouh_excerpt_length' );


endif;

if( !function_exists( 'rouh_excerpt_more' ) ):

	function rouh_excerpt_more() {

		return " &#8230;";

	}

	add_filter( 'excerpt_more', 'rouh_excerpt_more' );


endif;


// ajax load more

function rouh_loadmore_ajax() {

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
		"posts_per_page"=>	get_option( "posts_per_page", 10 ),
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

add_action( "wp_ajax_loadmore_posts", "rouh_loadmore_ajax" );
add_action( "wp_ajax_nopriv_loadmore_posts", "rouh_loadmore_ajax" );

/**  */

function request($path) {
	return json_decode(file_get_contents($path), true); 
}

//estimated reading time

if( !function_exists( "rouh_reading_time" ) ):

	function rouh_reading_time() {
		$content = get_post_field( 'post_content', get_the_ID() );
		$word_count = str_word_count( strip_tags( $content ) );
		$readingtime = ceil($word_count / 200);
		
		return sprintf( "%d %s", $readingtime, _n( "Minute", "Minutes", $readingtime, "rouh" ) );
	}

endif;


/** author social links */

function rouh_user_profile_supported_socials() {

	return apply_filters( "rouh_user_profile_supported_socials", [
		
		"facebook" => [ 
			"label" => __( "Facebook", "rouh" ),
			"faicon" => "fa-brands fa-facebook"
		],

		"instagram" => [ 
			"label" => __( "Instagram", "rouh" ),
			"faicon" => "fa-brands fa-instagram"
		],

		"twitter" => [ 
			"label" => __( "Twitter", "rouh" ),
			"faicon" => "fa-brands fa-twitter"
		],
		
		"linkedin" => [ 
			"label" => __( "LinkedIn", "rouh" ),
			"faicon" => "fa-brands fa-linkedin"
		],
		"discord" => [ 
			"label" => __( "Discord", "rouh" ),
			"faicon" => "fa-brands fa-discord"
		],
		"pinterest" => [ 
			"label" => __( "Pinterest", "rouh" ),
			"faicon" => "fa-brands fa-pinterest"
		],
		"behance" => [ 
			"label" => __( "Behance", "rouh" ),
			"faicon" => "fa-brands fa-behance"
		],
		"youtube" => [ 
			"label" => __( "Youtube", "rouh" ),
			"faicon" => "fa-brands fa-youtube"
		],

	]);

}


add_action( 'show_user_profile', 'rouh_user_profile_socials' );
add_action( 'edit_user_profile', 'rouh_user_profile_socials' );

function rouh_user_profile_socials( $user ) { 
	
	$socials = rouh_user_profile_supported_socials();

	$saved_values = get_user_meta( $user->ID, "rouh_social_links", true );
	
	wp_nonce_field( "rouh_verify_profile", "rouh_social_links_nonce" );

	$html = sprintf( "<h3>%s</h3>", esc_html__("Author Socials", "rouh") ); 
	$html .= '<table class="form-table">';
	
	foreach( $socials as $index => $social ):

		$label = $social["label"];

		$saved_value = ( isset( $saved_values[$index] ) ? $saved_values[$index] : "" );

		$html .= '<tr>';

		$html .= sprintf( '<th><label for="rouh-social-%s">%s</label></th>', esc_attr($index), esc_html($label) );
		$html .= sprintf( 
			'<td><input type="url" id="rouh-social-%s" name="rouh_social_links[%s]" placeholder="%s" value="%s" /></td>',
			esc_attr($index),
			esc_attr($index),
			esc_attr($label),
			esc_attr($saved_value)
		);

		$html .= '</tr>';
	

	endforeach; 
	
	$html .= '</table>';

	echo $html;

}

add_action( 'personal_options_update', 'rouh_save_extra_user_social_profiles' );
add_action( 'edit_user_profile_update', 'rouh_save_extra_user_social_profiles' );

function rouh_save_extra_user_social_profiles( $user_id ) {

	if( !isset( $_POST[ "rouh_social_links_nonce" ] ) || !is_string( $_POST[ "rouh_social_links_nonce" ] ) ) { return; }

	if( !wp_verify_nonce( $_POST[ "rouh_social_links_nonce" ], "rouh_verify_profile" ) ) { return; }

	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
	update_user_meta( $user_id, 'rouh_social_links', $_POST['rouh_social_links'] );

}

