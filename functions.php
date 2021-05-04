<?php
/*
 * Disable errors and warnings
**/
// error_reporting(0);

$stage_mode = (get_option('nau_environment') == "stage"); 

if (WP_DEBUG) {
  include('inc/debug_helpers.php');
}
// Initial theme setup
require_once('inc/setup.php');

require_once('inc/acf-conf.php');
require_once('inc/admin.php');

require_once('inc/posttypes.php');
require_once('inc/sidebars.php');

// Get all course related functions and hooks
require_once('inc/courses.php');

remove_action('template_redirect', 'redirect_canonical');

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );


function nau_trans($message) 
{    
    if (WP_DEBUG) {
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


function nau_theme_gallery() {       
   ob_start();
   get_template_part( "partials/terms", "cards" );
   $value = ob_get_contents();
   ob_end_clean();

   return $value;
}

add_shortcode('nau_theme_gallery', 'nau_theme_gallery');


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