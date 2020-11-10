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
    </h2>

    <div class="card-entity-container">   <?php /* courses-wrap */ ?> 
    
    <?php foreach ($courses as $coursePage):
          
      $course = load_course($coursePage);
    
    ?>

    <article class="card">
      <a href="<?php echo $course["course_about_url"]?>">
            <div class="card-header" style="background-image: url(<?php echo $course["image"]?>);"></div>
            <div class="card-content">
                <div class="card-content--entity">
                    <span style="background-image: url(<?php echo $course["entity"]["square_logo"]?>);" class="entity-logo"></span>
                    <span class="card-content--price"><?php echo $course["price"]?></span>
                </div>
                <h3 class="card-content--title"><?php echo $course["name"]?></h3>
                <div class="card-content--details">
                    <span class="card-content--availability"><?php echo $course["date_status_label"]?></span>
                    <span class="card-content--enrolled"><?php echo $course["participants"]?> <?php echo nau_trans("Participants")?></span>
                </div>
            </div>
            <div class="card-actions">
              <a href="<?php echo $course["course_about_url"]?>" title="<?php echo nau_trans("Learn more about this course")?> <?php echo $course["name"]?>" class="btn-know-more">
                <?php echo nau_trans("View course")?>
              </a>
            </div>
          </a>
        </article>


            <?php endforeach; ?>
    
    </div>
  </section>