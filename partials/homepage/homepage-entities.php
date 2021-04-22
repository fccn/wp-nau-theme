  <?php
    $entities = nau_get_posts("entidade", ["filter" => "fundador"]);;
  ?>   
  
  <!-- starts entidades NAU -->
  <section id="entities-nau">
    <div class="entities-wrap">
    <ul id="entities-nau-logos">
      <?php 
        foreach($entities as $entity):
            
        $logo = get_custom_value("logo", "", $entity->ID);
      ?>        
      <li><a href="<?php echo get_permalink($entity)?>"><img src="<?php echo $logo?>" alt="<?php echo $entity->post_title?>" title="<?=nau_trans("Visit page of")?> <?php echo $entity->post_title?>"></a></li>      
        
        <?php   endforeach; ?>
    
    </ul>
    </div>
  </section>
  <!-- ends entidades NAU --> 

