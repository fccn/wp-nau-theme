<?

?>
  <!-- starts aside course info -->
  <aside>
  
    <h3><span class="blue-vertical-line">|</span> <?=$entity["name"]?></h3>  
    
    <? if (! empty($entity["video"])) { ?>  
      <div id="course-video-thumbnail">
        <iframe width="100%" height="220" 
          src="https://www.youtube.com/embed/<?=$entity["video"]?>?controls=0" 
          frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
      </div>
    <? } ?>
    
    <!--iframe class="un-icons" src="https://www.youtube-nocookie.com/embed/<?=$entity["video"]?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe-->
    <!--
    <div id="entity-video" class="video" data-vars='{ "id" : "<?=$entity["video"]?>", "rel": 0, "showinfo": 0, "ecver": 2, "modestbranding" : 1 }'></div>
    <script>
    3window.onload = function() { asideVideoPlayer("entity-video"); };
    </script>
    -->
    
    <ul class="course-related-links">
        <li id="explore-all-courses" class="course-details right-arrow"><a href="/<?=get_option("nau_slug_courses_page")?>" target="_self"><?=nau_trans("Explore all courses")?></a></li>

        <?php
        echo nau_generate_custom_value_meta_html(get_custom_value("meta"), $entity);
        ?>

      <li class="share-and-start-course">
        <ul>
          <li class="share-course"><a href="" id="facebook-share-btt" rel="nofollow" target="_blank" class=""><?=nau_trans("Share")?>  </a></li>                    
        </ul>
      </li>
    
    </ul>
  </aside>
  <!-- ends aside course info -->  
