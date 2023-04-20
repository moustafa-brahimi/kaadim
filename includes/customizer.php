<?php



// ========================= Colors ========================= //

new \Kirki\Section(
	'rouh_colors',
	[
		'priority'    => 0,
		'title'       => esc_html__( 'Color', 'rouh' ),
	]
);

new \Kirki\Field\Color(
	[
		'settings'    => 'rouh_accent_color',
		'label'       => __( 'Accent color', 'rouh' ),
		'description' => esc_html__( 'preferably light color', 'rouh' ),
		'section'     => 'rouh_colors',
		'default'     => '#c2ece7',
		'priority'    => 10,

		'output' => [

			[
			  'element'  => ':root',
			  'property' => '--accent-color',
			],
	  
		  ],
	  
	]
);

new \Kirki\Field\Color(
	[
		'settings'    => 'rouh_accent_text_color',
		'label'       => __( 'Accent text color', 'rouh' ),
		'description' => esc_html__( 'preferably a darker shade of the chosen accent color', 'rouh' ),
		'section'     => 'rouh_colors',
		'default'     => '#3e625d',
		'priority'    => 20,


		'output' => [

			[
			  'element'  => ':root',
			  'property' => '--accent-text-color',
			],
	  
		  ],
	  
	]
);

// =================== Logo Alternative ======================= // 


new \Kirki\Field\Dimension(
	[
		'settings'    => 'rouh_logo_height',
		'label'       => __( 'Logo height', 'rouh' ),
		'section'     => 'title_tagline',
		'default'     => '60',
		'priority'    => 40,

		'output' => [

			[
			  'element'  => '.logo__light, .logo__dark',
			  'property' => 'max-height',
			  "units"	=>	'px'
			],
	  
		  ],
	  
		'active_callback' => function() {

			return get_theme_mod( "custom_logo", null ) != null;

		}
	]
);

new \Kirki\Field\Image(
	[
		'settings'    => 'rouh_logo_dark_mode_version',
		'label'       => esc_html__( 'Dark mode Logo', 'kirki' ),
		'section'     => 'title_tagline',
		'priority'    => 30,
		'default'     => '',

		'active_callback' => function() {
			return get_theme_mod( "custom_logo", null ) != null;
		}

	]
);

new \Kirki\Field\Typography(
	[
		'settings'    => 'rouh_logo_alternative_typography',
		'label'       => esc_html__( 'Alternative Logo Typography', 'kirki' ),
		'section'     => 'title_tagline',
		'priority'    => 80,
		'transport'   => 'auto',
		'default'     => [
			'font-style'      => 'normal',
			'color'           => '#323232',
			'font-size'       => '1.6rem',
			'line-height'     => '1.618',
			'letter-spacing'  => '0.8rem',
			'text-transform'  => 'uppercase',
			'text-decoration' => 'none',
		],
		
		'output'      => [
				[
					'element' => '.logo__alternative',
				],
			],

		'active_callback' => function() {

			return get_theme_mod( "custom_logo", null ) == null;

		}
    

	]
);


new \Kirki\Field\Color(
	[
		'settings'    => 'rouh_logo_alternative_darkmode_color',
		'label'       => __( 'Alternative Logo Dark Scheme color', 'rouh' ),
		'section'     => 'title_tagline',
		'default'     => '#ffffff',
		'priority'    => 90,

		'output' => [

			[
			  'element'  => '[color-scheme="dark"] .logo__alternative',
			  'property' => 'color',
			],
	  
		  ],
	  
		'active_callback' => function() {

			return get_theme_mod( "custom_logo", null ) == null;

		}
	]
);





// =================== Typography =================== // 


new \Kirki\Section(
	'rouh_typography',
	[
		'priority'    => 1,
		'title'       => esc_html__( 'Typography', 'rouh' ),
	]
);

