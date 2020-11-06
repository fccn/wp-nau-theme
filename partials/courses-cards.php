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
      <?php echo $title[0]?> <span class="normal-font-weight"><?php echo $title[1]?></span>
      <span class="heading-blue-bar">|</span>
      <a href="<?php echo $all_courses_url?>" title="Explorar todos os cursos">
        <span class="normal-font-weight explore-all-courses-font"><?php echo nau_trans("Explore all courses")?></span>
        <span class="explore-other-courses">
      </a>
    </h2>

    <div class="card-container">   <?php /* courses-wrap */ ?> 
    
    <?php foreach ($courses as $coursePage):
          
      $course = load_course($coursePage);
    
    ?>
      <div class="card gallery-cell <?php echo $course["card_width"]?>-card-width">
        <a href="<?php echo $course["course_about_url"]?>">
          <div class="card-image"> 
            <img class="course-image <?php echo $course["card_image_fit"]?>" src="<?php echo $course["image"]?>" alt="<?php echo $course["name"]?>">
            <img class="square-logo" src="<?php echo $course["entity"]["square_logo"]?>" alt="<?php echo $entity->post_title?>">
          </div>
          <div class="card-content">
            <h3><?php echo $course["name"]?><br>
              <span class="aside-institution"><?php echo $course["sigla"]?></span>
            </h3>
            <div class="certificate float-right">
              <span><?php echo $course["price"]?></span>
              <div class="certificate-badge <?php echo $course["certificate_type"]?>"></div>            
            </div>
            <div class="date-status-label float-left <?php echo $course["date_status_class"]?>"><?php echo $course["date_status_label"]?></div>
            <div class="pace-mode float-right"><?php echo $course["self_paced_label"]?></div>
            <div class="invitation-mode float-right"><?php echo $course["invitation_only_label"]?></div>
            <div class="number-of-participants float-right"><?php echo $course["participants"]?> <?php echo nau_trans("Participants")?></div>
          </div>
          <div class="course-actions"> 
            <?php if ($course["video"]): ?>
            <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?php echo $course["video"]?>" }' title="<?php echo nau_trans("See video")?>">
              <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white.svg" alt="<?php echo nau_trans("See a video about this course")?>">           
            </a>
            <?php endif; ?>
            <a class="know-more-icon" href="<?php echo $course["course_about_url"]?>" title="<?php echo nau_trans("Learn more about this course")?> <?php echo $course["name"]?>"><?php echo nau_trans("View course")?></a> 
          </div>
        </a>
      </div>
      
            <?php endforeach; ?>
    
    </div>
  </section>    
  
<!--
  <div class="card-container">
        <article class="card">
            <div class="card-header" style="background-image: url(https://via.placeholder.com/280x200);"></div>
            <div class="card-content">
                <div class="card-content--entity">
                    <img src="https://via.placeholder.com/80" alt="" class="entity-logo">
                    <span class="card-content--price">Gratuito</span>
                </div>
                <h2 class="card-content--title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a condimentum lectus, vel elementum velit.</h2>
                <div class="card-content--details">
                    <span class="card-content--availability">Disponível</span>
                    <span class="card-content--enrolled">2450 participantes</span>
                </div>
            </div>
            <div class="card-actions">
                <a href="#" class="btn-know-more">Inscrever</a>
            </div>
        </article>
    </div>
    -->