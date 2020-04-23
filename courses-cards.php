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
    
      <ul class="card gallery-cell">
      <li class="card-image"> 
        <a href="<?=$course["course_about_url"]?>" class="image">
          <img class="course-image" src="<?=$course["image"]?>" alt="<?=$course["name"]?>" class="course-image">
        </a>
        <a href="<?=$course["entity"]["url"]?>" title="<?=$entity->post_title?>" class="logo">
          <img class="square-logo" src="<?=$course["entity"]["square_logo"]?>" alt="<?=$entity->post_title?>">
        </a>
      </li>
      <li><span><?=$course["price"]?></span> | <?=__("Certificate")?></li>
      <li>
        <h3><?=$course["name"]?><br>
          <span class="aside-institution"><a href="<?=$course["entity_url"]?>" class="banner-entity"><?=$course["sigla"]?></a></span></h3>
        <p><?=$course["meta"]?></p>        
        <!--
        <div class="aside-rating-star">
          <?=stars($course["stars"])?>
        </div>  
        -->
        <p class="number-of-participants"><?=$course["participants"]?> <?=__("Participants")?></p>
      </li>
      <li> 
        <? if ($course["video"]) { ?>
        <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$course["video"]?>" }' title="<?=__("See video")?>">
          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white.svg" alt="<?=__("See a video about this course")?>">           
        </a>
        <? } ?>
        <a class="know-more-icon" href="<?=$course["course_about_url"]?>" title="<?=__("Learn more about this course")?>"><?=__("+Info")?></a> 
        <? /* <a class="start-course-icon" href="<?=$course["course_enroll_url"]?>" title="<?=__("Start Course")?>"><?=__("Start")?></a>  */ ?>
        <?php  
          if($course["course-id"])        
            print (do_shortcode('[edunext_enroll_button course_id="' . $course["course-id"] . '"]'));
        ?>        
        </li>
      </ul>
      
    <? } ?>
    
    </div>
  </section>    
  