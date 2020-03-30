<?php

$theme_root = get_template_directory_uri();

function nau_post_thumbnails() {
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'nau_post_thumbnails' );

function nau_theme_enqueue_styles() {
    wp_enqueue_style('reset-style', get_template_directory_uri() . '/assets/css/reset.css', array(), '1.0.0', 'all');
    wp_enqueue_style('styles-style', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0.0', 'all');
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

function wpb_list_child_pages() { 
 
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
 
add_shortcode('wpb_childpages', 'wpb_list_child_pages');


function nau_get_pages($category = "", $atts = array()) { 

  extract(shortcode_atts(array(
    'filter' => ''
    ), $atts));

  $args = array('post_type' => 'page', "posts_per_page" => -1, "category" => $category);
        
  if ($filter != "") {
       $args["tag_slug__in"] = explode(" ", $filter);
  }

  $query = new WP_Query($args);

  $list  = [];

  foreach($query->posts as $post) {
    $list[] = $post->to_array();    
  }
  
  return $list;
}

function nau_get_posts($category = "", $atts = array()) { 

  extract(shortcode_atts(array(
    'filter' => ''
    ), $atts));

  $args = array('post_type' => 'post', "posts_per_page" => -1, "category" => $category);
        
  if ($filter != "") {
       $args["tag_slug__in"] = explode(" ", $filter);
  }

  $query = new WP_Query($args);

  $list  = [];

  foreach($query->posts as $post) {
    $list[] = $post->to_array();    
  }
  
  return $list;
}


function make_link_list($array_of_pages) {
    $s = "";
    if (count($array_of_pages) > 0) {
        $s .= "<ul>";
        foreach($array_of_pages as $page) {             
          $s .= '<li><a href="' . get_permalink($page["ID"]) . '">' . $page["post_title"] . '</a></li>';          
        }
        $s .= "</ul>";
    } else {
        $s .= _("None found");// no posts found
    }
    return $s;
}

function nau_list_entities($atts = array()) {
   return make_link_list(nau_get_pages("entidade", $atts));
} 

add_shortcode('nau_list_entities', 'nau_list_entities');

function nau_list_courses($atts = array()) { 
   return make_link_list(nau_get_pages("curso", $atts));
}

add_shortcode('nau_list_courses', 'nau_list_courses');


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

    if (!$tags) return "";
    
    $s = "<span id='tags'>";
    foreach($tags as $tag) {
      $s .= "<a href='/" . $tag->slug . "'>" . $tag->name . "</span>";
    } 
    $s .= "</span>";

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

?>