new \Kirki\Field\Slider(
	[
		'settings'    => 'rouh_root_fontsize',
		'label'       => esc_html__( 'Font size', 'rouh' ),
		'section'     => 'rouh_typography',
		'default'     => 1,
		'priority'	  => 10,
		'choices'     => [
			'min'  => 0.1,
			'max'  => 2,
			'step' => 0.1,
		],

		'output' => [

			[
				'element' => ':root',
				'property' => 'font-size',
				'units'		=>	'rem',
			]

		]

	]
);

$font_choices = rouh_supported_body_fonts();
$choices = [];

foreach($font_choices as $key => $font_data):
	$choices[$key] = $font_data["label"];
endforeach;

new \Kirki\Field\Select(
	[
		'settings'    	=> 'rouh_body_typography',
		'label'       	=> esc_html__( 'Body Typography', 'rouh' ),
		'section'     	=> 'rouh_typography',
		'default'     	=> ( is_rtl() ? 'alexandaria' : 'poppins' ),
		'priority'    	=> 20,
		'transport'   	=> 'refresh',
		'choices' 		=> $choices

	]
);

new \Kirki\Field\Typography(
	[
		'settings'    => 'rouh_headings_typography',
		'label'       => esc_html__( 'Headings Typography', 'rouh' ),
		'section'     => 'rouh_typography',
		'priority'    => 30,
		'transport'   => 'refresh',
		'default'     => [
			'font-family'	=>	( is_rtl() ? 'Amiri' : 'DM Serif Display' ),
		],

	]
);



// =================== Slider =================== // 

new \Kirki\Section(
	'rouh_slider',
	[
		'priority'    => 3,
		'title'       => esc_html__( 'Slider', 'rouh' ),
	]
);

new \Kirki\Field\Toggle([

	'settings'	=>	'rouh_slider_enabled',
	'label'	=>	esc_html__( 'Slider Enabled', 'rouh' ),
	'section' => 'rouh_slider',
	'default' => '1',
	'priority' => 10

]);


new Kirki\Field\Select(
	[
		'settings'    => 'rouh_slider_category',
		'label'       => __( 'Choose featured posts category ', 'rouh' ),
		'section'     => 'rouh_slider',
		'default'     => [ 1 ],
		'priority'    => 20,
		'multiple'    => 10,
		'placeholder' => __( 'Select a category', 'rouh' ),
		'choices'     => Kirki\Util\Helper::get_terms( [ 'taxonomy' => 'category' ] ),
		'active_callback'	=> [

			[
				'setting'	=> 'rouh_slider_enabled',
				'operator' => '==',
				'value'	=>	true
			],

		]
	]
);

new Kirki\Field\Text([

	'settings'	=>	'rouh_slider_title',
	'label'    => esc_html__( 'Title', 'rouh' ),
	'section'  => 'rouh_slider',
	'default'  => esc_html__( 'Featured Posts', 'rouh' ),
	'priority' => 30,
	'sanitize_callback' => "trim", 
	'active_callback'	=> [

		[
			'setting'	=> 'rouh_slider_enabled',
			'operator' => '==',
			'value'	=>	true
		],

	]

]);


// =================== Notice =================== // 

new \Kirki\Section(

	'rouh_notice',
	  [
		  'priority'    => 2,
		  'title'       => esc_html__( 'Notice', 'rouh' ),
	  ]
  
  );


new \Kirki\Field\Toggle(
	[
		'settings'    => 'rouh_notice_status',
		'label'       => esc_html__( 'Show notice', 'rouh' ),
		'section'     => 'rouh_notice',
		'default'     => '1',
		'priority'    => 10,
	]
);


new \Kirki\Field\Editor(
	[
		'settings' => 'rouh_notice_content',
		'label'    => esc_html__( 'Notice', 'rouh' ),
		'section'  => 'rouh_notice',
		'default'  => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'rouh' ),
		'priority' => 20,

    'active_callback' => [
      
      [
        'setting'  => 'rouh_notice_status',
        'operator' => '==',
        'value'    => true,
      ]
    
    ],

	]
);


