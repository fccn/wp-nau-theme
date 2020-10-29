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
  <div id="main-container">
    <?php
      require get_template_directory() . '/inc/global-top-menu.php';
    ?>

<!-- /header.php -->


