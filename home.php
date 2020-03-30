<?php /* Template Name: Homepage Template */ ?>

<?php 
  $nauPageID = "homepage";  
  $nauBodyClass = "";
  get_header(); 
?>


<?php get_template_part( "homepage", "banner" ); ?>

<div id="home-content">

<?php   
  $course_list_title = _("Courses|highlighted");
  get_template_part( "courses", "list" );
  
  $course_list_title = _("Courses|running");
  get_template_part( "homepage", "running-courses" );

  $course_list_title = _("Entity|founders");
  $entities = nau_get_pages("entidade", ["filter" => "fundador"]);  
  get_template_part( "homepage", "entities" );

?>

<!-- ends homepage body content --> 
</div>

<?php
  get_template_part( "global", "footer" );
  get_footer(); 
?>


