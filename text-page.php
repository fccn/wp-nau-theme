<?php /* Template Name: General Text Page */ ?>

<?php get_header(); ?>

<!-- starts Homepage grey menu opacity overlay when user click on menu button -->
<div id="menu-overlay"></div>
<!-- ends Homepage grey menu opacity overlay when user click on menu button --> 
<!-- starts homepage body content -->
<div id="body-content"> 

  <style>
    .top-image {        
        height: 100px;
    }
  </style>

  <div class="top-image">
<?php

  if( has_post_thumbnail() ) {
    $url = get_the_post_thumbnail_url();
  } else {
    $url = "assets/img/banner-01.jpg";
  }; 
?>
    <img src="<?=$url?>" width="100%" height="100px">
  </div>

  <article>
  <h2><?= get_post_field('post_title', $post->ID) ?></h2>
  
  <?= do_shortcode(get_post_field('post_content', $post->ID)) ?>


<?php 
# comments_template(); 
?>

  </article>


  
</div>
<!-- ends homepage body content --> 

<!-- starts homepage footer -->
<?php get_footer(); ?>
