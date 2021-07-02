<?php
/* 
Template Name: Blog List Page 
*/

  $slug = $post->post_name;
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages text-page $slug'";
  
  get_header(); 
  
  include "inc/simple_header.php";

  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $query = new WP_Query(
    array( 
      'post_type' => 'post',
      'paged' => $paged
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
    ?>
      <div class="news-pagination">
        <?php 
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i></i> %1$s', nau_trans( 'Previous' ) ),
                'next_text'    => sprintf( '%1$s <i></i>', nau_trans( 'Next' ) ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
        ?>
      </div>
  <? else: ?>
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
