  <?php
    global $list_title;
    global $entities;
    
    $title = explode("|", $list_title);
    
  ?>   
  
  <!-- starts highlighted courses -->
  <section id="highlighted-courses" class="main-gallery">   
  
   <?php if ($list_title != ""): ?>
     <h2><?php echo $title[0]?> <span class="normal-font-weight"><?php echo $title[1]?></span></h2>   
   <? endif; ?> 
    
    <div class="entities-wrap">    
    
    <?php foreach ($entities as $entity):
      
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
            <a href="<?php echo $entity["url"]?>" class="image">
              <img class="entity-image" src="<?php echo $entity["image"]?>" alt="<?php echo $entity["name"]?>">
            </a>
            <a href="<?php echo $entity["url"]?>" title="<?php echo $entity["name"]?>"  class="logo">
              <img class="square-logo" src="<?php echo $entity["logo"]?>" alt="<?php echo $entity["name"]?>">
            </a>
          </div>      
          <div class="card-content"> 
            <h3 class="entity-long-name"><?php echo $entity["name"]?></h3>
          </div>
          <div class="card-action"> 
            <a class="know-more-icon" href="<?php echo $entity["url"]?>" title="<?php echo nau_trans("Learn more about this entity")?>"><?php echo nau_trans("View entity")?></a>         
          </div>  
      </div>
      
    <? endforeach; ?>
    
    </div>
  </section>    
