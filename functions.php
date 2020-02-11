<?php

$theme_root = get_template_directory_uri();

function nau_theme_enqueue_styles() {
    wp_enqueue_style('reset-style', get_template_directory_uri() . '/assets/css/reset.css', array(), '1.0.0', 'all');
    wp_enqueue_style('styles-style', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0.0', 'all');
    wp_enqueue_script('script_functions', get_template_directory_uri() . '/assets/js/functions.js', array(), '1.0.0', true);
    wp_enqueue_script('menu_slider', get_template_directory_uri() . '/assets/js/menu_slider_and_other_operations.js', array(), '1.0.0', true);
}

add_action( 'wp_enqueue_scripts', 'nau_theme_enqueue_styles' );

function nau_theme_setup() {
    add_theme_support('menus');
    
    register_nav_menu('main', 'Top Bar Menu');
    register_nav_menu('footer', 'Footer Menu');
    register_nav_menu('language', 'Languange Selection Menu');    
    register_nav_menu('access', 'NAU Access Menu');    
}

add_action('init', 'nau_theme_setup');

function wpb_list_child_pages() { 
 
  global $post; 
 
  if ( is_page() && $post->post_parent )
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
  else
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
 
  if ( $childpages ) { 
    $string = '<ul>' . $childpages . '</ul>';
  }
 
  return $string; 
}
 
add_shortcode('wpb_childpages', 'wpb_list_child_pages');

# teste



?>
