<?

  [$color, $opacity, $hue, $image, $header] = get_page_fields();  
  
  if (!$color) $color = "#FFFFFF";
  if (!$opacity) $opacity = 0.1;
  if (!$header) $header = "nau";
  
  
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
