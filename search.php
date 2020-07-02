<?php 
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages course'";

  $search_query = get_search_query();
  $search_settings = [
      "pages"                    => [ "select" => 1, "msg" => nau_trans( 'Pages' ) ],
      "news"                     => [ "select" => 1, "msg" => nau_trans( 'News' ) ],
      "entities"                 => [ "select" => 1, "msg" => nau_trans( 'Entities' ) ],
      "courses"                  => [ "select" => 1, "msg" => nau_trans( 'Courses' ) ],
      
      "course_open"              => [ "select" => 1, "msg" => nau_trans( 'Open' ) ],
      "course_invitation_only"   => [ "select" => 1, "msg" => nau_trans( 'Invitation Only' ) ],
      "course_started"           => [ "select" => 1, "msg" => nau_trans( 'Started' ) ],
      "course_about_to_start"    => [ "select" => 1, "msg" => nau_trans( 'About to Start' ) ],
      "course_ended"             => [ "select" => 1, "msg" => nau_trans( 'Ended' ) ],
      "course_about_to_end"      => [ "select" => 1, "msg" => nau_trans( 'About to end' ) ]
  ];
  
  
  
  if (is_search()) {
  
    if (isset($_POST["filter"])) {        
        foreach($search_settings as $key => &$item) {
            if (isset($_POST[$key])) {
                $item["select"] = 1;
            } else {
                $item["select"] = 0;
            }
        }
    }


    $list_posts = [];
    foreach($wp_query->posts as $p) {
        $add_to_list = False;
        $categories = get_the_category($p->ID);
        
        if ($search_settings["pages"]["select"]) {
          foreach($categories as $category) {
            if ($category->slug == "geral") {
                $add_to_list = True;
                $break;
            }
          }
        }
        
        if ($search_settings["news"]["select"]) {
          foreach($categories as $category) {
            if ($category->slug == "noticia") {
                $add_to_list = True;
                $break;
            }
          }
        }
        
        if ($search_settings["entities"]["select"]) {
          foreach($categories as $category) {
            if ($category->slug == "entidade") {
                $add_to_list = True;
                $break;
            }
          }
        }
        
        if ($search_settings["courses"]["select"]) {

            $is_course = False;
            
            foreach($categories as $category) {
                if ($category->slug == "curso") {
                  $is_course = True;                  
                  break;
                }
            }
            
            if ($is_course) {
                $visibility_mode = get_field("nau_lms_course_catalog_visibility", $p->ID);
                if ($visibility_mode == "both") {

                  # TO-DO: Course Search Filter
                    
                  $add_to_list = True;
                }
            }
        }
        
        if ($add_to_list) {
            $list_posts[] = $p;
        }
    }
  
    $page_title = count($list_posts) . " " . nau_trans('results') . " " . nau_trans('for search string:') . " \"" . get_search_query() . "\"";
  
  } else {
      $page_title = "Onde estou?!";
  }



  
  
  function form_check($id) {      
     global $search_settings;
     
     return ($search_settings[$id]["select"]?"checked":"");
  }
  
  function check_box($name, $text) {
      ?>
      <label class="search-container"><?=$text?><input type="checkbox" class="search-checkbox" name="<?=$name?>" <?=form_check($name)?>><span class="checkmark"></span></label>
      <?
  }

  function check_boxes($filters) 
  {
      global $search_settings;
      
      foreach($filters as $filter) {
        $value = $search_settings[$filter];
        check_box($filter, $value["msg"]);
      }
  }


  $args = array(
    'p'         => intval(get_option('nau_news_page')), // ID of a page, post, or custom type
    'post_type' => 'any'
  );
  $wp_query = new WP_Query($args);

  get_header();
  
  include "inc/simple_header.php";
?>

    

<div id="body-content"> 

  <article>

    
    <h2 class="search-title">
      <?=nau_trans("Search results")?>
    </h2>

    <div class="result-set">
    <?php    
    
      foreach($list_posts as $post) {
        get_template_part( 'content', 'search' );
      }
    ?>
    </div>
  </article>
  
  <aside>

    <h2 class="search-tool">
      <?=nau_trans("Search tool")?>
    </h2>
    <form role="search" method="post" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <div id="query">
            <span class="screen-reader-text"><?php echo nau_trans( 'Search for:' ) ?></span>
            <input type="search" class="search-field"
                placeholder="<?php echo nau_trans( 'Search ...') ?>"
                value="<?php echo $search_query ?>" name="s"
                title="<?php echo nau_trans( 'Search for:' ) ?>" />
            <input id="submit" type="submit" class="search-submit"
                value="<?php echo nau_trans( 'Search' ) ?>" />
            <input type="hidden" name="filter" value="filter-form">
        </div>
        <div id="categories">
            <span class="top-label"><?php echo nau_trans( 'Content type:' ) ?></span>
            <? check_boxes(["pages", "news", "entities", "courses"]); ?>
        </div>
        <div id="filter">
            <span class="top-label"><?php echo nau_trans( 'Show courses that are:' ) ?></span>
            <? check_boxes(["course_open", "course_invitation_only", "course_started", "course_about_to_start", "course_ended", "course_about_to_end"]); ?>
        </div>
    </form>
    
    <h3><?=nau_trans("Temáticas")?></h3>
    <div class="search-bubbles">
        <?=nau_list_tags()?>    
        <?=nau_list_categories()?>
    </div>
    
  </aside>

</div>
<!-- ends homepage body content --> 

  
  

<?php
  get_template_part( "global", "footer" );
?>
<?php get_footer(); ?>

