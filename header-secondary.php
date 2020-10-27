<?php
       
  use lloc\Msls\MslsBlogCollection;

  $blog = MslsBlogCollection::instance()->get_current_blog();
  $language = $blog->get_language();
  
?>
<!doctype html>
<html lang="<?php echo $language?>">
<?php
  require get_template_directory() . '/inc/global-head.php';
?>
<?php
  get_header();
?>
<body id="secondary"class='secondary-pages'>
    <?php
      require get_template_directory() . '/inc/global-top-menu.php';
    ?>
    
