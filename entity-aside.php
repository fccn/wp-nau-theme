  <!-- starts aside course info -->
  <aside>
  
    <h3><span class="blue-vertical-line">|</span> <?= get_post_field('post_title') ?></h3>  
    <ul class="aside-price-and-certificate-options">
      <li class="aside-institution"><a class="banner-entity" href="<?=get_custom_value("website")?>" target="_new"><?=get_custom_value("sigla")?></a></li>
    </ul>
    
    <iframe class="un-icons" src="https://www.youtube-nocookie.com/embed/<?=get_custom_value("youtube")?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
    
    <ul class="course-related-links">
        <li id="explore-all-courses" class="course-details right-arrow"><a href="#" target="_self">Explorar todos os cursos</a></li>

        <?php
        
        $li_html = '';
        
        $linhas = explode("\n", get_custom_value("meta"));
        foreach ($linhas  as $linha ) {        
          if ($linha <> "") {
            list($id, $label, $action) = explode("|", $linha);
            
            if ($id == "contact-telephone") {
                $li_html .= "<li id='$id' class='course-details right-arrow'><a href='tel:$action' target='_self'>$label</a></li>";
            } else 
            if ($id =="contact-email") {
                $li_html .= "<li id='$id' class='course-details right-arrow'><a href='mailto:$action' target='_self'>$label</a></li>";
            } else 
            if ($id == "contact-website") {
                $li_html .= "<li c class='course-details right-arrow'><a href='$action' target='_blank'>$label</a></li>";
            } else {
                if ($action != "") {
                  $li_html .= "<li c class='course-details right-arrow'><a href='$action' target='_blank'>$label</a></li>";
                } else {
                  $li_html .= "<li id='$id' class='course-details right-arrow'>$label</li>";
                }
            }
          }
        }
        
        echo $li_html;        
            
        ?>

      <li class="share-and-start-course">
        <ul>
          <li class="share-course"><a href="" id="facebook-share-btt" rel="nofollow" target="_blank" class=""><?=_("Share")?>  </a></li>                    
        </ul>
      </li>
    
    </ul>
  </aside>
  <!-- ends aside course info -->  
