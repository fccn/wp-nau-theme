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
  
  $banner_image = $course["image"];
  if ($url != "") {
    $banner_image = $url;   
  }
  
  $entity = $course["entity"];
  $link = $item["course"];
  
  get_header(); 
?>

<!-- starts Homepage grey menu opacity overlay when user click on menu button -->
<div id="menu-overlay"></div>
<!-- ends Homepage grey menu opacity overlay when user click on menu button --> 

<style>
body#secondary div#home-slider {
    background: url("<?=$banner_image?>");
    object-fit: cover;
}    

div#home-slider.course .slider-mask {
  filter: hue-rotate(<?=$hue?>deg) opacity(<?=$opacity?>) grayscale(<?=$grayscale?>); 
  -webkit-filter: hue-rotate(<?=$hue?>deg) opacity(<?=$opacity?>) grayscale(<?=$grayscale?>);
}

<?php
if($color):
?>
div#home-slider #slider-objects h1 {
      color: <?=$color?>; 
}
<?php
endif;
?>

</style>

<!-- starts homepage header -->
<section id="flexible-content-area"> 
  
  <!-- starts carrousel of banners -->
  <div id="home-slider" class="course">
    <div id="slider-objects">
      <div class="entity-branding-container"><?php //this was added as a way to control the way objects are rendered in the course header ?>
        <a href="<?=$entity["url"]?>">
          <img id="secondary-course-logo" src="<?=$entity["square_logo"]?>" alt="<?=$entity["sigla"]?>" title="<?=$entity["name"]?>">
        </a>
        <h1><?=$course["name"]?></h1>
      </div>
      
      <ul class="course-quick-meta">      
        <li class="date-status-label"><?=$course["date_status_label"]?></li>
        <!-- <li class="number-of-participants"><?=$course["participants"]?> <?=nau_trans("Participants")?></li> -->
        <li class="price"><?=$course["price"]?></li> 
        <li class="enrollment-type"><?=$course["invitation_mode_label"]?></li>
        <li class="course-type"><?=$course["pace_mode_label"]?></li>
      </ul>
        
      <!-- starts video and know more icons, rating and certficate status -->
      <?php
      /* 
      * DEPRECATED
      *
      <div class="video-know-more-icons">        
        
        <? if (! empty($course["youtube"])) { ?>  
          <!-- starts video icon -->
          <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$course["youtube"]?>" }' title="<?=nau_trans("See video")?>">
            <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white.svg">
          </a> 
        <? } ?>
        <!-- starts know more icon, rating and certficate status -->         
        <?php          
          print (do_shortcode('[edunext_enroll_button course_id="' . $course["course-id"] . '"]'));
        ?>        
        <!-- ends video and know more icons --> 
      </div>
      */
      ?>
    </div>
    <img src="assets/img/banner-shape-long-blue.svg" class="slider-mask">

    <?if (($course["un-sustentability"] != 0) && false) { /* UN Feature Disabled! */ ?> 
      <a href="/nacoes-unidas/#<?=$course["un-sustentability"]?>">
        <div id="un-icon" class="over-banner sustainability-onu-badge sustainability-onu-color-<?=$course["un-sustentability"]?>"> 
           <img class="un-icons" src="assets/img/sustainability-onu-<?=$course["un-sustentability"]?>.svg" alt="">
        </div>
      </a>
    <? } ?>
  </div>
  <!-- ends carrousel of banners --> 

</section>


<?php 
/*
if (current_user_can('edit_posts')) { ?>
   <div class="nau_management">
     <? if ($course["confluence_url"] != "") { ?>
       <a href="<?=$course["confluence_url"]?>"><span class="material-icons">info</span></a>
     <? } ?>
   </div>
<? } ?>
*/?>
   
<!-- starts homepage body content -->
<div id="body-content">  
 
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

    <!-- starts course enrolment button -->
    <?php          
      print (do_shortcode('[edunext_enroll_button course_id="' . $course["course-id"] . '"]'));
    ?>
    <!-- ends course enrolment button -->

  </article>
  <!-- ends article --> 


  <!-- starts aside course info -->
  <aside>        
    <?php /*<h3><span class="blue-vertical-line">| </span><?=$course["name"]?></h3>*/ ?>
    <!---
    <ul>
      <li class="price-and-certificate-options"><span class="aside-course-price"><?=$course["price"]?></span><? certificate($course); ?></li>
    </ul>
    <ul class="aside-course-quick-meta">
      <li class="date-status-label"><?=$course["date_status_label"]?></li>
      <li class="number-of-participants"><?=$course["participants"]?> <?=nau_trans("Participants")?></li>        
      <li class="price"><?=$course["price"]?></li> 
      <li class="enrollment-type"><?=$course["invitation_mode_label"]?></li>
      <li class="course-type"><?=$course["pace_mode_label"]?></li>
    </ul>
    --->

        
    
    
  <!--  
  <h3><span class="blue-vertical-line">| </span><?=nau_trans("Tags")?></h3>
  <span class="tags">
  <?=nau_list_tags(null, True)?>
  </span>
  -->

    <? if (! empty($course["youtube"])) { ?>  
      <div id="course-video-thumbnail">
        <iframe width="100%" height="220"
          src="https://www.youtube.com/embed/<?=$course["youtube"]?>"
          frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>        
        </iframe>
      </div>    
    <? } ?>

    <ul class="course-related-links">
        <?php
        echo nau_generate_custom_value_meta_html(get_custom_value("meta"), $course);
        ?>

      <li class="share-and-start-course">
          <ul>              
              <li class="share-course"><a href="" id="facebook-share-btt" rel="nofollow" target="_blank" class=""><?=nau_trans("Share")?>  </a></li>
              <li class="start-course">
              <!-- HAS TO BE REMOVED -->  
              <div class="ednx-enroll-button-js" style="" data-course-id="course-v1:INA+RGPD-CA+2019_T2" data-settings="EdnxEnrollButton4"><div class="nau_button"><a class="" href="https://lms.nau.edu.pt/register?course_id=course-v1:INA+RGPD-CA+2019_T2&amp;enrollment_action=enroll">Inscrever</a></div></div>
                <!--<?php nau_enroll_button($course); ?>-->
              </li>
          </ul>
      </li>
    </ul>
  </aside>
  <!-- ends aside course info --> 
</div>  
<!-- ends homepage body content --> 

<?php
  get_template_part( "global", "footer" );
?>

<!-- starts homepage footer -->
<?php get_footer(); ?>

