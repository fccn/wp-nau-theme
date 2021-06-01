<?php 
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  
  get_header(); 
  
  include "inc/simple_header.php";
  
  ?>
  <!-- SINGLE.PHP -->
  <main id="body-content">
    
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();

            get_template_part('content', get_post_format());            
            
        // End the loop.
        endwhile;
        ?>
  
  </main><!-- .content-area -->
  
<?php
  get_template_part( "partials/global", "footer" );
  get_footer(); 
?>
