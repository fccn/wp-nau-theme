<?
  $image_url = get_field('image', $post);
  if( $image_url == "") {
    if ( has_post_thumbnail($post) ) {
      $image_url = get_the_post_thumbnail_url($post);
    } else {
      $image_url = "assets/img/banner-01.jpg";
    };
  }; 
?>
<div class="result">    
    <div class="link_image_wrapper"><a class="link_image" href="<?=get_permalink($post->ID)?>"><img class="image" src="<?=$image_url?>"></a></div>
    <div class="title"><a href="<?=get_permalink($post->ID)?>"><?=$post->post_title?></a></div>
    <div class="excerpt"><?=get_the_excerpt($post)?><div class="tags"><?=nau_list_tags()?><?=nau_list_categories()?></div></a></div>
    
</div>

