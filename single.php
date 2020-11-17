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
  <div id="body-content">
    
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
  
            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part('content', get_post_format());            
            
            
            /*
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            */
              
/* TO-DO - ativar! */

/*              
            // Previous/next post navigation.
            print ("<div class='prev-next'>");
            the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next post:' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous post:' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) );
            print("</div>");
*/
              
        // End the loop.
        endwhile;
        ?>
  
    </div><!-- .content-area -->
  
<?php
  get_template_part( "partials/global", "footer" );
  get_footer(); 
?>
