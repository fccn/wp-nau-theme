<?php

/*

  $days_to_start = days_to_today(get_field("nau_lms_course_start", $coursePage->ID));
  $days_to_end = days_to_today(get_field("nau_lms_course_end", $coursePage->ID));

  $days_to_enrollment_start = empty($course["enrollment_start"]) ? null : days_to_today($course["enrollment_start"]);
  $days_to_enrollment_end =   empty($course["enrollment_end"])   ? null : days_to_today($course["enrollment_end"]);

  $course_started = strtotime(get_field("nau_lms_course_start", $coursePage->ID)) <= strtotime('now');

  if ($days_to_start >= 7) {
      $course["date_status_label"] = nau_trans("Scheduled to start");
      $course["date_status_date"] = $course["start_date"];
      $course["date_status_class"] = "date_status_scheduled_to_start";
  } else if ($days_to_start < 7 && $days_to_start >= 0 && !$course_started) {
      $course["date_status_label"] = nau_trans("About to start");
      $course["date_status_date"] = $course["start_date"];
      $course["date_status_class"] = "date_status_about_to_start";
  } else if ($days_to_start <= 0 && $days_to_end > 0 && ( is_null($days_to_enrollment_end) || $days_to_enrollment_end >= 7 ) && $course_started) {
      $course["date_status_label"] = nau_trans("Available");
      $course["date_status_date"] = $course["start_date"];
      $course["date_status_class"] = "date_status_running";
  } else if ( !is_null( $days_to_enrollment_start ) && $days_to_enrollment_end < 7 && $days_to_enrollment_end > 0 || is_null( $days_to_enrollment_start ) && $days_to_end < 7 && $days_to_end > 0) {
      $course["date_status_label"] = nau_trans("About to end");
      $course["date_status_date"] = $course["end_date"];
      $course["date_status_class"] = "date_status_about_to_end";
  } else if ($days_to_start < 0 && $days_to_end > 0 && !is_null($days_to_enrollment_end) && $days_to_enrollment_end < 7 ) {
      $course["date_status_label"] = nau_trans("Running");
      $course["date_status_date"] = $course["enrollment_end"];
      $course["date_status_class"] = "date_status_finished";
  } else if ($days_to_end < 0) {
      $course["date_status_label"] = nau_trans("Finished");
      $course["date_status_date"] = $course["end_date"];
      $course["date_status_class"] = "date_status_finished";
  }
*/

// NEW FUNCTION FOR TESTING PURPOSES

function get_courses_by_state($atts = []) { 
  global $courses;

  /* Available States
    - Available
    - Soon
    - Finished
  */
  
  $vars = shortcode_atts([
    'state' => NULL
  ], $atts);
  

  switch($vars['state']){
    case 'available':
        $courses = array_filter(nau_get_courses($atts), function($coursePage){
          $nau_lms_course_enrollment_end = get_field("nau_lms_course_enrollment_end", $coursePage->ID);
          $nau_lms_course_end = get_field("nau_lms_course_end", $coursePage->ID);
          $course_started = strtotime(get_field("nau_lms_course_start", $coursePage->ID)) <= strtotime('now');
          $date = is_null($nau_lms_course_enrollment_end) || empty($nau_lms_course_enrollment_end)  ? $nau_lms_course_end : $nau_lms_course_enrollment_end;
          $days_to_end = days_to_today ( $date );
          return $days_to_end >= 0 && $course_started;
        });
        break;
    case 'soon':
        $courses = array_filter(nau_get_courses($atts), function($coursePage){
          $nau_lms_course_enrollment_end = get_field("nau_lms_course_enrollment_end", $coursePage->ID);
          $nau_lms_course_end = get_field("nau_lms_course_end", $coursePage->ID);
          $course_started = strtotime(get_field("nau_lms_course_start", $coursePage->ID)) <= strtotime('now');
          $date = is_null($nau_lms_course_enrollment_end) || empty($nau_lms_course_enrollment_end)  ? $nau_lms_course_end : $nau_lms_course_enrollment_end;
          $days_to_end = days_to_today ( $date );
          return $days_to_end >= 0 && !$course_started;
        });
        break;
    case 'finished':
        $courses = array_filter(nau_get_courses($atts), function($coursePage){
          $nau_lms_course_enrollment_end = get_field("nau_lms_course_enrollment_end", $coursePage->ID);
          $nau_lms_course_end = get_field("nau_lms_course_end", $coursePage->ID);
          $date = is_null($nau_lms_course_enrollment_end) || empty($nau_lms_course_enrollment_end)  ? $nau_lms_course_end : $nau_lms_course_enrollment_end;
          $days_to_end = days_to_today ( $date );
          return $days_to_end < 0;
        });
        break;
    default:
        $courses = nau_get_courses($atts);
        break;
  }

  
  ob_start();
  get_template_part( "partials/courses", "cards" );
  $value = ob_get_contents();
  ob_end_clean();

  return $value;
}

add_shortcode( 'nau_courses_by_state', 'get_courses_by_state' );

// END OF TESTING
