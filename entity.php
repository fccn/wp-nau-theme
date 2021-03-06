<?php /* Template Name: Entity Page */ ?>
<?php 
  $nauPageID = "institution";
  $nauBodyClass = "class='secondary-pages entity'";
  
  $entity = load_entity($post);
  
  $slug = $entity["slug"] != "" ? $entity["slug"] : $entity["sigla"];

  if ($slug != "") {
    $courses = nau_entity_courses($post);
  }
  
  get_header(); 
?>

<!-- starts homepage header -->
<section id="entity-<?php echo get_the_ID(); ?>" class="entity-page-detail">

    <header class="entity-page-detail-header">
      <div class="entity-page-detail-meta">
        <h1><?php echo get_the_title(); ?></h1>
        <span class="title-border"></span>
      </div>
      <div class="entity-page-detail-logo">
            <img src="<?php echo $entity["square_logo"]?>" alt="<?php echo $entity["sigla"]?>" title="<?php echo $entity["name"]?>">
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
<?php if (count($courses) > 0): ?>
  <div class="entity-container">
    <h2><?php echo nau_trans("Available courses"); ?></h2>
      <div class="entity-courses">
        <section id="highlighted-courses" class="course-gallery">   
          <?php get_template_part( "partials/courses", "cards" ); 
          ?>
        </section>
      </div>
<!-- ends homepage body content --> 
    </div>
<?php endif; ?>
    

<?php
  get_template_part( "partials/global", "footer" );
?>

<!-- starts homepage footer -->
<?php get_footer(); ?>
