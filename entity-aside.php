  <aside>
  
    <h3><span class="blue-vertical-line">|</span> <?php echo $entity["name"]?></h3>  
    
    <?php if (! empty($entity["video"])): ?>  
      <div id="course-video-thumbnail">
        <iframe width="100%" height="220" 
          src="https://www.youtube.com/embed/<?php echo $entity["video"]?>" 
          frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
      </div>
    <?php endif; ?>
    
    <ul class="course-related-links">

        <?php echo nau_generate_custom_value_meta_html(get_custom_value("meta"), $entity); ?>

        <li class="course-details x-material-icons">
        <a id="share-button">
          <i class="material-icons aside-icons">share</i>
          <?php echo nau_trans("Share")?>
        </a>
      </li>
    
    </ul>
  </aside>
  <!-- ends aside course info -->  
