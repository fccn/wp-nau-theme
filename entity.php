<?php /* Template Name: Entity Page */ ?>
<?php 
  $nauPageID = "institution";
  $nauBodyClass = "class='secondary-pages'";
  
  $entity = load_entity($post);
  [$color, $opacity, $hue, $image] = get_page_fields();  

  get_header(); 
?>

<!-- starts homepage header -->

<style>
#home-slider .slider-mask {
  filter: hue-rotate(<?=$hue?>deg) opacity(1) grayscale(<?=$opacity?>); 
}

#home-slider h1 {
  color: <?=$color?>; 
}

body#institution div#home-slider {
    background: url("<?=$entity['url_image']?>")    
}

</style>

<section id="flexible-content-area">
  <div id="home-slider">        
    <div id="slider-objects">      
      <a class="link-logo" href="<?=$entity["website"]?>"><img class="secondary-course-logo" src="<?=$entity["square_logo"] ?>" alt="<?=$entity["sigla"]?>"></a>
      <h1><?=$entity["name"]?></h1> 
      <div class="slider-sigla"><a href="<?=$entity["website"]?>"><?=$entity["sigla"]?></a></div>
    </div>
    <img src="assets/img/banner-shape-long-blue.svg" class="slider-mask">  
  </div>
</section>

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
            $course_list_title = __("Courses|running");
            $courses = nau_entity_courses($post);
            get_template_part( "courses", "cards" );
            
          }
        ?>
        </div>        
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
