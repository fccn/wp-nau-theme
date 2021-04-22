<?php

$stage_mode = (get_option('nau_environment') == "stage"); 

require_once('inc/acf-conf.php');
require_once('inc/admin.php');

remove_action('template_redirect', 'redirect_canonical');

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

function nau_post_thumbnails() {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'nau_post_thumbnails' );

function nau_load_theme_textdomain() {    
    load_theme_textdomain('nau-theme', get_template_directory() . '/languages' );
}
add_action('after_setup_theme', 'nau_load_theme_textdomain' );


function nau_trans($message) 
{    
    if (WP_DEBUG == true) {
        $filename = get_template_directory() . '/languages/strings.php';
        $lines = file($filename);
        $found = false;
        foreach($lines as $line) {
            if (strstr(chop($line), "nau_trans(\"$message\");")) {
              $found = true;
              break;
            }
        }
        if (!$found) {
          $lines[] = "nau_trans(\"$message\");\n";
          file_put_contents($filename, implode("", $lines));
        }
    }
    
    return __($message, "nau-theme");
}

function version_id() { 
  if ( WP_DEBUG )
    return time();
  if ( WP_NAU_THEME_VERSION != 'WP_NAU_THEME_VERSION' )
    return WP_NAU_THEME_VERSION;
  return '1.0.0';
}

function nau_theme_enqueue_styles() {
    wp_enqueue_style('reset-style', get_template_directory_uri() . '/assets/css/reset.css', array(), version_id(), 'all');
    wp_enqueue_style('styles-style', get_template_directory_uri() . '/assets/css/layout.css', array(), version_id(), 'all');
    
    wp_enqueue_script('script_functions', get_template_directory_uri() . '/assets/js/functions.js', array(), version_id(), true);
    wp_enqueue_script('menu_slider', get_template_directory_uri() . '/assets/js/menu_slider_and_other_operations.js', array(), version_id(), true);
    wp_enqueue_script('cookie_bar', get_template_directory_uri() . '/assets/js/cookie-bar.js', array('jquery'), version_id(), true);

    wp_enqueue_style('material-icons', '//fonts.googleapis.com/icon?family=Material+Icons');
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
}

add_action( 'wp_enqueue_scripts', 'nau_theme_enqueue_styles' );

function nau_theme_setup() {
    add_theme_support('menus');
    
    register_nav_menu('main', 'Top Bar Menu');
    register_nav_menu('footer', 'Footer Menu');
    register_nav_menu('access', 'NAU Access Menu');
}

add_action('init', 'nau_theme_setup');

// register widgets

function register_footer_widgets() {
  // left footer area
  register_sidebar( 
    array(
      'name' => esc_html__( 'Footer left area', 'nau_theme' ),
      'id' => 'footer_left_area',
      'description' => esc_html__( 'Add a menu to the left footer area', 'nau_theme' ),
      'before_widget' => '<div id="%1s" class="footer-widget %2s">',
      'after_widget' => '</div>',
      'before_title' => '<span class="footer-title">',
      'after_title' => '</span>',
    )
  );
  // center footer area
  register_sidebar( 
    array(
      'name' => esc_html__( 'Footer center area', 'nau_theme' ),
      'id' => 'footer_center_area',
      'description' => esc_html__( 'Add a menu to the center footer area', 'nau_theme' ),
      'before_widget' => '<div id="%1s" class="footer-widget %2s">',
      'after_widget' => '</div>',
      'before_title' => '<span class="footer-title">',
      'after_title' => '</span>',
    )
  );
  // right footer area
  register_sidebar( 
    array(
      'name' => esc_html__( 'Footer right area', 'nau_theme' ),
      'id' => 'footer_right_area',
      'description' => esc_html__( 'Add a menu to the right footer area', 'nau_theme' ),
      'before_widget' => '<div id="%1s" class="footer-widget %2s">',
      'after_widget' => '</div>',
      'before_title' => '<span class="footer-title">',
      'after_title' => '</span>',
    )
  );
  register_sidebar( 
    array(
      'name' => esc_html__( 'Footer entity logos', 'nau_theme' ),
      'id' => 'footer_entity_logos',
      'description' => esc_html__( 'Add a menu to the bottom area of the footer', 'nau_theme' ),
      'before_widget' => '<div id="%1s" class="footer-bottom-area %2s">',
      'after_widget' => '</div>',
      'before_title' => '<span class="footer-title">',
      'after_title' => '</span>',
    )
  );
}
add_action( 'widgets_init', 'register_footer_widgets' );

