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

  <article class="news-article">
    <a class="news-article__link" href="<?php echo get_permalink(); ?>">
      <div class="news-article__header">
        <img class="news-article__image" src="<?php the_post_thumbnail_url('thumbnail'); ?>">
      </div>
      
      <div class="news-article__description">
        <h2><?php the_title(); ?></h2>
        <p class="news-article__description-date"><?php echo get_the_date( 'l, j F Y' );?></p>
        <p class="news-article__description-excerpt"><?php echo do_shortcode(the_excerpt()); ?></p>
      </div>
      <!--<a class="news_articleimage_button" href="<?php echo get_permalink(); ?>">
        <?php echo nau_trans("Read More"); ?>
      </a>-->
    </a>
</article>

<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>

<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>

<?
   endwhile; /* End the main loop */ 
?>
</div>
<?
  get_template_part( "partials/global", "footer" );
  get_footer(); 
?>  