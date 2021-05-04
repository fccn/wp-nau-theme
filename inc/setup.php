<?php

function version_id() { 
    if ( WP_DEBUG )
      return time();
    if ( WP_NAU_THEME_VERSION != 'WP_NAU_THEME_VERSION' )
      return WP_NAU_THEME_VERSION;
    return '1.0.0';
  }

function nau_post_thumbnails() {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'nau_post_thumbnails' );

function nau_load_theme_textdomain() {    
    load_theme_textdomain('nau-theme', get_template_directory() . '/languages' );
}
add_action('after_setup_theme', 'nau_load_theme_textdomain' );

/*
 * Enqueue theme styles and fonts
 * ==
 * Site styles require reset styles, fonts and icons to be loaded first
**/
function nau_theme_enqueue_styles() {
    wp_enqueue_style('material-icons', '//fonts.googleapis.com/icon?family=Material+Icons');
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
    
    wp_enqueue_style('reset-style', get_template_directory_uri() . '/assets/css/reset.css', array(), version_id(), 'all');
    wp_enqueue_style('styles-style', get_template_directory_uri() . '/assets/css/layout.css', array('reset-style', 'google-fonts', 'material-icons'), version_id(), 'all');
}
add_action( 'wp_enqueue_scripts', 'nau_theme_enqueue_styles' );

/*
 * Enqueue site scripts
**/
function nau_theme_enqueue_scripts() {
    wp_enqueue_script('script_functions', get_template_directory_uri() . '/assets/js/functions.js', array(), version_id(), true);
    wp_enqueue_script('menu_slider', get_template_directory_uri() . '/assets/js/menu_slider_and_other_operations.js', array(), version_id(), true);
    wp_enqueue_script('cookie_bar', get_template_directory_uri() . '/assets/js/cookie-bar.js', array(), version_id(), true);
}
add_action( 'wp_enqueue_scripts', 'nau_theme_enqueue_scripts' );

/*
 * Register site wide menus
**/
function nau_theme_setup() {
    add_theme_support('menus');
    
    register_nav_menu('main', 'Top Bar Menu');
    register_nav_menu('footer', 'Footer Menu');
    register_nav_menu('access', 'NAU Access Menu');
}

add_action('init', 'nau_theme_setup');