<?php

// register widgets

function register_footer_widgets() {
    // left footer area
    register_sidebar( 
      array(
        'name' => esc_html__( 'Footer left area', 'nau_theme' ),
        'id' => 'footer_left_area',
        'description' => esc_html__( 'Add a menu to the left footer area', 'nau_theme' ),
        'before_widget' => '<div id="%1s" class="footer-widget %2s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="footer-title">',
        'after_title' => '</span>',
      )
    );
    // center footer area
    register_sidebar( 
      array(
        'name' => esc_html__( 'Footer center area', 'nau_theme' ),
        'id' => 'footer_center_area',
        'description' => esc_html__( 'Add a menu to the center footer area', 'nau_theme' ),
        'before_widget' => '<div id="%1s" class="footer-widget %2s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="footer-title">',
        'after_title' => '</span>',
      )
    );
    // right footer area
    register_sidebar( 
      array(
        'name' => esc_html__( 'Footer right area', 'nau_theme' ),
        'id' => 'footer_right_area',
        'description' => esc_html__( 'Add a menu to the right footer area', 'nau_theme' ),
        'before_widget' => '<div id="%1s" class="footer-widget %2s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="footer-title">',
        'after_title' => '</span>',
      )
    );
    register_sidebar( 
      array(
        'name' => esc_html__( 'Footer entity logos', 'nau_theme' ),
        'id' => 'footer_entity_logos',
        'description' => esc_html__( 'Add a menu to the bottom area of the footer', 'nau_theme' ),
        'before_widget' => '<div id="%1s" class="footer-bottom-area %2s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="footer-title">',
        'after_title' => '</span>',
      )
    );
  }
  add_action( 'widgets_init', 'register_footer_widgets' );
  