<?php




// =================== Typography =================== // 

new \Kirki\Field\Color(
	[
		'settings'    => 'color_setting_hex',
		'label'       => __( 'Color Control (hex only)', 'kirki' ),
		'description' => esc_html__( 'Regular color control, no alpha channel.', 'kirki' ),
		'section'     => 'kadim_typography',
		'default'     => '#0008DC',
	]
);


// Kirki::add_section( 'kadim_typography', [
//   'priority'    => 4,
//   'title'       => esc_html__( 'Typography', 'text-domain' ),
// ] );


new \Kirki\Section(
	'kadim_typography',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Typography', 'kadim' ),
	]
);


// =================== Notice =================== // 


new \Kirki\Field\Toggle(
	[
		'settings'    => 'kadim_notice_status',
		'label'       => esc_html__( 'Show notice', 'kadim' ),
		'section'     => 'kadim_notice',
		'default'     => '1',
		'priority'    => 10,
	]
);


new \Kirki\Field\Text(
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
			'font-size'       => '14px',
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


new \Kirki\Section(

  'kadim_notice',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Notice', 'kadim' ),
	]

);
