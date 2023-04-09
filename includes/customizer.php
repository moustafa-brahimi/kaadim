<?php



// ========================= Colors ========================= //

new \Kirki\Section(
	'kadim_colors',
	[
		'priority'    => 0,
		'title'       => esc_html__( 'Color', 'kadim' ),
	]
);

new \Kirki\Field\Color(
	[
		'settings'    => 'kadim_accent_color',
		'label'       => __( 'Accent color', 'kadim' ),
		'description' => esc_html__( 'preferably light color', 'kadim' ),
		'section'     => 'kadim_colors',
		'default'     => '#c2ece7',

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
		'settings'    => 'kadim_accent_text_color',
		'label'       => __( 'Accent text color', 'kadim' ),
		'description' => esc_html__( 'preferably a darker shade of the chosen accent color', 'kadim' ),
		'section'     => 'kadim_colors',
		'default'     => '#3e625d',

		'output' => [

			[
			  'element'  => ':root',
			  'property' => '--accent-text-color',
			],
	  
		  ],
	  
	]
);

// =================== Logo Alternative ======================= // 


new \Kirki\Field\Typography(
	[
		'settings'    => 'kadim_logo_alternative_typography',
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
		'settings'    => 'kadim_logo_alternative_darkmode_color',
		'label'       => __( 'Alternative Logo Dark Scheme color', 'kadim' ),
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


new \Kirki\Field\Select(
	[
		'settings'    => 'kadim_body_typography',
		'label'       => esc_html__( 'Body Typography', 'kadim' ),
		'section'     => 'kadim_typography',
		'default'     => 'Poppins',
		'priority'    => 80,
		'transport'   => 'refresh',

		'choices' => [ 
			'Roboto'	=>	__( 'Roboto', 'kadim' ),
			'Raleway'	=>	__( 'Raleway', 'kadim' ),
			'Nunito'	=>	__( 'Nunito', 'kadim' ),
			'Poppins'	=>	__( 'Poppins', 'kadim' ),
			'Cairo'	=>	__( 'Cairo', 'kadim' ),
			'Alexandria'	=>	__( 'Alexandria', 'kadim' ),
			// 'Quicksand'	=>	__( 'Quicksand', 'kadim' ),
			// 'Noto Serif'	=>	__( 'Noto Serif', 'kadim' ),
			// 'Noto Sans'	=>	__( 'Noto Sans', 'kadim' ),
		],
	]
);

new \Kirki\Field\Typography(
	[
		'settings'    => 'kadim_headings_typography',
		'label'       => esc_html__( 'Headings Typography', 'kadim' ),
		'section'     => 'kadim_typography',
		'priority'    => 80,
		'transport'   => 'refresh',
		'default'     => [
			'font-family'	=>	'DM Serif Display',
		],

	]
);

new \Kirki\Field\Slider(
	[
		'settings'    => 'kadim_root_fontsize',
		'label'       => esc_html__( 'Font size', 'kadim' ),
		'section'     => 'kadim_typography',
		'default'     => 1,
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



new \Kirki\Section(
	'kadim_typography',
	[
		'priority'    => 1,
		'title'       => esc_html__( 'Typography', 'kadim' ),
	]
);

// =================== Slider =================== // 

new \Kirki\Section(
	'kadim_slider',
	[
		'priority'    => 3,
		'title'       => esc_html__( 'Slider', 'kadim' ),
	]
);

new \Kirki\Field\Toggle([

	'settings'	=>	'kadim_slider_enabled',
	'label'	=>	esc_html__( 'Slider Enabled', 'kadim' ),
	'section' => 'kadim_slider',
	'default' => '1',
	'priority' => 10

]);


new Kirki\Field\Select(
	[
		'settings'    => 'kadim_slider_category',
		'label'       => __( 'Choose featured posts category ', 'kadim' ),
		'section'     => 'kadim_slider',
		'default'     => 'uncategorized',
		'priority'    => 30,
		'multiple'    => 10,
		'placeholder' => __( 'Select a category', 'kadim' ),
		'choices'     => Kirki\Util\Helper::get_terms( [ 'taxonomy' => 'category' ] ),
		'active_callback'	=> [

			[
				'setting'	=> 'kadim_slider_enabled',
				'operator' => '==',
				'value'	=>	true
			],

		]
	]
);

new Kirki\Field\Text([

	'settings'	=>	'kadim_slider_title',
	'label'    => esc_html__( 'Title', 'kadim' ),
	'section'  => 'kadim_slider',
	'default'  => esc_html__( 'Featured Posts', 'kadim' ),
	'priority' => 40,

	'active_callback'	=> [

		[
			'setting'	=> 'kadim_slider_enabled',
			'operator' => '==',
			'value'	=>	true
		],

	]

]);


// =================== Notice =================== // 

new \Kirki\Section(

	'kadim_notice',
	  [
		  'priority'    => 2,
		  'title'       => esc_html__( 'Notice', 'kadim' ),
	  ]
  
  );


new \Kirki\Field\Toggle(
	[
		'settings'    => 'kadim_notice_status',
		'label'       => esc_html__( 'Show notice', 'kadim' ),
		'section'     => 'kadim_notice',
		'default'     => '1',
		'priority'    => 10,
	]
);


new \Kirki\Field\Editor(
	[
		'settings' => 'kadim_notice_content',
		'label'    => esc_html__( 'Notice', 'kadim' ),
		'section'  => 'kadim_notice',
		'default'  => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'kadim' ),
		'priority' => 10,

    'active_callback' => [
      
      [
        'setting'  => 'kadim_notice_status',
        'operator' => '==',
        'value'    => true,
      ]
    
    ],

	]
);


new \Kirki\Field\Color(
	[
		'settings'    => 'notice_background_color',
		'label'       => __( 'Notice background color', 'kadim' ),
		'section'     => 'kadim_notice',
		'default'     => '#c2ece7',
		'priority'    => 30,
    
    'active_callback' => [
      
      [
        'setting'  => 'kadim_notice_status',
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
		'settings'    => 'kadim_notice_typography',
		'label'       => esc_html__( 'Notice Typography', 'kirki' ),
		'section'     => 'kadim_notice',
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
        'setting'  => 'kadim_notice_status',
        'operator' => '==',
        'value'    => true,
      ]
    
    ],

	]
);



// ======================== Footer ===================== //

new \Kirki\Section(

	'kadim_footer',
	  [
		  'priority'    => 5,
		  'title'       => esc_html__( 'Footer', 'kadim' ),
	  ]
  
  );

  new \Kirki\Field\Editor(
	[
		'settings' => 'kadim_copyright_sentence',
		'label'    => esc_html__( 'Copyrights Phrase', 'kadim' ),
		'section'  => 'kadim_footer',
		'default'  => esc_html__( 'All Rights Reserved 2023', 'kadim' ),
		'priority' => 10,

	]
);