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
    
    <div class="card-container">
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
        <article class="card">
          <a href="<?php echo $entity["url"]?>">
            <div class="card-header__entity" style="background-image: url(<?php echo $entity["image"]?>);"></div>
            <div class="card-content">
              <div class="card-content--entity">
                <span style="background-image: url(<?php echo $entity["logo"]?>);" class="entity-logo"></span>
              </div>
              <div class="card-content--title"><?php echo $entity["name"]?></div>
            </div>
            <div class="card-actions">
              <span href="<?php echo $entity["url"]?>" title="<?php echo nau_trans("Learn more about this entity")?>" class="btn-know-more">
                <?php echo nau_trans("View entity")?>
              </span>
            </div>
          </a>
        </article>
      <? endforeach; ?>
    </div>
  </section>    
