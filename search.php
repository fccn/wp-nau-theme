<?php 
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  
  $page_title = $wp_query->found_posts . " " . __('results') . " " . __('for search string:') . " \"" . get_search_query() . "\"";
  
  get_header();
  
  include "inc/simple_header.php";
?>

<div id="text-content"> 
  <div>
    <form role="search" method="post" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <label>
            <span class="screen-reader-text"><?php echo __( 'Search for:' ) ?></span>
            <input type="search" class="search-field"
                placeholder="<?php echo __( 'Search ...') ?>"
                value="<?php echo get_search_query() ?>" name="s"
                title="<?php echo __( 'Search for:' ) ?>" />
        </label>
        <input type="submit" class="search-submit"
            value="<?php echo __( 'Search' ) ?>" />
    </form>
    
    <h1 class="search-title">
      
    </h1>

    <div class="result-set">
    <?php    
      foreach($wp_query->posts as $post) {
        get_template_part( 'content', 'search' );
      }
    ?>
    </div>
  </div>

</div>
<!-- ends homepage body content --> 

<?php
  get_template_part( "global", "footer" );
?>
<?php get_footer(); ?>

