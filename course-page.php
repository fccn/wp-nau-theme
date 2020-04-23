<?php /* Template Name: Course About Page */ ?>
<?php 
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  
  $course = load_course($post);
  
  $entity = $course["entity"];
    
  $link = $item["course"];
  $opacity = $item["opacity"];
  $hue_rotate = $item["hue"];
  $back_color = $item["back-color"];
  
  get_header(); 
?>

<!-- starts Homepage grey menu opacity overlay when user click on menu button -->
<div id="menu-overlay"></div>
<!-- ends Homepage grey menu opacity overlay when user click on menu button --> 

<style>
body#secondary div#home-slider {
    background: url("<?=$course["image"]?>");
    object-fit: cover;    
}    

div#home-slider.course .slider-mask {
  filter: hue-rotate(<?=$hue?>deg) opacity(1) grayscale(<?=$opacity?>); 
  -webkit-filter: grayscale(<?=$opacity?>) opacity(0.8) hue-rotate(<?=$hue?>deg);
}

div#home-slider #slider-objects h1 {
      color: <?=$color?>; 
}

</style>

<!-- starts homepage header -->
<section id="flexible-content-area"> 
  
  <!-- starts carrousel of banners -->
  <div id="home-slider" class="course">    
    <div id="slider-objects">
      <a href="<?=$entity["url"]?>">
        <img id="secondary-course-logo" src="<?=$entity["square_logo"]?>" alt="<?=$entity["sigla"]?>">
      </a>
      <h1><?=$course["name"]?></h1>
      <div id="course-id"><?=$course["course-id"]?></div>
      <!-- starts video and know more icons, rating and certficate status -->
      <div class="video-know-more-icons">
        <a href="<?=$entity["url"]?>" class="banner-entity" title="Know more about this entity"><?=$entity["sigla"]?></a><br>      
        <!--<?=stars($course["stars"])?>-->
        <span id="number-of-participants"><?=$course["participants"]?> <?=__("Participants")?></span>
        
        <ul class="aside-course-status">
          <li id="course-status" class="aside-course-state"><span>Aberto</span> em perman&ecirc;ncia</li>
          <li class="price-and-certificate-options"><span class="aside-course-price"><?=$course["cost"]?></span> | <span class="aside-certificate-options">Certificado</span></li>
        </ul>
        <!-- starts video icon -->         
        <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$course["youtube"]?>" }' title="<?=__("See video")?>">
          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white.svg">
        </a> 
        <!-- starts know more icon, rating and certficate status -->         
        <?php          
          print (do_shortcode('[edunext_enroll_button course_id="' . $course["course-id"] . '"]'));
        ?>        
        <!-- ends video and know more icons --> 
      </div>
    </div>
    <img src="assets/img/banner-shape-long-blue.svg" class="slider-mask">
  </div>
  <!-- ends carrousel of banners --> 
</section>
<!-- starts homepage body content -->
<div id="body-content"> 
  
  <!-- starts article -->
  <article>    
    <?php
    
        // Start the loop.
        while ( have_posts() ) : the_post();
 
            // Include the page content template.            
            echo do_shortcode(get_post_field('post_content'));
 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
 
            // End of the loop.
        endwhile;
        
        ?>

  </article>
  <!-- ends article --> 
  
  <!-- starts aside course info -->
  <aside>
    <h3><span class="blue-vertical-line">| </span><?=$course["name"]?></h3>
    <ul class="aside-price-and-certificate-options">
      <li class="aside-institution"><a href="<?=$entity["url"]?>" class="banner-entity" title="Know more about this entity"><?=$entity["sigla"]?></a></li>
      <li class="price-and-certificate-options"><span class="aside-course-price"><?=$course["cost"]?></span> | <span class="aside-certificate-options">Certificado</span></li>
    </ul>
    <!--<?=stars($course["stars"])?>-->
    <span id="number-of-participants"><?=$course["participants"]?> <?=__("Participants")?></span>
    <span id="course-status" class="aside-course-state"><span>Aberto</span> em perman&ecirc;ncia</span>
        
    <?if ($course["un-sustentability"] != 0) { ?>
      <img class="un-icons" src="assets/img/sustainability-onu-<?=$course["un-sustentability"]?>.svg" alt="">
    <? } ?>
    
    <iframe class="un-icons" src="https://www.youtube-nocookie.com/embed/<?=$course["youtube"]?>"  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


    <ul class="course-related-links">

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

    
      <li id="course-code" class="course-details"><a href="#" target="_self">C&oacute;digo do curso<span class="aside-course-details">URM 101</span></a></li>
      <li id="starting-date" class="course-details"><a href="#" target="_self">In&iacute;cio do curso <span class="aside-course-details">22.01.2020</span></a></li>
      <li id="estimated-effort" class="course-details"><a href="#" target="_self">Esfor&ccedil;o estimado<span class="aside-course-details">3 horas</span></a></li>
      <li id="explore-courses" class="course-details right-arrow"><a href="#" target="_self">Cursos relacionados</a></li>
      <li id="explore-all-courses" class="course-details right-arrow"><a href="#" target="_self">Explorar todos os cursos</a></li>
      <li id="contact-email" class="course-details right-arrow"><a href="#" target="_self">E-mail</a></li>
      <li id="contact-website" class="course-details right-arrow"><a href="#" target="_self">Website</a></li>
      <li id="contact-telephone" class="course-details right-arrow"><a href="tel:+3512145678978" target="_self">+351 21 456 789 78</a></li>
      <li class="share-and-start-course">
          <ul>
              <li class="share-course"><a href="#">Partilhar</a></li>
              <li class="start-course"><a href="#" class="know-more-icon">Iniciar</a></li>
          </ul>
      </li>
    </ul>
  </aside>
  <!-- ends aside course info --> 
</div>  
<!-- ends homepage body content --> 

<?php
  get_template_part( "global", "footer" );
?>

<!-- starts homepage footer -->
<?php get_footer(); ?>
