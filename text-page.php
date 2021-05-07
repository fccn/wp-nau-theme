<?php /* Template Name: General Text Page */ ?>

<?php 
  $slug = $post->post_name;
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages text-page $slug'";
  
  get_header(); 
  
  include "inc/simple_header.php";
?>
<div id="body-content"> 
  <section id="section-<?php echo $slug; ?>">
    <?php echo do_shortcode(get_post_field('post_content', $post->ID)) ?>
  </section>
</div>

<?php
  get_template_part( "partials/global", "footer" );
  get_footer(); 
?>
