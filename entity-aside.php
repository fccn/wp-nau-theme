<?

?>
  <!-- starts aside course info -->
  <aside>
  
    <h3><span class="blue-vertical-line">|</span> <?=$entity["name"]?></h3>  
    <ul class="aside-price-and-certificate-options">
      <li class="top-aside-institution"><a href="<?=$entity["url"]?>"><?=$entity["sigla"]?></a></li>      
    </ul>
    
    <div id="course-video-thumbnail">
    
      <iframe width="100%" height="220" 
        src="https://www.youtube.com/embed/<?=$entity["video"]?>?controls=0" 
        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
      </iframe>
    </div>
    
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
        
        $li_html = '';
        
        $linhas = explode("\n", get_custom_value("meta"));
        foreach ($linhas  as $linha ) {        
          if ($linha <> "") {

            list($id, $label, $action) = explode("|", $linha);
            
            $cnt = preg_match("/{([a-z_A-Z0-9]*)}/", $label, $matches);
            
            if ($cnt == 1) {
                
                # Tries course already loaded data
                $v = $course[$matches[1]];
                if (!$v) {
                    # No data prepared, try post field
                    $v = get_field($matches[1], $post->ID);
                }
                
                $label = str_replace("{" . $matches[1] . "}", $v, $label);
            }

            if (substr($id, 0, 10) == "materials-") {
                $icon = substr($id, 10);                
                if ($action == "")
                  $li_html .= "<li id='$id' class='course-details right-arrow x-material-icons'><i class='material-icons aside-icons'>$icon</i>$label</li>";
                else
                  $li_html .= "<li id='$id' class='course-details right-arrow x-material-icons'><a href='$action' target='_self'><i class='material-icons aside-icons'>$icon</i>$label</a></li>";
            } else {
                if ($id == "contact-telephone") {
                    if ($action == "") $action = $label;
                    $li_html .= "<li id='$id' class='$id course-details right-arrow'><a href='tel:$action' target='_self'>$label</a></li>";
                } else 
                if ($id =="contact-email") {
                    if ($action == "") $action = $label;
                    $li_html .= "<li id='$id' class='$id course-details right-arrow'><a href='mailto:$action' target='_self'>$label</a></li>";
                } else 
                if ($id == "contact-website") {
                    if ($action == "") $action = $label;
                    $li_html .= "<li id='$id' class='$id course-details right-arrow'><a class='no-capitalize' href='$action' target='_blank'>$label</a></li>";
                } else {
                    if ($action != "") {
                      $li_html .= "<li c class='$id course-details right-arrow'><a href='$action' target='_blank'>$label</a></li>";
                    } else {
                      $li_html .= "<li id='$id' class='$id course-details right-arrow'>$label</li>";
                    }
                }
            }
          }
        }
        
        echo $li_html;        
            
        ?>

      <li class="share-and-start-course">
        <ul>
          <li class="share-course"><a href="" id="facebook-share-btt" rel="nofollow" target="_blank" class=""><?=nau_trans("Share")?>  </a></li>                    
        </ul>
      </li>
    
    </ul>
  </aside>
  <!-- ends aside course info -->  
