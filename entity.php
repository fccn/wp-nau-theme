<?php /* Template Name: Entity Page */ ?>
<?php 
  $nauPageID = "institution";
  $nauBodyClass = "class='secondary-pages entity'";
  
  $entity = load_entity($post);
  [$color, $opacity, $hue, $grayscale, $image, $header] = get_page_fields();  
  
  if ($color == null) $color = "#000000";
  if ($opacity == null) $opacity = 0.1;
  if ($grayscale == null) $grayscale = 0.1;
  if ($header == null) $header = "nau";

  get_header(); 
?>

<!-- starts homepage header -->

<style>
#home-slider .slider-mask {
  filter: hue-rotate(<?=$hue?>deg) opacity(<?=$opacity?>) grayscale(<?=$grayscale?>); 
  -webkit-filter: hue-rotate(<?=$hue?>deg) opacity(<?=$opacity?>) grayscale(<?=$grayscale?>);
}



body#institution div#home-slider h1 {
  color: <?=$color?>; 
}

body#institution div#home-slider {        
        background: url("<?=$image?>") no-repeat !important;
        background-size: cover !important;
        background-repeat: no-repeat  !important;
        background-position: 50% 50% !important;
    }
    
</style>

<section id="flexible-content-area">
  <div id="home-slider">        
    <div id="slider-objects">      
      <img class="secondary-course-logo" src="<?=$entity["square_logo"]?>" alt="<?=$entity["sigla"]?>" title="<?=$entity["name"]?>">
      <h1><?=$entity["name"]?></h1> 
    </div>
    <? if ($header == "nau") { ?>
    <img src="assets/img/banner-shape-long-blue.svg" class="slider-mask">  
    <? } else { ?>
    <img src="assets/img/banner-shape-long-navy-blue.svg" class="slider-mask">  
    <? } ?>
  </div>
</section>

<? if (current_user_can('edit_posts')) { ?>
   <div class="nau_management">
      <? if ($entity["confluence_url"] != "") { ?>
       <a href="<?=$entity["confluence_url"]?>"><span class="material-icons">info</span></a>
     <? } ?>
   </div>
<? } ?>

<!-- starts homepage body content -->
<div id="home-content">  

    <!-- starts all institution courses -->
    <section id="entity-description">        
        <div class="description">
        <?= do_shortcode(get_post_field('post_content')) ?>    
        </div>
        <div class="courses">
        <?
          $slug = $entity["slug"];
          if ($slug == "") {
            $slug = $entity["sigla"];
          }
          if ($slug != "") {
            $course_list_title = nau_trans("Courses|running");
            $courses = nau_entity_courses($post);
            get_template_part( "courses", "cards" );
            
          }
        ?>
        </div>        
        </section>
        <?
          include("entity-aside.php");
        ?>
        
    
</div>
<!-- ends homepage body content --> 

<?php
  get_template_part( "global", "footer" );
?>

<!-- starts homepage footer -->
<?php get_footer(); ?>
