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
    
      <div class="card gallery-cell">
          <div class="top"> 
            <a href="<?=$entity["url"]?>" class="image">
              <img class="entity-image" src="<?=$entity["image"]?>" alt="<?=$entity["name"]?>">
            </a>
            <a href="<?=$entity["url"]?>" title="<?=$entity["name"]?>"  class="logo">
              <img class="square-logo" src="<?=$entity["logo"]?>" alt="<?=$entity["name"]?>">
            </a>
          </div>      
          <div class="card-content"> 
            <h3 class="entity-long-name"><?=$entity["name"]?></h3>
          </div>
          <div class="card-action"> 
            <a class="know-more-icon" href="<?=$entity["url"]?>" title="<?=nau_trans("Learn more about this entity")?>"><?=nau_trans("+Info")?></a>         
          </div>  
      </div>
      
    <? } ?>
    
    </div>
  </section>    
