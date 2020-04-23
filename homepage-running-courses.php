  <?php
    global $course_list_title;
    global $courses;
    
    $title = explode("|", $course_list_title);
    
    $all_courses_url = get_field("all-courses");
    
  ?>   
  
<!-- starts rolling courses -->
<section id="rolling-courses">
    <h2 class="explore-all-courses"><?=__("Running Courses")?><span class="heading-blue-bar">|</span><a href="<?=$all_courses_url?>" title="Explorar todos os cursos"><span class="normal-font-weight explore-all-courses-font"><?=__("Explore all courses")?></span></a></h2>
    <!-- starts curso a decorrer #1 -->
    <div class="courses-wrap">
    
    <? foreach ($courses as $coursePage) { 
     
         $course = load_course($coursePage);
    ?>
    
    <ul id="rolling-course-b" class="rolling-courses-card card" style="background-color: <?=$course["card-color"]?>">
      <li>
        <h3><?=$course["name"]?><br>
          <span class="aside-institution"><a href="<?=$course["entity_url"]?>" class="banner-entity" title="Know more about this entity"><?=$course["sigla"]?></a></span></h3>
        <p class="course-level"><span><?=$course["price"]?> </span> | <?=__("Certificate")?></p>
        <p><?=$course["meta"]?></p>
        <!--
        <div class="aside-rating-star">
          <?=stars($course["stars"])?>
        </div>  
        -->
      </li>
      <li>
        <? if ($course["video"]) { ?>
        <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$course["video"]?>" }' title="<?=__("See video")?>">
          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white-outline.svg" alt="Course presentation video button"> 
          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-blue.svg" alt="Course presentation video button"> 
        </a>
        <? } ?>
        <a class="know-more-icon" href="<?=$course["course_about_url"]?>" title="<?=__("know more about this course")?>"><?=__("+Info")?></a> 
        <?php          
          print (do_shortcode('[edunext_enroll_button course_id="' . $course["course-id"] . '"]'));
        ?>
    </ul>
    <?php } ?>
    
    </div>
  </section>