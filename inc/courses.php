<?php

function load_course_id($coursePage) {
    global $stage_mode;
  
    if (gettype($coursePage) == "array") {
        $coursePage = get_page($coursePage["ID"]);
    }
    
  // print(var_dump(get_fields($entity->ID)));
    
    $course_id = get_field('course-id-prod', $coursePage->ID);
  
    if ($course_id == "" || $stage_mode) {
        $course_id = get_field('nau_lms_course_id', $coursePage->ID);
    }
    return $course_id;  
  }
  
  function load_course_id_simple($coursePage) {
    $course_id = load_course_id( $coursePage );
  
    $course_id_simple = explode(":", $course_id);
    if (count($course_id_simple)>1) {
      return $course_id_simple[1];
    } else {
      return null;
    }
  }
  
  function get_course_name($coursePage) {
    $course_id = load_course_id($coursePage);
    if ($course_id != null) {
      return get_the_title( $coursePage );
    }
    return "";
  }
  
  function load_course($coursePage) {
    $course_id = load_course_id( $coursePage );
    $course_id_simple = load_course_id_simple( $coursePage );
  
    //$image = get_field("nau_lms_course_media_course_image", $coursePage->ID);
    //$image = get_field("nau_lms_course_media_image_raw", $coursePage->ID);  
    //if ($image == "") {
    //  $image = get_the_post_thumbnail_url( $coursePage->ID, 'full' );
    //}
    $image_full = get_the_post_thumbnail_url( $coursePage->ID, 'full' ); 
    $image_card = get_the_post_thumbnail_url( $coursePage->ID, 'nau-card-thumbnail' );
    
    $youtube = get_field("youtube", $coursePage->ID);
    if ($youtube == "") {          
        $l = parse_url(get_field("nau_lms_course_media_course_video", $coursePage->ID), PHP_URL_QUERY);                    
        parse_str($l, $q);          
        //$youtube = $q["v"];
    }
  
    $cost = get_field("cost", $coursePage->ID);
    if ($cost == "" || $cost == "0") {
        $cost = nau_trans("Free");
    }
  
  
    $course = [
      "id" => $coursePage->ID,
      "course-id" => $course_id,
      "course-id-simple" => $course_id_simple,
      "card_width" => get_field("card_width", $coursePage->ID),
      "card_image_fit" => get_field("image_fit", $coursePage->ID),
      "card-color" => get_field("card-color", $coursePage->ID),
      "name" => $coursePage->post_title,    
      "course_about_url" => get_permalink($coursePage->ID),
      "course_enroll_url" => get_permalink($coursePage->ID),
      "tagline" => get_field('tagline', $coursePage->ID),
      "effort" => get_field("nau_course_extra_about_effort", $coursePage->ID),
      "image_full" => $image_full,
      "image_card" => $image_card,
      "stars" => get_field("stars", $coursePage->ID), 
      "price" => $cost,    
      "participants" => get_field("nau_lms_course_enrollments", $coursePage->ID),
      "certificates" => get_field("nau_lms_course_certificates", $coursePage->ID),
      "un-sustentability" => get_field("un-sustentability", $coursePage->ID),
      "small-description" => get_field("nau_lms_course_short_description", $coursePage->ID),
      
      /* "start" => IXR_Date2Date(get_field("nau_lms_course_start", $coursePage->ID)), */
      /* "end"   => IXR_Date2Date(get_field("nau_lms_course_end",   $coursePage->ID)), */
      
      "youtube" => $youtube,
      
      "course_number" => get_field("nau_lms_course_number", $coursePage->ID),
                
      "enrollment_start" => substr(get_field("nau_lms_course_enrollment_start", $coursePage->ID), 0, 10), # - data hora -> data
      "enrollment_end" => substr(get_field("nau_lms_course_enrollment_end", $coursePage->ID), 0, 10), # - data hora -> data
  
      "start_date" => substr(get_field("nau_lms_course_start", $coursePage->ID), 0, 10), # - data hora -> data
      "end_date" => substr(get_field("nau_lms_course_end", $coursePage->ID), 0, 10), # - data hora -> data
  
      # in use ?
      "start_type" => get_field("nau_lms_course_start_type", $coursePage->ID), # - timestamp/?
      # "pacing" => get_field("nau_lms_course_pacing", $coursePage->ID), # - self/?
      
      "invitation_only" => get_field("nau_lms_course_invitation_only", $coursePage->ID), # -> 0/1
  
      "staff_only" => get_field("nau_lms_course_visible_to_staff_only", $coursePage->ID), # -> 0/1
      "catalog_visibility" => get_field("nau_lms_course_catalog_visibility", $coursePage->ID), # -> none/both/about
      "pace_mode" => get_field("nau_lms_course_self_paced", $coursePage->ID), # - 0/1
      
      "certificate_type" => get_field("certificate_type", $coursePage->ID), # - hidden / none / gold / silver / bronze    
      
      "status" => get_course_status($coursePage->ID),
  
      "confluence_url" => get_field("confluence_url", $coursePage->ID),
  
    ];
  
    // $course["debug"] = get_post_custom($post_id);
  
    $entityPage = get_page(get_field("nau-organization", $coursePage->ID));
    
    $course["entity"] = load_entity($entityPage);
    $course["pace_mode_label"] = ($course["pace_mode"]=="1"?nau_trans("Self paced"):nau_trans("Instructor paced"));
    $course["invitation_mode_label"] = ($course["invitation_only"]=="1"?nau_trans("Invitation only"):nau_trans("Open to everyone"));
    $course["status_label"] = nau_trans($course["status"]);
    
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
    
    return $course;
  }
  
  function get_course_status($coursePage) {
      return _("Open");
  }

  function nau_list_courses_extended($atts = array()) { 
    global $courses;
    $courses = nau_get_posts("curso", $atts, null, True);
 
    $value = "<h3>Lista de Cursos</h3>";
    $value .= html_list_courses($courses, 
      [
        'ID' => 'ID',
        'post_title' => 'Título',
        'post_status' => 'Estado Página',
        'modified_time' => 'Ultima Atualização',              
      ], 
      [
        'nau-organization' => 'Entidade', 
        'nau_lms_course_id' => 'STAGE', 
        'course-id-prod' => 'PROD', 
        'confluence_url' => "info",
        'nau_lms_course_enrollments' => 'Participantes', 
        'nau_lms_course_certificates' => 'Certificates',
        '_tags' => 'Tags',
        'update-overview' => 'Auto-update',
        'nau_lms_course_catalog_visibility' => 'Visibility'       
      ],
      [
        'start_date' => 'Inicio',
        'end_date' => 'Fim',
        'date_status_label' => 'status',       
      ]);
 
    return $value;
 }
 
 add_shortcode('nau_list_courses_extended', 'nau_list_courses_extended');

 function html_list_courses($courses, $fields, $extra_fields, $keys) {
    $html = "<table>";
    $html .= "<tr>";
    foreach($fields as $k => $v) {
        $html .= "<th>" . $v . "</th>";
    }
    foreach($extra_fields as $k => $v) {
        $html .= "<th>" . $v . "</th>";
    }
    foreach($keys as $k => $v) {
        $html .= "<th>" . $v . "</th>";
    }
    $html .= "</tr>";    
    foreach($courses as $course) {
      $html .= "<tr>";
      foreach($fields as $k => $v) {
          
        $l = "";
        $c = "";
        
        if ($k == "ID") {
            $l .= "<a href='" . get_permalink($course) . "'>" . $course->ID . "</a> ";
            $l .= "<a href='/wp-admin/post.php?post=" . $course->ID . "&action=edit'>(E)</a>";
        } else
        if ($k == "post_title") {
            $l .= $course->post_title;
        } else
        if ($k == "post_status") {
            $l .= get_post_statuses()[$course->post_status];
            $c = 'class="page_state_' . $course->post_status . '"';
        } else
        if ($k == "modified_time") {
            $l .= get_the_modified_time('Y-m-d h:i:s',$course->ID);
        } else {
            $l .= get_field($k, $course->ID);
        }
        
        $html .= "<td $c>" . $l . "</td>";
      }
      foreach($extra_fields as $k => $v) {
          
        $l = get_field($k, $course->ID);
        if ($k == "nau_lms_course_id") {
            $url = "https://lms.stage.nau.fccn.pt/courses/" . $l . "/about";
            $l = "<a href='" . $url . "'>" . $l . "</a>";
        } 
        if ($k == "course-id-prod") {                    
            $url = "https://lms.nau.edu.pt/courses/" . $l . "/about";
            $l = "<a href='" . $url . "'>" . $l . "</a>";
        } 
        
        if ($k == "nau-organization") {
            $url = get_permalink($l);
            $t = get_field('nau-id', $l);
            $l = "<a href='" . $url . "'>" . $t . "</a>";
        } 
        
        if ($k == "_tags") {            
            $l = nau_list_tags($course->ID);
        } 
        
        if ($k == "confluence_url") {            
          if ($l != "") {
             $l = "<a href='" . $l . "'><span class='material-icons'>info</span></a>";
          }
        } 
          
        $html .= "<td>" . $l . "</td>";
      }
      
      $c = load_course($course);
      
      foreach($keys as $k => $v) {
        $class = "";
        $l = $c[$k];        
        if ($k == "date_status_label") {
          $class = $c["date_status_class"];
        }
        
        if ($class != "") {
          $class = "class='$class'";
        }
        
        $html .= "<td $class>" . $l . "</td>";
      }
      # $html .= "<td>" . var_export($course) . "</td>";
      $html .= "</tr>";    
    }
    $html .= "</table>";
    
    return $html;
}

function nau_courses_gallery($atts = array()) { 
    global $courses;
    $courses = array_filter(nau_get_posts("curso", $atts), function($coursePage){
      $nau_lms_course_enrollment_end = get_field("nau_lms_course_enrollment_end", $coursePage->ID);
      $nau_lms_course_end = get_field("nau_lms_course_end", $coursePage->ID);
      $date = is_null($nau_lms_course_enrollment_end) || empty($nau_lms_course_enrollment_end)  ? $nau_lms_course_end : $nau_lms_course_enrollment_end;
      $days_to_end = days_to_today ( $date );
      return $days_to_end >= 0;
    });
  
    ob_start();
    get_template_part( "partials/courses", "cards" );
    $value = ob_get_contents();
    ob_end_clean();
  
    return $value;
  }
  
  add_shortcode('nau_courses_gallery', 'nau_courses_gallery');

  function nau_courses_list($atts = array()) {    
    return make_link_list(nau_get_posts("curso", $atts));
 }
 
 add_shortcode('nau_courses_list', 'nau_courses_list');