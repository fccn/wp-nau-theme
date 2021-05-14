<?php 

  function _get_tag($slug) {
      $terms = get_tags();
      foreach($terms as $term) {
          if ($term->slug == $slug) 
            return $term;
      }
      
      return null;
  }

  $mode = "list";  
  $page_title = "";
  $excerpt = "";
  
  
  if (function_exists("is_tag") && is_tag()) {      
      $tag = get_queried_object();      
      $page_title = $tag->name;
      $excerpt = $tag->description;
      $mode = "list_course_card_by_slug";
      $slug = $tag->slug;
  }
  
  if (is_category()) {      
      $category = get_queried_object();      
      $page_title = $category->name;
      $excerpt = $category->description;
  }

  if ($page_title == "") {        
      /* Tries to find course! */
      preg_match('/.*\/(.*)\/(.*)\/(.*)$/i', home_url($wp->request), $r);

      if (($r[1] == "courses") && ($r[3] == "about")) {        
        $args = array(
            'course-id-prod'   => $r[2]            
        );
        $the_query = new WP_Query( $args );
        
        if ( $the_query->have_posts() ) {
          $the_query->the_post();        
          wp_redirect(get_permalink());
        }
      }
      
      /* Tries to find Tag! */
      preg_match('/.*\/(.*)\/(.*)$/i', home_url($wp->request), $r);
      if ($r[1] == "courses") {          
          $slug = $r[2];
          $term = _get_tag($slug);
          if ($term) {
              $mode = "list_course_card_by_slug";
          }      
      }
  }
  
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  
  defined( 'ABSPATH' ) or die( 'Request was blocked for security reasons!' );
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  
  get_header(); 
      
  include "inc/simple_header.php";
  
?>
<!-- INDEX -->


<div id="text-content"> 
<? if ($excerpt != ""): ?> 
  <div class="description">
<?
  print($excerpt);
?>
  </div>
<? endif; ?>  

<? if ($mode=="list"):

  while( have_posts() ): the_post(); /* start main loop */ ?>

  <article class="news_article">
    <p class="tags">      
      <?php echo nau_list_tags()?>
      <?php echo nau_list_categories()?>
    </p>
    <h2><a href="<?php echo get_permalink()?>"><?php the_title(); ?></a></h2>
    <a class="news_image_link" href="<?php echo get_permalink()?>">
      <img class="news_image" src="<?php echo get_the_post_thumbnail_url()?>">
    </a>
    <p class="news_date">
      <?php echo get_the_date()?>
    </p>    
    <p class="news_content">
      <?php echo do_shortcode(the_excerpt())?>
    </p>
    <a class="news_image_button" href="<?php echo get_permalink()?>">
      <span class="button"><?php echo nau_trans("Read More")?></span>
    </a>
  </article>        

<?php      
  endwhile; /* End the main loop */ 
   endif; ?>

<? 
  if ($mode=="list_course_card_by_slug") { 
    print(nau_courses_gallery([ "filter"=>$slug ]));    
  } 
?>

</div>

<!-- ends homepage body content --> 

<?php
  get_template_part( "partials/global", "footer" );
?>
<?php get_footer(); ?>

