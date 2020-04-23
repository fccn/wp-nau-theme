<?php /* Template Name: General Text Page */ ?>

<?php 
  $slug = $post->post_name;
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages text-page $slug'";
  
  get_header(); 
  
  include "inc/simple_header.php";
?>
<div id="body-content"> 
  <article>
    <?= do_shortcode(get_post_field('post_content', $pageID)) ?>
  </article>
</div>

<?php
  get_template_part( "global", "footer" );
  get_footer(); 
?>
