  
<div class="card-container <?php echo $args['section_container'] ?? ''; ?>">
  <?php 
    global $courses;

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
            <span class="card-content--availability"><?php echo $course["date_status_label"]?></span>
            <span class="card-content--enrolled"><?php echo $course["participants"]?> <?php echo nau_trans("Participants")?></span>
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
