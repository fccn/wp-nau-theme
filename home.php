<?php /* Template Name: Homepage Template */ 

  wp_enqueue_script('slider_lib', get_template_directory_uri() . '/assets/js/jssor.slider-28.0.0.min.js', array(), '1.0.0', true);
  wp_enqueue_script('home_slider', get_template_directory_uri() . '/assets/js/home_slider.js', array(), '1.0.0', true);    

  $slug = $post->post_name;
  $nauPageID = "homepage";  
  $nauBodyClass = "class='homepage $slug'";
  get_header(); 

  print("<!-- Home -->");
    
  // Home Page
  print('<div id="home-content">');

  echo do_shortcode(get_post_field('post_content', $post->ID));

  print('</div>');

  get_template_part( "partials/global", "footer" );
  get_footer(); 
  
?>
