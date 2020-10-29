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
  filter: hue-rotate(<?php echo $hue?>deg) opacity(<?php echo $opacity?>) grayscale(<?php echo $grayscale?>); 
  -webkit-filter: hue-rotate(<?php echo $hue?>deg) opacity(<?php echo $opacity?>) grayscale(<?php echo $grayscale?>);
}



body#institution div#home-slider h1 {
  color: <?php echo $color?>; 
}

body#institution div#home-slider {        
        background: url("<?php echo $image?>") no-repeat !important;
        background-size: cover !important;
        background-repeat: no-repeat  !important;
        background-position: 50% 50% !important;
    }
    
</style>

<section id="flexible-content-area">
  <div id="home-slider">        
    <div id="slider-objects">
    <div class="entity-branding-container">  
      <img class="secondary-course-logo" src="<?php echo $entity["square_logo"]?>" alt="<?php echo $entity["sigla"]?>" title="<?php echo $entity["name"]?>">
      <h1><?php echo $entity["name"]?></h1> 
      </div>
    </div>
    <?php if ($header == "nau"): ?>
    <img src="assets/img/banner-shape-long-blue.svg" class="slider-mask">  
    <?php else: ?>
    <img src="assets/img/banner-shape-long-navy-blue.svg" class="slider-mask">  
    <?php endif; ?>
  </div>
</section>

<?php if (current_user_can('edit_posts')): ?>
   <div class="nau_management">
      <? if ($entity["confluence_url"] != ""): ?>
       <a href="<?php echo $entity["confluence_url"]?>"><span class="material-icons">info</span></a>
      <? endif; ?>
   </div>
      <? endif; ?>

<!-- starts homepage body content -->
<div id="home-content">  

    <!-- starts all institution courses -->
    <section id="entity-description">        
      <div class="description">
        <?php echo  do_shortcode(get_post_field('post_content')) ?>
      </div>
      <div class="courses">
        <?php
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
        <?php
          include("entity-aside.php");
        ?>
        
    
</div>
<!-- ends homepage body content --> 

<?php
  get_template_part( "partials/global", "footer" );
?>

<!-- starts homepage footer -->
<?php get_footer(); ?>
