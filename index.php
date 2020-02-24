<?php /* Template Name: Homepage Template */ ?>

<?php get_header(); ?>

<!-- starts Homepage grey menu opacity overlay when user click on menu button -->
  <div id="menu-overlay"></div> 
  <!-- ends Homepage grey menu opacity overlay when user click on menu button -->
<!-- starts homepage header -->
  <?php  
    get_template_part( "home", "header" );
  ?>
<!-- starts homepage body content -->
<div id="home-content"> 
  
  <?php 
  
    get_template_part( "home", "highlight" );
    get_template_part( "home", "running" );
    get_template_part( "home", "entities" );
    
  ?>
  
  
  
  
</div>
<!-- ends homepage body content --> 

<!-- starts homepage footer -->
<?php get_footer(); ?>