/*
function nau_include($atts = array()) { 
 
    extract(shortcode_atts(array(
    'file' => ''
    ), $atts));

    $inc = get_template_directory() . "/inc/" . $file;
    
    ob_start();
    include $inc;
    $value = ob_get_contents();
    ob_end_clean();
  
    return $value; 
}
 
add_shortcode('nau_include', 'nau_include');
*/

function nau_list_child_pages($atts = array()) { 
 
  global $post; 
  
  extract(shortcode_atts(array(
    'child_of' => ''
  ), $atts));
  
 
   if ($child_of != "") {
       
     $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $child_of . '&echo=0' );
     
   } else {
       
     if ( is_page() && $post->post_parent )
       $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
     else
       $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

   }
 
  if ( $childpages ) { 
    $string = '<ul>' . $childpages . '</ul>';
  }
 
  return $string; 
}
 
add_shortcode('nau_list_child_pages', 'nau_list_child_pages');


function _nau_get_pages($category = "", $atts = array()) { 

  extract(shortcode_atts(array(
    'filter' => ''
    ), $atts));

  $args = array(
    'post_type' => 'page', 
    'posts_per_page' => -1, 
    'category_name' => $category,
    'orderby' => 'menu_order',
    'order' => 'ASC'
  );
        
  if ($filter != "") {
       $args["tag_slug__in"] = explode(" ", $filter);
  }

  $query = new WP_Query($args);

  return $query->posts;

  /*
  $list  = [];

  foreach($query->posts as $post) {
    $list[] = $post->to_array();    
  }
  
  return $list;
  */
}



function nau_get_un_courses($un_id) {
    return nau_get_posts("curso", array(), array('un-sustentability'=>$un_id));
}

function nau_un_courses_gallery($un_id) {
   global $courses;
   $courses = nau_get_un_courses($un_id);   
   get_template_part( "partials/courses", "cards" );
}


function nau_entity_courses($entityPage) {
    return nau_get_posts("curso", array(), array('nau-organization'=>$entityPage->ID));
}

function nau_get_posts($category = "", $atts = array(), $fields = array(), $showall = 0) { 

  if (($category=="curso") && (!$showall)) {
      # $fields[] = array('nau_lms_course_catalog_visibility' => 'both');
      $fields["nau_lms_course_catalog_visibility"] = 'both';
  }

  extract(shortcode_atts(array(
    'filter' => ''
    ), $atts));

  $args = array(
    'post_type' => 'page', 
    'posts_per_page' => -1, 
    'category_name' => $category,
    'orderby' => 'menu_order',
    'order' => 'ASC'
  );
        
  if ($filter != "") {
       $args["tag_slug__in"] = explode(" ", $filter);
  }

  $query = new WP_Query($args);

  $list  = [];

  if ($fields) {

      foreach($query->posts as $post) {
        $cnt = count($fields);
        
        foreach($fields as $field_name => $test_value) {
            $value = get_field($field_name, $post->ID);            
            if ($value == $test_value) {
                $cnt--;
                if ($cnt == 0) {
                      $list[] = $post;
                      break;
                }
            }
        }
      }
  } else {
    foreach($query->posts as $post) {
      $list[] = $post;
    }
  }
  
  
  return $list;
}



