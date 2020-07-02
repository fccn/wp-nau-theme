  <?php
    global $course_list_title;
    global $courses;

    if (count($courses) == 0) {        
        return;
    }
    
    $title = explode("|", $course_list_title);
    
  ?>   
  
  <!-- starts highlighted courses -->
  <section id="highlighted-courses" class="main-gallery">   
   <h2><?=$title[0]?> <span class="normal-font-weight"><?=$title[1]?></span></h2>       
    <div class="courses-wrap">    
    
    <? foreach ($courses as $coursePage) { 
          
      $course = load_course($coursePage);
    
    ?>
      <div class="card gallery-cell <?=$course["card_width"]?>-card-width">
        <div class="card-image"> 
          <a href="<?=$course["course_about_url"]?>" class="image">
            <img class="course-image <?=$course["card_image_fit"]?>" src="<?=$course["image"]?>" alt="<?=$course["name"]?>">
          </a>
          <a href="<?=$course["entity"]["url"]?>" title="<?=$entity->post_title?>" class="logo">
            <img class="square-logo" src="<?=$course["entity"]["square_logo"]?>" alt="<?=$entity->post_title?>">
          </a>
        </div>
        <div class="card-content">
          <h3><?=$course["name"]?><br>
            <span class="aside-institution"><a href="<?=$course["entity_url"]?>" class="banner-entity"><?=$course["sigla"]?></a></span>
          </h3>
          <div class="certificate float-right">
            <span><?=$course["price"]?> | <?=nau_trans("Certificate")?>
              <div class="certificate-badge <?=$course["certificate_type"]?>"></div>
            </span>
          </div>
          <div class="date-status-label float-left"><?=$course["date_status_label"]?></div>
          <div class="date-status-date float-left"><?=$course["date_status_date"]?></div>
          <div class="end-date float-right"><?=$course["end_date"]?></div>
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
          <a class="know-more-icon" href="<?=$course["course_about_url"]?>" title="<?=nau_trans("Learn more about this course")?>"><?=nau_trans("+Info")?></a> 
          <?php nau_enroll_button($course); ?>
        </div>
      </div>
      
    <? } ?>
    
    </div>
  </section>    
  