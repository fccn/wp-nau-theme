<?php 

  function _get_tag($slug) {
      $terms = get_tags();
      foreach($terms as $term) {
          if ($term->slug == $slug) 
            return $term;
      }
      
      return null;
  }


  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  
  defined( 'ABSPATH' ) or die( 'Request was blocked for security reasons!' );
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  
  get_header(); 
    
  $page_title = "";
  $excerpt = "";
  
  $mode = "list";
  
  if (is_tag()) {      
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
      preg_match('/.*\/(.*)\/(.*)$/i', home_url($wp->request), $r);
      if ($r[1] == "courses") {          
          $slug = $r[2];
          $term = _get_tag($slug);
          if ($term) {
              $mode = "list_course_card_by_slug";
          }
      }
      
      
  }
  
  include "inc/simple_header.php";
  
?>
<!-- INDEX -->


<div id="text-content"> 
<? if ($excerpt != "") { ?> 
  <div class="description">
<?
  print($excerpt);
?>
  </div>
<? } ?>  

<? if (mode=="list") { ?>

<?
  while( have_posts() ): the_post(); /* start main loop */ ?>

  <article class="news_article">
    <p class="tags">      
      <?=nau_list_tags()?>
      <?=nau_list_categories()?>
    </p>
    <h2><a href="<?=get_permalink()?>"><?php the_title(); ?></a></h2>
    <a class="news_image_link" href="<?=get_permalink()?>">
      <img class="news_image" src="<?=get_the_post_thumbnail_url()?>">
    </a>
    <p class="news_date">
      <?=get_the_date()?>
    </p>    
    <p class="news_content">
      <?=do_shortcode(the_excerpt())?>
    </p>
    <a class="news_image_button" href="<?=get_permalink()?>">
      <span class="button"><?=__("Read More")?></span>
    </a>
  </article>        

<?
        
  endwhile; /* End the main loop */ 
 
   
?>


<? } ?>

<? 
  if ($mode=="list_course_card_by_slug") { 
    print(nau_courses_gallery([ "filter"=>$slug ]));    
  } 
?>

</div>

<!-- ends homepage body content --> 

<?php
  get_template_part( "global", "footer" );
?>
<?php get_footer(); ?>

