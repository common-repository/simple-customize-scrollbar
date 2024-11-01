<?php
/*
Plugin Name: Simple customize scrollbar
Description: Customize scrollbar without JavaScript library
Version: 1.0
Author: Tomek
Author URI: http://wp-learning-net
Text Domain: sc-scroll
Domain Path: /lang
*/

function sc_scroll_customizer($wp_customize){
    $wp_customize->add_section('sc_scroll_customize', array(
        'title'          => __('Scrollbar','sc-scroll'),
        'description' 	 => __('Customize scrollbar without JavaScript library','sc-scroll')
    ));

    $wp_customize->add_setting('sc_scroll_face_color', array(
        'default'        => '#000000',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sc_scroll_face_color', array(
	    'label'      => __('Color of face','sc-scroll'),
	    'section'    => 'sc_scroll_customize',
     	'settings'   => 'sc_scroll_face_color',
    ) ) );
	
    $wp_customize->add_setting('sc_scrol_track_color', array(
        'default'        => '#ffffff',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sc_scrol_track_color', array(
	    'label'      => __('Color of track','sc-scroll'),
	    'section'    => 'sc_scroll_customize',
     	'settings'   => 'sc_scrol_track_color',
    ) ) );
	
    $wp_customize->add_setting('sc_scroll_arrow_ie', array(
        'default'        => '#000000',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sc_scroll_arrow_ie', array(
	    'label'      => __('Color of arrow (only in Internet Explorer browser)','sc-scroll'),
	    'section'    => 'sc_scroll_customize',
     	'settings'   => 'sc_scroll_arrow_ie',
    ) ) );

    $wp_customize->add_setting('sc_scroll_hover_cr', array(
        'default'        => '#808080',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sc_scroll_hover_cr', array(
	    'label'      => __('Color of hover (only in Chromium based browsers)','sc-scroll'),
	    'section'    => 'sc_scroll_customize',
     	'settings'   => 'sc_scroll_hover_cr',
    ) ) );

    $wp_customize->add_setting('sc_scroll_width_cr', array(
        'default'        => '20',
    ));

    $wp_customize->add_control('sc_scroll_width_cr', array(
        'label'   => __('Width size (only in Chromium based browsers)','sc-scroll'),
        'section' => 'sc_scroll_customize',
        'type'    => 'number',
    ));

	$wp_customize->add_setting( 'sc_scroll_width_ff', array(
    	'default' => 'thin',
	) );

	$wp_customize->add_control( 'sc_scroll_width_ff', array(
	    'type' => 'select',
	    'section' => 'sc_scroll_customize',
	    'label' => __('Width size (only in Firefox browsers)','sc-scroll'),
	    'choices' => array(
		  'none' => __('None','sc-scroll'),
		  'thin' => __('Thin','sc-scroll'),
		  'auto' => __('Auto','sc-scroll'),
	  ),
	) );
}

function sc_scroll_settings_link( $links, $file ) {
    if ( $file != plugin_basename( __FILE__ ))
        return $links;

    $sc_scroll_settings_link = '<a href="customize.php?autofocus[section]=sc_scroll_customize">'.__('Settings','sc-scroll').'</a>';
    array_unshift( $links, $sc_scroll_settings_link );
    return $links;
}

function sc_scroll_scrollbar() {
    ?>
    <style>
		body{scrollbar-track-color: <?php echo get_theme_mod('sc_scrol_track_color', '#ffffff') ?>;scrollbar-face-color: <?php echo get_theme_mod('sc_scroll_face_color', '#000000') ?>;scrollbar-arrow-color: <?php echo get_theme_mod('sc_scroll_arrow_ie', '#000000') ?>;}
		:root{scrollbar-face-color: <?php echo get_theme_mod('sc_scroll_face_color', '#000000') ?>;scrollbar-track-color: <?php echo get_theme_mod('sc_scrol_track_color', '#ffffff') ?>;scrollbar-color: <?php echo get_theme_mod('sc_scroll_face_color', '#000000') ?> <?php echo get_theme_mod('sc_scrol_track_color', '#ffffff') ?>;scrollbar-width: <?php echo get_theme_mod('sc_scroll_width_ff', 'thin') ?>;}
		::-webkit-scrollbar-track {background: <?php echo get_theme_mod('sc_scrol_track_color', '#ffffff') ?>;}
		::-webkit-scrollbar-thumb {background: <?php echo get_theme_mod('sc_scroll_face_color', '#000000') ?>;}
		::-webkit-scrollbar-thumb:hover {background: <?php echo get_theme_mod('sc_scroll_hover_cr', '#808080') ?>;}
		::-webkit-scrollbar {width: <?php echo get_theme_mod('sc_scroll_width_cr', '20') ?>px;}
    </style>
    <?php
}

load_plugin_textdomain( 'sc-scroll', '', dirname( plugin_basename( __FILE__ ) ) . '/lang' );
add_action('customize_register', 'sc_scroll_customizer');
add_action('wp_head', 'sc_scroll_scrollbar');
add_filter('plugin_action_links','sc_scroll_settings_link',10,2);
?>