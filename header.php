<?php
  global $nauPageID;
  global $nauBodyClass;
  
?><!doctype html>
<html <?php language_attributes(); ?>>
<?php
  require get_template_directory() . '/inc/global-head.php';
?>
<body id="<?php echo $nauPageID?>" <?php echo $nauBodyClass?>>
  <!-- starts container -->
  <a href="<?php echo get_the_permalink(); ?>#main-container" class="screen-reader-text"><?php echo nau_trans('Skip to main content'); ?></a>
  <?php require get_template_directory() . '/inc/global-top-menu.php'; ?>
  <div id="main-container" class="main-content">

<!-- /header.php -->