new \Kirki\Field\Color(
	[
		'settings'    => 'notice_background_color',
		'label'       => __( 'Notice background color', 'rouh' ),
		'section'     => 'rouh_notice',
		'default'     => '#c2ece7',
		'priority'    => 30,
    
    'active_callback' => [
      
      [
        'setting'  => 'rouh_notice_status',
        'operator' => '==',
        'value'    => true,
      ]
    
    ],

    'output' => [

      [
        'element'  => ':root',
        'property' => '--notice-background-color',
      ],

    ],

	]

);


new \Kirki\Field\Typography(
	[
		'settings'    => 'rouh_notice_typography',
		'label'       => esc_html__( 'Notice Typography', 'rouh' ),
		'section'     => 'rouh_notice',
		'priority'    => 40,
		'transport'   => 'auto',
		'default'     => [
			'font-style'      => 'normal',
			'color'           => 'var(--accent-text-color)',
			'font-size'       => '1rem',
			'line-height'     => '1.618',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
		],
		
    'output'      => [
			[
				'element' => '.notice',
			],
		],

    'active_callback' => [
      
      [
        'setting'  => 'rouh_notice_status',
        'operator' => '==',
        'value'    => true,
      ]
    
    ],

	]
);



// ======================== Footer ===================== //

new \Kirki\Section(

	'rouh_footer',
	[
		'priority'    => 5,
		'title'       => esc_html__( 'Footer', 'rouh' ),
	]

);

new \Kirki\Field\Text(
	[
		'settings' => 'rouh_instagram_account_token',
		'label'    => esc_html__( 'Instagram Token', 'rouh' ),
		'section'  => 'rouh_footer',
		'priority' => 10,
		'description' => 
		sprintf(
			"%s <a href='%s' target='_blank'>%s</a>",
			esc_html__( "Don't have an instagram token ?", "rouh" ),
			"https://spotlightwp.com/access-token-generator/",
			esc_html__( "Generate Your's", "rouh" )
		)
	]
);



new \Kirki\Field\Editor(
	[
		'settings' => 'rouh_copyright_sentence',
		'label'    => esc_html__( 'Copyrights Phrase', 'rouh' ),
		'section'  => 'rouh_footer',
		'default'  => esc_html__( 'All Rights Reserved 2023', 'rouh' ),
		'priority' => 20,

	]
);



// ========================== ads


new \Kirki\Panel(
	'rouh_ads_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Ads', 'rouh' ),
		'description' => esc_html__( 'Add ad scripts around the website.', 'rouh' ),
	]
);

// [ homepage ]

