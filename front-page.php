<?php

  $slug = $post->post_name;
  $nauPageID = "homepage";  
  $nauBodyClass = "class='homepage $slug'";
  get_header(); 

  print("<!-- Home -->");
    
  // Home Page
  print('<div id="home-content">');

  echo do_shortcode(get_post_field('post_content', get_the_ID()));

  print('</div>');

  get_template_part( "partials/global", "footer" );
  get_footer(); 
  
?>
