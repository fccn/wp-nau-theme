<?php
       
  use lloc\Msls\MslsBlogCollection;

  $blog = MslsBlogCollection::instance()->get_current_blog();
  $language = $blog->get_language();
  $url_ref =  get_msls_permalink("en_US");  
?><!doctype html>
<html lang="<?=$language?>">
<?php
  require get_template_directory() . '/inc/global-head.php';
?>

<body id="homepage">
    <?php
      require get_template_directory() . '/inc/global-top-menu.php';
    ?>
    