new \Kirki\Section(
	'rouh_ads_home',
	[
		'title'       => esc_html__( 'Homepage Ads', 'rouh' ),
		'description' => esc_html__( 'Manage ads on the blog homepage', 'rouh' ),
		'panel'       => 'rouh_ads_panel',
		'priority'    => 10,
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_home_top_desktop',
		'label'       => esc_html__( 'Top page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_home',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_home_top_mobile',
		'label'       => esc_html__( 'Top page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_home',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_home_bottom_desktop',
		'label'       => esc_html__( 'Bottom page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_home',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_home_bottom_mobile',
		'label'       => esc_html__( 'Bottom page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_home',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);

// [ article ]

new \Kirki\Section(
	'rouh_ads_single',
	[
		'title'       => esc_html__( 'Article page', 'rouh' ),
		'description' => esc_html__( 'Manage ads on the article page', 'rouh' ),
		'panel'       => 'rouh_ads_panel',
		'priority'    => 10,
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_single_top_desktop',
		'label'       => esc_html__( 'Top page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_single',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_single_top_mobile',
		'label'       => esc_html__( 'Top page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_single',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_single_bottom_desktop',
		'label'       => esc_html__( 'Bottom page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_single',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_single_bottom_mobile',
		'label'       => esc_html__( 'Bottom page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_single',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


// [ author ]

new \Kirki\Section(
	'rouh_ads_author',
	[
		'title'       => esc_html__( 'Author page', 'rouh' ),
		'description' => esc_html__( 'Manage ads on the author page', 'rouh' ),
		'panel'       => 'rouh_ads_panel',
		'priority'    => 10,
		
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_author_top_desktop',
		'label'       => esc_html__( 'Top page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_author',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_author_top_mobile',
		'label'       => esc_html__( 'Top page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_author',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_author_bottom_desktop',
		'label'       => esc_html__( 'Bottom page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_author',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_author_bottom_mobile',
		'label'       => esc_html__( 'Bottom page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_author',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


// [ category ]

new \Kirki\Section(
	'rouh_ads_category',
	[
		'title'       => esc_html__( 'Category page', 'rouh' ),
		'description' => esc_html__( 'Manage ads on the category page', 'rouh' ),
		'panel'       => 'rouh_ads_panel',
		'priority'    => 10,
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_category_top_desktop',
		'label'       => esc_html__( 'Top page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_category',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_category_top_mobile',
		'label'       => esc_html__( 'Top page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_category',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_category_bottom_desktop',
		'label'       => esc_html__( 'Bottom page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_category',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_category_bottom_mobile',
		'label'       => esc_html__( 'Bottom page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_category',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);

// [ archive ]

new \Kirki\Section(
	'rouh_ads_archive',
	[
		'title'       => esc_html__( 'Archive page', 'rouh' ),
		'description' => esc_html__( 'Manage ads on the archive page', 'rouh' ),
		'panel'       => 'rouh_ads_panel',
		'priority'    => 10,
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_archive_top_desktop',
		'label'       => esc_html__( 'Top page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_archive',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_archive_top_mobile',
		'label'       => esc_html__( 'Top page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_archive',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_archive_bottom_desktop',
		'label'       => esc_html__( 'Bottom page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_archive',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_archive_bottom_mobile',
		'label'       => esc_html__( 'Bottom page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_archive',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


// [ category ]

new \Kirki\Section(
	'rouh_ads_category',
	[
		'title'       => esc_html__( 'Category page', 'rouh' ),
		'description' => esc_html__( 'Manage ads on the category page', 'rouh' ),
		'panel'       => 'rouh_ads_panel',
		'priority'    => 10,
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_category_top_desktop',
		'label'       => esc_html__( 'Top page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_category',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_category_top_mobile',
		'label'       => esc_html__( 'Top page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_category',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
		
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_category_bottom_desktop',
		'label'       => esc_html__( 'Bottom page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_category',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
		
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_category_bottom_mobile',
		'label'       => esc_html__( 'Bottom page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_category',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
		
	]
);

// [ search ]

new \Kirki\Section(
	'rouh_ads_search',
	[
		'title'       => esc_html__( 'Search page', 'rouh' ),
		'description' => esc_html__( 'Manage ads on the search page', 'rouh' ),
		'panel'       => 'rouh_ads_panel',
		'priority'    => 10,
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_search_top_desktop',
		'label'       => esc_html__( 'Top page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_search',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_search_top_mobile',
		'label'       => esc_html__( 'Top page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_search',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_search_bottom_desktop',
		'label'       => esc_html__( 'Bottom page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_search',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_search_bottom_mobile',
		'label'       => esc_html__( 'Bottom page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_search',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


// [ page ]

new \Kirki\Section(
	'rouh_ads_page',
	[
		'title'       => esc_html__( 'Pages', 'rouh' ),
		'description' => esc_html__( 'Manage ads on the pages', 'rouh' ),
		'panel'       => 'rouh_ads_panel',
		'priority'    => 10,
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_page_top_desktop',
		'label'       => esc_html__( 'Top page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_page',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_page_top_mobile',
		'label'       => esc_html__( 'Top page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_page',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_page_bottom_desktop',
		'label'       => esc_html__( 'Bottom page desktop ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_page',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);


new \Kirki\Field\Code(
	[
		'settings'    => 'rouh_ads_page_bottom_mobile',
		'label'       => esc_html__( 'Bottom page mobile ad', 'rouh' ),
		'description' => esc_html__( 'insert the code for the ad.', 'rouh' ),
		'section'     => 'rouh_ads_page',
		'default'     => '',
		'choices'     => [
			'language' => 'html',
		],
	]
);