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
    <section class="404-page">
        <h2 style="margin-bottom:2rem;"><?php echo nau_trans( 'The page you are looking for seems to be unavailable.', 'nau-theme')?></h2>
        <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo nau_trans( 'Go back to NAU main page', 'nau-theme') ?></a></p>
    </section>
 
</main>

<?php
get_template_part( "partials/global", "footer" );
get_footer(); 
?>