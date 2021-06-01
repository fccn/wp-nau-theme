<?php /* Template Name: General Text Page */ ?>

<?php 
  $slug = $post->post_name;
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages text-page $slug'";
  
  get_header(); 
  
  include "inc/simple_header.php";
?>
<main id="body-content"> 
  <article>
    <?php echo do_shortcode(get_post_field('post_content', $post->ID)) ?>
  </article>
</main>

<?php
  get_template_part( "partials/global", "footer" );
  get_footer(); 
?>
