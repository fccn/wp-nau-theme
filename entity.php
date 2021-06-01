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
    <img src="assets/img/banner-shape-long-blue.svg" class="slider-mask" alt="Banner NAU shape">  
    <?php else: ?>
    <img src="assets/img/banner-shape-long-navy-blue.svg" class="slider-mask" alt="Banner NAU shape">  
    <?php endif; ?>
  </div>
</section>

<!-- starts homepage body content -->
<main id="body-content">  

    <!-- starts all institution courses -->
    <article class="entity-description">
      <div class="description">
        <?php echo  do_shortcode(get_post_field('post_content')) ?>
      </div>
    </article>
    <? set_query_var("entity", $entity); ?>
    <?php get_template_part("partials/entity", "aside"); ?>

</main>
<div class="entity-courses">
<?php
        $slug = $entity["slug"];

        if ($slug == "") {
          $slug = $entity["sigla"];
        }

        if ($slug != "") {
          $course_list_title = nau_trans("Courses|running");
          $courses = nau_entity_courses($post);

          if (count($courses) > 0) { 
      ?>
            <section id="highlighted-courses" class="course-gallery">   
              <h2>
                <?php $title = explode("|", $course_list_title); ?>
                <?php echo $title[0]?> <span class="normal-font-weight"><?php echo $title[1]?></span>
              </h2>

              <?php 
                $courses = $courses;
                get_template_part( "partials/courses", "cards" ); 
              ?>
            </section>
      <?php 
          }
        }
      ?>
    </div>
<!-- ends homepage body content --> 

    

<?php
  get_template_part( "partials/global", "footer" );
?>

<!-- starts homepage footer -->
<?php get_footer(); ?>
