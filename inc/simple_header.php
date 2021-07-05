<?

  $category_page_title = is_tax('knowledge_area') ? nau_trans('Courses on') . ' ' . get_the_terms(get_the_ID(), 'knowledge_area')[0]->name : get_the_title();
  
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

?>

<section id="page-<?php echo get_the_ID(); ?>" class="page-detail">
    <header class="page-detail-header">
      <div class="page-detail-meta">
        <h1><?php echo $category_page_title; ?></h1>
        <span class="title-border"></span>
      </div>
    </header>

</section>

