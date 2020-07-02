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
  if ($pixel_code != "") {
  ?>
    <script>
      fbq('track', '<?=$pixel_code?>');
    </script>
  <? } 

  $inc = get_template_directory() . "/inc/banner/" . $header . ".php";
  
  include $inc;
