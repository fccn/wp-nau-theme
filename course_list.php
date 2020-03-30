<?php /* Template Name: Course List */ ?>

<?php 
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  get_header(); 
?>

<div id="home-content">

<?php   
  $course_list_title = _("All|courses");
  get_template_part( "courses", "list" );
?>

</div>

<?php
  get_template_part( "global", "footer" );
?>


<?php get_footer(); ?>