function make_link_list($array_of_pages) {
    $s = "";
    if (count($array_of_pages) > 0) {
        $s .= "<ul>";
        foreach($array_of_pages as $page) {             
          $s .= '<li><a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a></li>';          
        }
        $s .= "</ul>";
    } else {
        $s .= nau_trans("None found", "nau-theme");// no posts found
    }
    return $s;
}

function nau_entities_list($atts = array()) {   
   return make_link_list(nau_get_posts("entidade", $atts));
} 

add_shortcode('nau_entities_list', 'nau_entities_list');

function nau_courses_list($atts = array()) {    
   return make_link_list(nau_get_posts("curso", $atts));
}

add_shortcode('nau_courses_list', 'nau_courses_list');


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


function nau_theme_gallery() {       
   ob_start();
   get_template_part( "partials/terms", "cards" );
   $value = ob_get_contents();
   ob_end_clean();

   return $value;
}

add_shortcode('nau_theme_gallery', 'nau_theme_gallery');


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



function nau_entities_gallery($atts = array()) { 
   global $entities;
   $entities = nau_get_posts("entidade", $atts);
   ob_start();
   get_template_part( "partials/entities", "cards" );
   $value = ob_get_contents();
   ob_end_clean();

   return $value;
}

add_shortcode('nau_entities_gallery', 'nau_entities_gallery');


function nau_list_news($atts = array()) { 
   return make_link_list(nau_get_posts("noticia", $atts));
}


function get_custom_value($key, $default = "", $page = -1) {

  if ($page < 0) {
    $page = get_the_ID();
  }

  $values = get_post_custom_values($key, $page);

  if ($values == null) {
    return $default;
  }

  return $values[0]; // Returns First Value of array    
}
  
  
# teste



function nau_list_tags($page = -1, $only_tags = False) {
    if ($page < 0) {
        $page = get_the_ID();
    }
    
    $tags = get_the_tags($page);
    $entity = get_field('nau-organization', $page);
    
    $s = "";
    
    if ($entity && !$only_tags)
      $s .= "<a class='bubble entity' href='" . get_permalink($entity) . "'>" . get_field('sigla', $entity) . "</a> ";
  
    foreach($tags as $tag) {
        if (($tag->slug != "highlight") && ($tag->slug != "running-course")) {
            $s .= "<a class='bubble tag' href='" . get_term_link($tag->term_id) . "'>" . $tag->name . "</a> ";
        }
    }     

    return $s;
}

function nau_list_categories($page = -1) {
    if ($page < 0) {
        $page = get_the_ID();
    }
    
    $categories = get_the_category($page);

    if (!$categories) return "";
    
    $s = "";
    foreach($categories as $category) {
      $s .= "<a class='bubble category' href='" . get_term_link($category->term_id) . "'>" . $category->name . "</a>";
    }

    return $s;
}


/*
function nau_register_query_vars( $vars ) {    
    $vars[] = 'search';
    $vars[] = 'title';
    $vars[] = 'entity';
    return $vars;
}
add_filter( 'query_vars', 'nau_register_query_vars' );
*/


function stars($stars) {
     
  for($star = 0; $star < $stars; $star++) {
    print('<img class="rating-star dark" src="assets/img/rating-star.svg">');
  } 

  for($star = $stars; $star < 5; $star++) {
    print('<img class="rating-star light" src="assets/img/rating-star-light.svg">');
  } 
}

function days_to_today($date) {

  $today = strtotime("now");
  $date = strtotime($date);

  $days = round(($date - $today) / (60 * 60 * 24));

  return $days;  
}

function load_analytics() {
  $course_id_simple = load_course_id_simple( $page );
  if ( $course_id_simple != null ) {
    $course_id_parts = explode("+", $course_id_simple);
    if (count($course_id_parts) == 3) {
      return $course_id_parts;
    }
  } else  {
    $entity = load_entity( $page );
    if ( $entity != null ) {
      return array ($entity['sigla'], '', '');
    }
  }
  return array ("", "", "");
}

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
      $youtube = $q["v"];
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

  $course["debug"] = get_post_custom($post_id);

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

