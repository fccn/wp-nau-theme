  <?php
    global $course_list_title;
    global $courses;
    
    $title = explode("|", $course_list_title);
    
    $all_courses_url = get_field("all-courses");
    
  ?>   
  
<!-- starts rolling courses -->
<section id="rolling-courses">
    <h2 class="explore-all-courses"><?php echo nau_trans("Running Courses")?><span class="heading-blue-bar">|</span><a href="<?php echo $all_courses_url?>" title="Explorar todos os cursos"><span class="normal-font-weight explore-all-courses-font"><?php echo nau_trans("Explore all courses")?></span><span class="explore-other-courses"></a></h2>
    <!-- starts curso a decorrer #1 -->
    <div class="courses-wrap">
    
    <? foreach ($courses as $coursePage):
     
         $course = load_course($coursePage);
    ?>

    <div class="rolling-courses-card card <?php echo $course["card_width"]?>-card-width" style="background-color: <?php echo $course["card-color"]?>">
      <div class="card-content">
        <h3><?php echo $course["name"]?><br>
          <span><a href="<?php echo $course["entity_url"]?>" class="banner-entity" title="<?php echo nau_trans("Know more about this entity")?>"><?php echo $course["sigla"]?></a></span>
        </h3>
        <div class="certificate float-right"><span><?php echo $course["price"]?> </span> | <?php echo nau_trans("Certificate")?></div>
      </div>
      <div class="course-actions">
        <? if ($course["video"]): ?>
        <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?php echo $course["video"]?>" }' title="<?php echo nau_trans("See video")?>">
          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white-outline.svg" alt="Course presentation video button"> 
          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-blue.svg" alt="Course presentation video button"> 
        </a>
        <? endif; ?>
        <a class="know-more-icon" href="<?php echo $course["course_about_url"]?>" title="<?php echo nau_trans("know more about this course")?>"><?php echo nau_trans("View course")?></a> 
      </div>
    </div>
        <?php endforeach; ?>
    
    </div>
  </section>