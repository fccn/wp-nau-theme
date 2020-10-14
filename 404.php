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
    <section class="404-page">
        <h2 style="margin-bottom:2rem;"><?php esc_html_e( 'The page you are looking for seems to be unavailable.', 'nau-theme')?></h2>
        <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html_e( 'Go back to NAU main page', 'nau-theme') ?></a></p>
    </section>
 
</div>

<?php
get_template_part( "global", "footer" );
get_footer(); 
?>