function load_entity($entityPage) {
  
  if (gettype($entityPage) == "array") {
      $entityPage = get_page($entityPage["ID"]);
  }

  $image_url = "assets/img/banner-01.jpg";
  if( has_post_thumbnail() ) {
    $image_url = get_the_post_thumbnail_url();
  }; 

  $square_logo_image = get_field('square-logo', $entityPage->ID); 
  $logo_image = get_field('logo', $entityPage->ID); # URL

  if ($square_logo_image == "") 
      $square_logo_image = $logo_image;
  
  if ($logo_image == "")
      $logo_image = $square_logo_image;
    
  $entity = [
    "name" => get_the_title($entityPage),
    "logo" => $logo_image,    
    "square_logo" => $square_logo_image,
    "sigla" => get_field("sigla", $entityPage->ID),
    "slug" => get_field("slug", $entityPage->ID),
    "website" => get_field("website", $entityPage->ID),
    "video" => get_field("youtube", $entityPage->ID),
    "url_image" => $image_url,
    "url" => get_permalink($entityPage),
    "confluence_url" => get_field("confluence_url", $entityPage->ID)
  ];

  return $entity;
}


function load_term($termObj) {
  $image_url = "assets/img/banner-01.jpg";
        
  $term_img = get_field("image", $termObj);
  
  if (!$term_img ) {
    $term_img = $image_url;
  };  
  
  return [
      "name" => $termObj->name,
      "image" => $term_img,
      "url" => get_term_link($termObj),
      "slug" => $termObj->slug,
      "excerpt" => $termObj->description,
  ];
}

function get_page_fields() {

  $obj = get_queried_object();

  $header = get_field('header', $obj); 
  $color = get_field('color', $obj); 
  $hue = get_field('hue', $obj); 
  $opacity = get_field('opacity', $obj); 
  $grayscale = get_field('grayscale', $obj); 
  $url = get_field('image', $obj);

  if( $url == "") {
    if ( has_post_thumbnail($obj) ) {
      $url = get_the_post_thumbnail_url($obj);
    } else {
      $url = "assets/img/banner-01.jpg";
    };
  }; 

  return [$color, $opacity, $hue, $grayscale, $url, $header];
}



function nau_cookie_clear($atts = array()) { 

    extract(shortcode_atts(array(
    'class' => 'btn'
    ), $atts));

    return '<span id="cookie-reset"><a id="clearCookie" class="' . $class . '">' . nau_trans("Clear Cookie", "nau-theme") . '</a></span>';
}

add_shortcode('nau_cookie_clear', 'nau_cookie_clear');

function nau_cookie_date_set($atts = array()) { 

    return '<span id="nau_cookie_date_set"></span>';
}

add_shortcode('nau_cookie_date_set', 'nau_cookie_date_set');


function nau_enroll_button($course) {
  print (do_shortcode('[edunext_enroll_button course_id="' . $course["course-id"] . '"]'));
}

function certificate($course) {
    
   if ($course["certificate_type"] != "hidden") {       
        print("<span class='certificate-badge " . $course["certificate_type"] . "'></span>");
   }
}

function IXR_Date2Date($el) {
  return($el);
}

