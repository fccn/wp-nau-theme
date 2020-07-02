<?php 
  $nauPageID = "secondary";
  # $nauBodyClass = "class='secondary-pages'";
  $page_title = nau_trans("News");
  
  get_header(); 
  
  include "simple_header.php";
?>
<div id="text-content"> 
<?
  while( have_posts() ): the_post(); /* start main loop */ ?>

  <article class="news_article">
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
      <span class="button"><?=nau_trans("Read More")?></span>
    </a>
  </article>        

<?
   

   endwhile; /* End the main loop */ 
   
?>
</div>
<?
  get_template_part( "global", "footer" );
  get_footer(); 
?>  