  <?php
    global $list_title;
    global $entities;
    
    $title = explode("|", $list_title);
    
  ?>   
  
  <!-- starts highlighted courses -->
  <section id="highlighted-courses" class="main-gallery">   
  
   <? if ($list_title != "") { ?>
     <h2><?=$title[0]?> <span class="normal-font-weight"><?=$title[1]?></span></h2>   
   <? } ?> 
    
    <div class="entities-wrap">    
    
    <? foreach ($entities as $entity) { 
      
      $logo = get_field('square-logo', $entity->ID);
      if ($logo == "") {
          $logo = get_field('logo', $entity->ID);
      }
      
      $image = get_the_post_thumbnail_url( $entity->ID, 'full' );
      
      $youtube = get_field("youtube", $entity->ID);

      $entity = [
          "name" => $entity->post_title,
          "url" => get_permalink($entity->ID),
          "sigla" => get_field("sigla", $entity->ID),
          "logo" => $logo, 
          "image" => $image,
          "video" => $youtube, 
      ];
    
    ?>
    
      <ul class="card gallery-cell">
      <li class="top"> 
        <a href="<?=$entity["url"]?>" class="image">
          <img class="entity-image" src="<?=$entity["image"]?>" alt="<?=$entity["name"]?>">
        </a>
        <a href="<?=$entity["url"]?>" title="<?=$entity["name"]?>"  class="logo">
          <img class="square-logo" src="<?=$entity["logo"]?>" alt="<?=$entity["name"]?>">
        </a>
      </li>      
      <li>
        <h3><?=$entity["name"]?><br>
          <span class="aside-institution"><a href="<?=$entity["url"]?>" class="banner-entity"><?=$entity["sigla"]?></a></span></h3>        
      </li>
      <li> 
        <? if ($entity["video"] || 1) { ?>
        <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$entity["video"]?>" }' title="<?=__("See video")?>">
          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white.svg" alt="<?=__("See a video about this entity")?>">           
        </a>
        <? } ?>
        <a class="know-more-icon" href="<?=$entity["url"]?>" title="<?=__("Learn more about this entity")?>"><?=__("+Info")?></a>         
      </ul>
      
    <? } ?>
    
    </div>
  </section>    
