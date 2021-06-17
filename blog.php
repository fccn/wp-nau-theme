<?php
/* 
Template Name: Blog List Page 
*/

  $slug = $post->post_name;
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages text-page $slug'";
  
  get_header(); 
  
  include "inc/simple_header.php";

  $query = new WP_Query(
    array( 
      'post_type' => 'post',
      'posts_per_page' => -1,
    )
  );
  
?>

<main id="body-content">
  <div class="news-container">
    <?php
      if($query->have_posts()) :
        while($query->have_posts()) :
          $query->the_post();

          get_template_part( 'partials/single', 'post');

        endwhile;
      else:
    ?>
      <p><?php echo nau_trans('There are no available articles in this language.'); ?></p>
    <?php
      endif;

      wp_reset_postdata();
    ?>
  </div>

</main>

<?php
  get_template_part( "partials/global", "footer" );
  get_footer(); 
?>
