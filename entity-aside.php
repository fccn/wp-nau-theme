  <!-- starts aside course info -->
  <aside>
  
    <h3>| <?= get_post_field('post_title', $post->ID) ?></h3>  
    <a href="<?=get_post_custom_values("website")[0]?>" target="_new"><?=get_post_custom_values("sigla")[0]?></a>
    <img src="assets/img/aside-placeholder-image.png" alt="some alternative text here">   
    
    <ul class='course-related-links'>
    <?php
    
    $li_html = '';
    foreach ( get_post_custom_values("meta") as $value ) {        
        list($id, $label, $action) = explode("|", $value);
        
        if ($id == "telephone-info") {
            $li_html .= "<li id='telephone-info' class='course-details right-arrow'><a href='tel:$action' target='_self'>$label</a></li>";
        } else 
        if ($id == "website-email") {
            $li_html .= "<li id='$id' class='course-details right-arrow'><a href='mailto:$action' target='_self'>$label</a></li>";
        } else 
        if ($id == "website") {
            $li_html .= "<li id='$id' class='course-detailsw'><a href='$action' target='_blank'>$label</a></li>";
        } else {
            $li_html .= "<li>$id - $label - $action</li>";
        }
    }
    
    echo $li_html;        
        
    ?>

        <li id="related-courses" class="course-details">Cursos Relacionados</li>
        <li id="explore-all-courses" class="course-details">Explorar todos os cursos</li>
        <li id="email-info" class="course-details">Email</li>
        <li id="website-email" class="course-details">Website</li>
        <li id="telephone-info" class="course-details">Telephone: <?=get_post_custom_values("phone")[0] ?></li> 
    </ul>
  </aside>
  <!-- ends aside course info -->  
