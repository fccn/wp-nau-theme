<?

  [$color, $opacity, $hue, $grayscale, $image, $header] = get_page_fields();  
  
  if ($color == null) $color = "#000000";
  if ($opacity == null) $opacity = 0.1;
  if ($grayscale == null) $grayscale = 0.1;
  if ($header == null) $header = "nau";
  
  
  if (!isset($page_title)) {
      $page_title = get_the_title();
      if ($page_title == '') {
          $page_title = ":: " . get_post_type() . " ::";
      }
  }
  
  $pixel_code = get_field('pixel-track-code');
  $facebook_pixel_id = get_option('nau_facebook_pixel'); 
  if ($facebook_pixel_id != "" && $pixel_code != "") {
  ?>
    <script>
      if (typeof fbq === "function") {
        fbq('track', '<?=$pixel_code?>');
      }
    </script>
  <? } 

  $inc = get_template_directory() . "/inc/banner/" . $header . ".php";
  
  //include $inc;
?>

<section id="page-<?php echo get_the_ID(); ?>" class="page-detail">

    <header class="page-detail-header">
      <div class="page-detail-meta">
        <h1><?php echo get_the_title(); ?></h1>
        <span class="title-border"></span>
      </div>
    </header>

</section>

