<?php /* Template Name: Entity Page */ ?>
<?php 
  $nauPageID = "institution";
  $nauBodyClass = "class='secondary-pages'";
  get_header(); 
?>

<?php

  if( has_post_thumbnail() ) {
    $url = get_the_post_thumbnail_url();
  } else {
    $url = "assets/img/banner-01.jpg";
  }; 
    
  $color = get_custom_value('banner-color', 'black'); 
  
?>

<style>
body#institution div#home-slider {
    background: transparent url("<?=$url?>") no-repeat 0 -74px !important;       
}    

body#institution div#home-slider div#nau-shape {
  filter: grayscale(50%) opacity(0.8) hue-rotate(10deg);
  -webkit-filter: grayscale(50%) opacity(0.8) hue-rotate(10deg);
}


</style>

<!-- starts Homepage grey menu opacity overlay when user click on menu button -->
  <div id="menu-overlay"></div> 
  <!-- ends Homepage grey menu opacity overlay when user click on menu button -->
  
<!-- starts homepage header -->
<section id="flexible-content-area"> 
  
  <!-- starts carrousel of banners -->
  <div id="home-slider">    
    <div id="nau-shape">
    <a href="<?= get_custom_value('website') ?>"><img width="100" height="100" id="secondary-course-logo" src="<?= get_post_field('logo', $post->ID) ?>" alt="<?= get_custom_value('nau-id') ?>"></a>
      <h1><?= get_post_field('post_title') ?></h1> 
    </div>
  </div>
  <!-- ends carrousel of banners --> 
</section>

<!-- starts homepage body content -->
<div id="home-content">  

    <!-- starts all institution courses -->
    <section id="entity-description">        
        <?= do_shortcode(get_post_field('post_content')) ?>
        
        <?php
          $course_list_title = _("Courses") . "|" . get_custom_value('sigla');
          get_template_part( "courses", "list" );
        ?>
        
    </section>
  
  <?
    get_template_part( "entity", "aside");    
  ?>
  
</div>
<!-- ends homepage body content --> 

<?php
  get_template_part( "global", "footer" );
?>

<!-- starts homepage footer -->
<?php get_footer(); ?>
