<?php /* Template Name: Entity Page */ ?>

<?php get_header(); ?>

<!-- starts Homepage grey menu opacity overlay when user click on menu button -->
  <div id="menu-overlay"></div> 
  <!-- ends Homepage grey menu opacity overlay when user click on menu button -->
  
  <?php
    get_template_part( "entity", "slider" );
  ?>


<!-- starts homepage body content -->
<div id="body-content">  

    <!-- starts all institution courses -->
    <section id="entity-description">
        <h2><?= get_post_field('post_title', $post->ID) ?></h2>
        <?= do_shortcode(get_post_field('post_content', $post->ID)) ?>
    </section>

  
  <?php
    get_template_part( "entity", "courses");
    get_template_part( "entity", "aside");    
  ?>

  
</div>
<!-- ends homepage body content --> 

<!-- starts homepage footer -->
<?php get_footer(); ?>
