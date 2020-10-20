  <?php
    global $course_list_title;
    global $courses;

    if (count($courses) == 0) {        
        return;
    }
    
    $title = explode("|", $course_list_title);
    $all_courses_url = get_field("all-courses");
    
  ?>   
  
  <!-- starts highlighted courses -->
  <section id="highlighted-courses" class="main-gallery">   
    <h2>
      <?=$title[0]?> <span class="normal-font-weight"><?=$title[1]?></span>
      <span class="heading-blue-bar">|</span>
      <a href="<?=$all_courses_url?>" title="Explorar todos os cursos">
        <span class="normal-font-weight explore-all-courses-font"><?=nau_trans("Explore all courses")?></span>
        <span class="explore-other-courses">
      </a>
    </h2>

    <div class="courses-wrap">    
    
    <? foreach ($courses as $coursePage) { 
          
      $course = load_course($coursePage);
    
    ?>
      <div class="card gallery-cell <?=$course["card_width"]?>-card-width">
        <div class="card-image"> 
          <a href="<?=$course["course_about_url"]?>">
            <img class="course-image <?=$course["card_image_fit"]?>" src="<?=$course["image"]?>" alt="<?=$course["name"]?>">
          </a>
          <img class="square-logo" src="<?=$course["entity"]["square_logo"]?>" alt="<?=$entity->post_title?>">
        </div>
        <div class="card-content">
          <h3><?=$course["name"]?><br>
            <span class="aside-institution"><a href="<?=$course["entity_url"]?>" class="banner-entity"><?=$course["sigla"]?></a></span>
          </h3>
          <div class="certificate float-right">
            <span><?=$course["price"]?></span>
            <div class="certificate-badge <?=$course["certificate_type"]?>"></div>            
          </div>
          <div class="date-status-label float-left <?=$course["date_status_class"]?>"><?=$course["date_status_label"]?></div>
          <div class="pace-mode float-right"><?=$course["self_paced_label"]?></div>
          <div class="invitation-mode float-right"><?=$course["invitation_only_label"]?></div>
          <div class="number-of-participants float-right"><?=$course["participants"]?> <?=nau_trans("Participants")?></div>
        </div>
        <div class="course-actions"> 
          <? if ($course["video"]) { ?>
          <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$course["video"]?>" }' title="<?=nau_trans("See video")?>">
            <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white.svg" alt="<?=nau_trans("See a video about this course")?>">           
          </a>
          <? } ?>
          <a class="know-more-icon" href="<?=$course["course_about_url"]?>" title="<?=nau_trans("Learn more about this course")?>"><?=nau_trans("View course")?></a> 
        </div>
      </div>
      
    <? } ?>
    
    </div>
  </section>    
  