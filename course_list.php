<?php 
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  
  get_header(); 
  
  include "inc/simple_header.php";
?>
<!-- COURSE_LIST -->
<div id="home-content">
<?php   
  $course_list_title = __("All|courses");
  get_template_part( "courses", "list" );
?>
</div>
<?php
  get_template_part( "global", "footer" );
  get_footer(); 
?>
