  <?php
    $all_courses_url = get_field("all-courses");
  ?> 

<section id="homepage-all-courses-section">
	<a class="homepage-all-courses-link" href="<?php echo $all_courses_url?>" title="Explorar todos os cursos">
	  <span class="normal-font-weight explore-all-courses-font"><?php echo nau_trans("Explore all courses")?></span>
	  <span class="explore-other-courses"></span>
	</a>
</section>
