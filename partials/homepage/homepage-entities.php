  <?php
    global $course_list_title;
    global $entities;
    
    $title = explode("|", $course_list_title);
  ?>   
  
  <!-- starts entidades NAU -->
  <section id="entities-nau">
    <h2><?php echo $title[0]?> <span class="normal-font-weight"><?php echo $title[1]?></span></h2>
    <div class="entities-wrap">
    <ul id="entities-nau-logos">
      <?php 
        foreach($entities as $entity):
            
        $logo = get_custom_value("logo", "", $entity->ID);
      ?>        
      <li><a href="<?php echo get_permalink($entity)?>"><img src="<?php echo $logo?>" alt="<?php echo $entity->post_title?>" title="<?php echo $entity->post_title?>"></a></li>      
        
        <?php   endforeach; ?>
    
    </ul>
  </section>
  <!-- ends entidades NAU --> 

