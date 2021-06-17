<?php 
/* 
Template Name: Course About Page 
*/

  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages course'";
    
  $course = load_course($post);

  /* Final Fallback! */
  if (($course["catalog_visibility"]=="none") && (!current_user_can('administrator'))) {
    $new_page = get_option('nau_slug_courses_page');
    header('Location: /' . $new_page);
  }
  
  [$color, $opacity, $hue, $grayscale, $url, $header] = get_page_fields();  
  
  $banner_image = $course["image"] ?? NULL;
  if ($url != "") {
    $banner_image = $url;   
  }
  
  $entity = $course["entity"];
  //$link = $item["course"];
  
  get_header(); 
?>

<!-- starts homepage header -->
<section id="course-<?php echo get_the_ID(); ?>" class="course-detail">

    <header class="course-detail-header">
      <div class="course-detail-meta">
        <div class="course-detail-entity">
          <a href="<?php echo $entity["url"]?>">
            <img src="<?php echo $entity["square_logo"]?>" alt="<?php echo $entity["sigla"]?>" title="<?php echo $entity["name"]?>" width="120" height="120">
          </a>
        </div>

        <h1><?php echo $course["name"]?></h1>
        <p class="course-detail-meta-excerpt"><?php echo get_the_excerpt(); ?></p>
        <p>
          <span title="<?php echo sprintf(nau_trans("%s enrolled on %s course runs, current with %s enrolled."), $course["participants_all_course_runs"], $course["nau_lms_course_runs_count"], $course["participants_current_course_run"] )?>">
            <?php echo $course["participants_all_course_runs"]?> <?php echo nau_trans("already enrolled")?>
          </span> | <?php echo $course["date_status_label"]?>
        </p>
        <div class="course-detail-enroll">
          <!-- starts course enrolment button -->
          <?php nau_enroll_button($course); ?>
          <!-- ends course enrolment button -->
          
        </div>
      </div>

      <div class="course-detail-entity-meta">
        <div class="course-detail-image" style="background-image: url(<?php echo $banner_image; ?>);"></div>
      </div>
        
    </header>

</section>
   
<!-- starts homepage body content -->
<main id="body-content">  
 
  <!-- starts aside course info -->
  <aside>
    <div class="aside-course-details"> 
    <?php /*<h3><span class="blue-vertical-line">| </span><?php echo $course["name"]?></h3>*/ ?>
    <!---
    <ul>
      <li class="price-and-certificate-options"><span class="aside-course-price"><?php echo $course["price"]?></span><? certificate($course); ?></li>
    </ul>
    <ul class="aside-course-quick-meta">
      <li class="date-status-label"><?php echo $course["date_status_label"]?></li>
      <li class="number-of-participants"><?php echo $course["participants"]?> <?php echo nau_trans("Participants")?></li>        
      <li class="price"><?php echo $course["price"]?></li> 
      <li class="enrollment-type"><?php echo $course["invitation_mode_label"]?></li>
      <li class="course-type"><?php echo $course["pace_mode_label"]?></li>
    </ul>
    --->
  
    <!--  
    <h3><span class="blue-vertical-line">| </span><?php echo nau_trans("Tags")?></h3>
    <span class="tags">
    <?php echo nau_list_tags(null, True)?>
    </span>
    -->
  
    <?php if (! empty($course["youtube"])): ?>  
      <div id="course-video-thumbnail">
        <iframe 
          width="100%" height="200" 
          loading="lazy"
          title="<?php echo nau_trans("Course Youtube video")?>"
          src="https://www.youtube.com/embed/<?php echo $course["youtube"]?>"
          frameborder="0" 
          allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
          allowfullscreen>        
        </iframe>
      </div>    
    <? endif; ?>
  
    <ul class="course-related-links">
        <?php echo nau_generate_custom_value_meta_html(get_custom_value("meta"), $course); ?>
  
        <li class="course-details x-material-icons">
          <a id="share-button">
            <i class="material-icons aside-icons">share</i>
            <?php echo nau_trans("Share")?>
          </a>
        </li>
    </ul>
    </div>
  </aside>
  <!-- ends aside course info --> 

  <!-- starts article -->
  <article class="course-synopse">
    <?php
    
        // Start the loop.
        while ( have_posts() ) : the_post();
 
            // Include the page content template.            
            echo do_shortcode(get_post_field('post_content'));
 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
 
            // End of the loop.
        endwhile;
        
        ?>
        <div class="course-synopse-actions">
          <?php nau_enroll_button($course); ?>
        </div>
  </article>
  <!-- ends article --> 


</main>  
<!-- ends homepage body content --> 

<?php
  get_template_part( "partials/global", "footer" );
?>

<!-- starts homepage footer -->
<?php get_footer(); ?>

