<?php
  global $nauPageID;
  global $nauBodyClass;
  
?><!doctype html>
<html <?php language_attributes(); ?>>
<?php
  require get_template_directory() . '/inc/global-head.php';
?>
<body id="<?php echo $nauPageID?>" <?php echo $nauBodyClass?>>
    <a href="#main-container" class="screen-reader-text"><?php _e( 'Skip to content', 'nau-theme' ); ?></a>
    <?php require get_template_directory() . '/inc/global-top-menu.php'; ?>
    <main id="main-container" class="content-container">

<!-- /header.php -->


