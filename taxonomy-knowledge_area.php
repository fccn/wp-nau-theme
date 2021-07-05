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

  function get_the_term_slug() {
    return is_tax('knowledge_area') ? get_the_terms('', 'knowledge_area' )[0]->slug : NULL;
  }

  $term_slug = get_the_term_slug();
  
  ?>
  <main id="body-content">
        <?php
        // Start the loop.
       
        echo nau_courses_knowledge_area([], $term_slug);
            
        // End the loop.
        ?>
  
  </main><!-- .content-area -->
  
<?php
  get_template_part( "partials/global", "footer" );
  get_footer(); 
?>
