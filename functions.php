<?php

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );

$stage_mode = (get_option('nau_environment') == "stage"); 

require_once('inc/acf-conf.php');
require_once('inc/admin.php');

remove_action('template_redirect', 'redirect_canonical');


$theme_root = get_template_directory_uri();

function nau_post_thumbnails() {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'nau_post_thumbnails' );

function nau_load_theme_textdomain() {    
    load_theme_textdomain('nau-theme', get_template_directory() . '/languages' );
}
add_action('after_setup_theme', 'nau_load_theme_textdomain' );


function nau_theme_enqueue_styles() {
    wp_enqueue_style('reset-style', get_template_directory_uri() . '/assets/css/reset.css', array(), '1.0.0', 'all');
    wp_enqueue_style('styles-style', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0.0', 'all');
    wp_enqueue_style('style-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
    wp_enqueue_script('script_functions', get_template_directory_uri() . '/assets/js/functions.js', array(), '1.0.0', true);
    wp_enqueue_script('menu_slider', get_template_directory_uri() . '/assets/js/menu_slider_and_other_operations.js', array(), '1.0.0', true);    
}

add_action( 'wp_enqueue_scripts', 'nau_theme_enqueue_styles' );

function nau_theme_setup() {
    add_theme_support('menus');
    
    register_nav_menu('main', 'Top Bar Menu');
    register_nav_menu('footer', 'Footer Menu');
    register_nav_menu('access', 'NAU Access Menu');
}

add_action('init', 'nau_theme_setup');


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


function nau_list_child_pages() { 
 
  global $post; 
 
  if ( is_page() && $post->post_parent )
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
  else
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
 
  if ( $childpages ) { 
    $string = '<ul>' . $childpages . '</ul>';
  }
 
  return $string; 
}
 
add_shortcode('nau_childpages', 'nau_list_child_pages');


function nau_get_pages($category = "", $atts = array()) { 

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
   get_template_part( "courses", "cards" );
}


function nau_entity_courses($entityPage) {
    return nau_get_posts("curso", array(), array('nau-organization'=>$entityPage->ID));
}

function nau_get_posts($category = "", $atts = array(), $fields = array()) { 

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
        foreach($fields as $field_name => $test_value) {
            $value = get_field($field_name, $post->ID);
            if ($value == $test_value) {
              $list[] = $post->to_array();
              break;
            }
        }
      }
  } else {
    foreach($query->posts as $post) {
      $list[] = $post->to_array();
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
        $s .= __("None found");// no posts found
    }
    return $s;
}

function nau_entities_list($atts = array()) {   
   return make_link_list(nau_get_pages("entidade", $atts));
} 

add_shortcode('nau_entities_list', 'nau_entities_list');

function nau_courses_list($atts = array()) {    
   return make_link_list(nau_get_pages("curso", $atts));
}

add_shortcode('nau_courses_list', 'nau_courses_list');


function nau_courses_gallery($atts = array()) { 
   global $courses;
   $courses = nau_get_pages("curso", $atts);
   ob_start();
   get_template_part( "courses", "cards" );
   $value = ob_get_contents();
   ob_end_clean();

   return $value;
}

add_shortcode('nau_courses_gallery', 'nau_courses_gallery');


function nau_theme_gallery() {       
   ob_start();
   get_template_part( "terms", "cards" );
   $value = ob_get_contents();
   ob_end_clean();

   return $value;
}

add_shortcode('nau_theme_gallery', 'nau_theme_gallery');


function html_list_pages($pages, $fields, $extra_fields) {
    $html = "<table>";
    $html .= "<tr>";
    foreach($fields as $k => $v) {
        $html .= "<th>" . $v . "</th>";
    }
    foreach($extra_fields as $k => $v) {
        $html .= "<th>" . $v . "</th>";
    }
    $html .= "</tr>";    
    foreach($pages as $page) {
      $html .= "<tr>";
      foreach($fields as $k => $v) {
          
        $l = "";
        $c = "";
        
        if ($k == "ID") {
            $l .= "<a href='" . get_permalink($page) . "'>" . $page->ID . "</a> ";
            $l .= "<a href='/wp-admin/post.php?post=" . $page->ID . "&action=edit'>(E)</a>";
        } else
        if ($k == "post_title") {
            $l .= $page->post_title;
        } else
        if ($k == "post_status") {
            $l .= get_post_statuses()[$page->post_status];
            $c = 'class="page_state_' . $page->post_status . '"';
        } else
        if ($k == "modified_time") {
            $l .= get_the_modified_time('Y-m-d h:i:s',$page->ID);
        } else {
            $l .= get_field($k, $page->ID);
        }
        
        $html .= "<td $c>" . $l . "</td>";
      }
      foreach($extra_fields as $k => $v) {
          
        $l = get_field($k, $page->ID);
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
            $l = nau_list_tags($page->ID);
        } 
          
        $html .= "<td>" . $l . "</td>";
      }
      # $html .= "<td>" . var_export($page) . "</td>";
      $html .= "</tr>";    
    }
    $html .= "</table>";
    
    return $html;
}

