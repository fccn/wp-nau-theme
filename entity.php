<?php /* Template Name: Entity Page */ ?>
<?php 
  $nauPageID = "institution";
  $nauBodyClass = "class='secondary-pages entity'";
  
  $entity = load_entity($post);
  //[$color, $opacity, $hue, $grayscale, $image, $header] = get_page_fields();  
  
  $slug = $entity["slug"];

  if ($slug == "") {
    $slug = $entity["sigla"];
  }

  if ($slug != "") {
    $courses = nau_entity_courses($post);
  }
  get_header(); 
?>

<!-- starts homepage header -->
<section id="page-<?php echo get_the_ID(); ?>" class="page-detail">

    <header class="page-detail-header">
      <div class="page-detail-meta">
        <h1><?php echo get_the_title(); ?></h1>
        <span class="title-border"></span>
      </div>
    </header>

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
  <div class="entity-container">
  <h2><?php echo nau_trans("Available courses"); ?></h2>
<div class="entity-courses">
<?php

      if (count($courses) > 0) { 
      ?>
            <section id="highlighted-courses" class="course-gallery">   
              <?php 
                $courses = $courses;
                get_template_part( "partials/courses", "cards" ); 
              ?>
            </section>
      <?php 
      }

      ?>
    </div>
<!-- ends homepage body content --> 
      </div>
    

<?php
  get_template_part( "partials/global", "footer" );
?>

<!-- starts homepage footer -->
<?php get_footer(); ?>
