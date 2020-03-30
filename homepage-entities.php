  <?php
    global $course_list_title;
    global $entities;
    
    $title = explode("|", $course_list_title);
  ?>   
  
  <!-- starts entidades NAU -->
  <section id="entities-nau">
    <h2><?=$title[0]?> <span class="normal-font-weight"><?=$title[1]?></span></h2>
    <div class="entities-wrap">
    <ul id="entities-nau-logos">
      <?php 
        foreach($entities as $entity) {
            
        $logo = get_custom_value("logo", "", $entity["ID"]);
      ?>        
      <li><a href="<?=get_permalink($entity["ID"])?>"><img src="<?=$logo?>" alt="<?=$entity["post_title"]?>" title="<?=$entity["post_title"]?>"></a></li>      
      <?php  
        }
      ?>
    </ul>
  </section>
  <!-- ends entidades NAU --> 