function nau_list_courses_extended($atts = array()) { 
   global $courses;
   $courses = nau_get_pages("curso", $atts);

   $value = "<h3>Lista de Cursos</h3>";
   $value .= html_list_pages($courses, 
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
       'nau_lms_course_enrollments' => 'Participantes', 
       'nau_lms_course_certificates' => 'Certificates',
       '_tags' => 'Tags',
       'update-overview' => 'Auto-update'
     ]);

   return $value;
}

add_shortcode('nau_list_courses_extended', 'nau_list_courses_extended');



function nau_entities_gallery($atts = array()) { 
   global $entities;
   $entities = nau_get_pages("entidade", $atts);
   ob_start();
   get_template_part( "entities", "cards" );
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



function nau_list_tags($page = -1) {
    if ($page < 0) {
        $page = get_the_ID();
    }
    
    $tags = get_the_tags($page);
    $entity = get_field('nau-organization', $page);
    
    $s = "";
    
    if ($entity)
      $s .= "<a class='bubble entity' href='" . get_permalink($entity) . "'>" . get_field('sigla', $entity) . "</a>";
  
    foreach($tags as $tag) {
      $s .= "<a class='bubble tag' href='" . get_term_link($tag->term_id) . "'>" . $tag->name . "</a>";
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




function load_course($coursePage) {

  if (gettype($coursePage) == "array") {
      $coursePage = get_page($coursePage["ID"]);
  }
  
  $entityPage = get_page(get_field("nau-organization", $coursePage->ID));
  
  $entity = load_entity($entityPage);

// print(var_dump(get_fields($entity->ID)));
  
  $course_id = get_field('course-id-prod', $coursePage->ID);
  if ($course_id == "" || $stage_mode) {
      $course_id = get_field('nau_lms_course_id', $coursePage->ID);
  }
  $course_id_simple = explode(":", $course_id);
  if (count($course_id_simple)>1) {
    $course_id_simple = $course_id_simple[1];
  }
                      
  //$image = get_field("nau_lms_course_media_course_image", $coursePage->ID);
  $image = get_field("nau_lms_course_media_image_raw", $coursePage->ID);  
  if ($image == "") {
    $image = get_the_post_thumbnail_url( $coursePage->ID, 'full' );
  }
  
  
  $youtube = get_field("youtube", $coursePage->ID);
  if ($youtube == "") {          
      $l = parse_url(get_field("nau_lms_course_media_course_video", $coursePage->ID), PHP_URL_QUERY);                    
      parse_str($l, $q);          
      $youtube = $q["v"];
  }

  $cost = get_field("cost", $coursePage->ID);
  if ($cost == "" || $cost == "0") {
      $cost = __("Free");
  }

  $course = [
    "id" => $coursePage->ID,
    "course-id" => $course_id,
    "course-id-simple" => $course_id_simple,
    "card-color" => get_field("card-color", $coursePage->ID),
    "name" => $coursePage->post_title,
    "entity" => $entity,     
    "course_about_url" => get_permalink($coursePage->ID),
    "course_enroll_url" => get_permalink($coursePage->ID),
    "tagline" => get_field('tagline'),
    "effort" => get_field("nau_lms_course_effort", $coursePage->ID), 
    "logo" => $logo, 
    "image" => $image,    
    "stars" => get_field("stars", $coursePage->ID), 
    "price" => $cost,    
    "participants" => get_field("nau_lms_course_enrollments", $coursePage->ID),
    "certificates" => get_field("nau_lms_course_certificates", $coursePage->ID),
    "un-sustentability" => get_field("un-sustentability", $coursePage->ID),
    "small-description" => get_field("nau_lms_course_short_description", $coursePage->ID),
    "start" => get_field("nau_lms_course_start", $coursePage->ID),
    "youtube" => $youtube,
  ];


  return $course;
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
    "url_image" => $image_url,
    "url" => get_permalink($entityPage)
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
  $url = get_field('image', $obj);

  return [$color, $opacity, $hue, $url, $header];
}

?>