function nau_generate_custom_value_meta_html($meta_value, $object) {
  $linhas = explode("\n", $meta_value);
  foreach ($linhas  as $linha ) {        
    if ($linha <> "") {
      list($id, $label, $action, $target) = explode("|", $linha);
      
      $cnt = preg_match("/{([a-z_A-Z0-9]*)}/", $label, $matches);
      
      if ($cnt == 1) {
          
          # Tries course already loaded data
          $v = "";
          if (isset($object[$matches[1]])) {
              $v = $object[$matches[1]];
          } else {
              # No data prepared, try post field
              $v = get_field($matches[1], $post->ID);
          }

          $label = str_replace("{" . $matches[1] . "}", $v, $label);
      }

      $target = $target ? : '_blank';
      
      if (substr($id, 0, 10) == "materials-") {
          $icon = substr($id, 10);                
          if ($action == "")
            $li_html .= "<li id='$id' class='course-details x-material-icons'><i class='material-icons aside-icons'>$icon</i><span>$label</span></li>";
          else
            $li_html .= "<li id='$id' class='course-details material-right-arrow x-material-icons'><a href='$action' target='$target'><i class='material-icons aside-icons'>$icon</i><span>$label</span></a></li>";
      } else {
          if ($id == "contact-telephone") {
              if ($action == "") $action = $label;
              $li_html .= "<li id='$id' class='$id course-details right-arrow'><a href='tel:$action' target='_self'>$label</a></li>";
          } else 
          if ($id == "contact-email") {
              if ($action == "") $action = $label;
              $li_html .= "<li id='$id' class='$id course-details right-arrow'><a class='no-capitalize' href='mailto:$action' target='_self'>$label</a></li>";
          } else 
          if ($id == "contact-website") {
              if ($action == "") $action = $label;
              $li_html .= "<li id='$id' class='$id course-details right-arrow'><a class='no-capitalize' href='$action' target='_blank'>$label</a></li>";
          } else {
              if ($action != "") {
                $li_html .= "<li class='$id course-details right-arrow'><a href='$action' target='_blank'>$label</a></li>";
              } else {
                $li_html .= "<li id='$id' class='$id course-details no-capitalize'>$label</li>";
              }
          }
      }
    }
  }
  return $li_html;
}

function nau_template_part(string $slug, string $name = null, array $args = array()) {
  ob_start();
  get_template_part( $slug, $name, $args );
  $value = ob_get_contents();
  ob_end_clean();
  return $value;
}

function nau_homepage_funder_entities_small_images($atts = array()) {    
  return nau_template_part("partials/homepage/homepage", "entities");
}
add_shortcode('nau_homepage_funder_entities_small_images', 'nau_homepage_funder_entities_small_images');

function nau_homepage_highlight_courses($atts = array()) {    
  global $courses;
  $courses = nau_get_posts("curso", ["filter" => "highlight"]);
  $args = array('section_container' => 'highlight-courses');
  return nau_template_part("partials/courses", "cards", $args);
}

add_shortcode('nau_homepage_highlight_courses', 'nau_homepage_highlight_courses');

function nau_homepage_slider($atts = array()) {    
  return nau_template_part( "partials/homepage/homepage", "slider" );
}
add_shortcode('nau_homepage_slider', 'nau_homepage_slider');

// This theme has a custom image thumnail format
add_theme_support( "post-thumbnails" );

// Register the image thumbnail format, a specific format for course and entity cards
add_image_size( 'nau-card-thumbnail', 279, 160, FALSE );

/*
// Load some of the JavaScript asynchronous. The scriptArr variable has the scripts to be loaded async
function add_custom_attr( $tag, $handle, $src ) {
  $scriptArr = array('script_functions','menu_slider','cookie_bar','slider_lib','home_slider');
  if (in_array($handle, $scriptArr)) {
    // $tag = str_replace( 'src=', 'sync="false" src=', $tag );
    //$tag = str_replace( ' src', ' defer src', $tag ); // defer the script
    //$tag = str_replace( ' src', ' async src', $tag ); // OR async the script
    $tag = str_replace( ' src', ' async defer src', $tag ); // OR do both!
  }
  return $tag;
}
add_filter( 'script_loader_tag', 'add_custom_attr', 10, 3 );

// Load CSS asynchronous
function add_rel_preload($html, $handle, $href, $media) {
  $scriptArr = array('wp-block-library', 'wp-edunext-marketing-site-frontend','reset-style','material-icons','google-fonts');
  if (!is_admin() && in_array($handle, $scriptArr)) {
    $html = <<<EOT
    <link rel='preload' as='style' onload="this.onload=null;this.rel='stylesheet'" id='$handle' href='$href' type='text/css' media='all' />

    EOT;
    return $html;
  }
  return $html;
}
add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );
*/