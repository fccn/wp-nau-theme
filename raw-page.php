<?php /* Template Name: Raw Page */ ?>

<?php 
  $slug = $post->post_name;
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages text-page $slug'";
  
  get_header(); 
  
  include "inc/simple_header.php";
?>
<?= do_shortcode(get_post_field('post_content', $pageID)) ?>


<!-- ends homepage body content --> 
<?php
  get_template_part( "global", "footer" );
  get_footer(); 
?>

