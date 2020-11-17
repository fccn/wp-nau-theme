<?php /* Template Name: Raw Page */ ?>

<?php 
  $slug = $post->post_name;
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages text-page $slug'";
  
  get_header(); 
  
  include "inc/simple_header.php";
?>
<?php echo  do_shortcode(get_post_field('post_content', $pageID)) ?>


<!-- ends homepage body content --> 
<?php
  get_template_part( "partials/global", "footer" );
  get_footer(); 
?>

