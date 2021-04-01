<?php /* Template Name: Homepage Template */ 

if ((get_option('nau_news_page') == $post->ID) || ($post->post_type == "post")) {
  
  // News Page
  $slug = $post->post_name;
  $nauBodyClass = "class='secondary-pages news-list'";
  include("inc/news-list.php");  

} 

else {

  wp_enqueue_script('slider_lib', get_template_directory_uri() . '/assets/js/jssor.slider-28.0.0.min.js', array(), '1.0.0', true);
  wp_enqueue_script('home_slider', get_template_directory_uri() . '/assets/js/home_slider.js', array(), '1.0.0', true);    

  $slug = $post->post_name;
  $nauPageID = "homepage";  
  $nauBodyClass = "class='homepage $slug'";
  get_header(); 

  print("<!-- Home -->");
    
  // Home Page
  print('<div id="home-content">');

  echo do_shortcode(get_post_field('post_content', $pageID));

  print('</div>');

  get_template_part( "partials/global", "footer" );
  get_footer(); 
  
}
  
?>


