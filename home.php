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

  if (get_custom_value('homepage-top-slider', 0) == 1) {
      //get_template_part( "homepage", "banner" );
      get_template_part( "homepage", "slider" );
  }

  print('<div id="home-content">');

  if (get_custom_value('homepage-highlight-courses', 0) == 1) {
    $course_list_title = get_custom_value('homepage-highlight-courses-title', nau_trans("Courses|Highlighted"));
    $courses = nau_get_posts("curso", ["filter" => "highlight"]);
    get_template_part( "courses", "cards" );
  }
  
  if (get_custom_value('homepage-running-courses', 0) == 1) {
    $course_list_title = get_custom_value('homepage-running-courses-title', nau_trans("Courses|Running"));
    $courses = nau_get_posts("curso", ["filter" => "running-course"]);
    get_template_part( "homepage", "running-courses" );
  }

  if (get_custom_value('homepage-all-courses-link', 0) == 1) {
    get_template_part( "homepage", "all-courses-link" );
  }

  if (get_custom_value('homepage-founder-entities', 0) == 1) {
    $course_list_title = nau_trans("Entity|Founders");
    $entities = nau_get_posts("entidade", ["filter" => "fundador"]);  
    get_template_part( "homepage", "entities" );
  }


  print('</div>');

  get_template_part( "global", "footer" );
  get_footer(); 
  
}
  
?>


