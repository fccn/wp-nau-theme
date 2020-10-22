<?

?>
  <!-- starts aside course info -->
  <aside>
  
    <h3><span class="blue-vertical-line">|</span> <?=$entity["name"]?></h3>  
    
    <? if (! empty($entity["video"])) { ?>  
      <div id="course-video-thumbnail">
        <iframe width="100%" height="220" 
          src="https://www.youtube.com/embed/<?=$entity["video"]?>" 
          frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
      </div>
    <? } ?>
    
    <ul class="course-related-links">

        <?php
        echo nau_generate_custom_value_meta_html(get_custom_value("meta"), $entity);
        ?>

      <li class="course-details share-course"><a href="" id="facebook-share-btt" rel="nofollow" target="_blank" class=""><?=nau_trans("Share")?>  </a></li>                    
    
    </ul>
  </aside>
  <!-- ends aside course info -->  
