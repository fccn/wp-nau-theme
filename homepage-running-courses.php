  <?php
    global $course_list_title;
    global $courses;
    
    $title = explode("|", $course_list_title);
    
    $all_courses_url = get_field("all-courses");
    
  ?>   
  
<!-- starts rolling courses -->
<section id="rolling-courses">
    <h2 class="explore-all-courses"><?=nau_trans("Running Courses")?><span class="heading-blue-bar">|</span><a href="<?=$all_courses_url?>" title="Explorar todos os cursos"><span class="normal-font-weight explore-all-courses-font"><?=nau_trans("Explore all courses")?></span><span class="explore-other-courses"></a></h2>
    <!-- starts curso a decorrer #1 -->
    <div class="courses-wrap">
    
    <? foreach ($courses as $coursePage) { 
     
         $course = load_course($coursePage);
    ?>
    
    <div class="rolling-courses-card card <?=$course["card_width"]?>-card-width" style="background-color: <?=$course["card-color"]?>">
      <div class="card-content">
        <h3><?=$course["name"]?><br>
          <span><a href="<?=$course["entity_url"]?>" class="banner-entity" title="<?=nau_trans("Know more about this entity")?>"><?=$course["sigla"]?></a></span>
        </h3>
        <div class="certificate float-right"><span><?=$course["price"]?> </span> | <?=nau_trans("Certificate")?></div>
      </div>
      <div class="course-actions">
        <? if ($course["video"]) { ?>
        <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$course["video"]?>" }' title="<?=nau_trans("See video")?>">
          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white-outline.svg" alt="Course presentation video button"> 
          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-blue.svg" alt="Course presentation video button"> 
        </a>
        <? } ?>
        <a class="know-more-icon" href="<?=$course["course_about_url"]?>" title="<?=nau_trans("know more about this course")?>"><?=nau_trans("View course")?></a> 
      </div>
    </div>
    <?php } ?>
    
    </div>
  </section>