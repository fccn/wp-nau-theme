<?php 
  global $courses;

  // it only renders the container if there are courses available in the filter
  if ($courses):
?>
  
<div class="card-container <?php echo $args['section_container'] ?? ''; ?>">
    <?php
      foreach ($courses as $coursePage):
        $course = load_course($coursePage);
    ?>
    <article class="card">
      <a href="<?php echo $course["course_about_url"]?>">
        <div class="card-header" style="background-image: url(<?php echo $course["image_card"]?>);"></div>
        <div class="card-content">
          <div class="card-content--entity">
            <span style="background-image: url(<?php echo $course["entity"]["square_logo"]?>);" class="entity-logo"></span>
            <span class="card-content--price"><?php echo $course["price"]?></span>
          </div>
          <div class="card-content--title"><?php echo $course["name"]?></div>
          <div class="card-content--details">
            <span class="card-content--availability"><?php echo isset($course["date_status_label"])? $course["date_status_label"] : nau_trans("Unavailable"); ?></span>
            <span class="card-content--enrolled" 
              title="<?php echo sprintf(nau_trans("%s enrolled on %s course runs, current with %s enrolled."), $course["participants_all_course_runs"], $course["nau_lms_course_runs_count"], $course["participants_current_course_run"] )?>">
              <?php echo $course["participants_all_course_runs"]?> <?php echo nau_trans("Participants")?>
            </span>
          </div>
        </div>
        <div class="card-actions">
          <span href="<?php echo $course["course_about_url"]?>" title="<?php echo nau_trans("Learn more about this course")?> <?php echo $course["name"]?>" class="btn-know-more">
            <?php echo nau_trans("View course")?>
          </span>
        </div>
      </a>
    </article>
    
    <?php endforeach; ?>
</div>

<?php else: ?>
  <p><?php echo nau_trans('No courses available at the moment.'); ?></p>
<?php endif; ?>