<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000 );

// Enqueue scripts and styles
function enqueue_scripts_styles() {
    // Styles & Scripts
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/customscript.js', array() );
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/astyle.css', array() );
    wp_enqueue_style( 'custom-fonts', get_stylesheet_directory_uri() . '/fonts/stylesheet.css', array() );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_styles' );


function display_current_time() {
    $current_time = current_time('timestamp');
    return date(get_option('time_format'), $current_time);
}
add_shortcode('current_time', 'display_current_time');


function custom_nav_menus() {
	register_nav_menus(
		array(
			'main' => __( 'Main Menu' ),
		)
	);
}
add_action( 'init', 'custom_nav_menus' );

if( function_exists('acf_add_options_page') ) {

	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'Sharing AK Settings',
		'menu_title' 	=> 'Sharing AK Settings',
		'menu_slug' 	=> 'sharingak-general-settings',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false
	));

}


add_image_size( 'blogpostgrid', 352, 288, true );


//Remove Library CSS and Script from loading on the frontend
function remove_home_assets() {
    if (is_front_page()) { // allow widget style only in front page
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('addtoany');
        wp_dequeue_style('wpautoterms_css');
        wp_dequeue_style('front-magnific-popup');
        wp_dequeue_style('cubeportfolio');


        // wp_deregister_script( 'wp-embed' );
        // wp_deregister_script( 'svg-x-use' );
        // wp_deregister_script( 'staffer' );
        // wp_deregister_script( 'tp-tools' );
        // wp_deregister_script( 'revmin' );


        wp_dequeue_script( 'jquery-migrate' );
        wp_dequeue_script( 'jquery-core' );
        wp_dequeue_script( 'cubeportfolio' );
        wp_dequeue_script( 'wp-polyfill' );
        wp_dequeue_script( 'wp-dom-ready' );
        wp_dequeue_script( 'wpautoterms_base' );
        wp_dequeue_script( 'addtoany' );


    }
}
add_action( 'wp_enqueue_scripts', 'remove_home_assets', 999 );

function ads_func() {
    $html .= '<div class="" id="wkly-before">';
	
		$html .= include ( FL_CHILD_THEME_DIR . '/ads.php' );
		// $html .= include ( FL_CHILD_THEME_DIR . '/weekly.php' );
    $html.= '</div>';
    return $html;
}
add_shortcode('showads', 'ads_func');


/* ----------------------------------------------------------------*/
/* ------------------->>> WP CORE POSTS SETUP <<<------------------*/
/* ----------------------------------------------------------------*/
include (FL_CHILD_THEME_DIR . '/_admin/ws-strip.php' );
include (FL_CHILD_THEME_DIR . '/_admin/ws-admin.php' );
include (FL_CHILD_THEME_DIR . '/_admin/ws-acf.php' );
include (FL_CHILD_THEME_DIR . '/_admin/ws-cpt.php' );
include (FL_CHILD_THEME_DIR . '/_admin/ws-functions.php' );