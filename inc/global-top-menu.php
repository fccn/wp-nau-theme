<?php

use lloc\Msls\MslsBlogCollection;
use lloc\Msls\MslsOptions;

class NAU_Walker_Main_Nav_Menu extends Walker_Nav_Menu {      
    function start_lvl( &$output, $depth = 0, $args = array() ) {            
        $classes = array(
            'sub-nav',            
            'menu-depth-' . $depth
        );
        $class_names = implode( ' ', $classes );
 
        // Build HTML for output.
        $output .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }
};


class NAU_Walker_Access_Menu extends Walker_Nav_Menu {      

    var $cnt = 0;

    function start_lvl( &$output, $depth = 0, $args = array() ) {            
        $classes = array(
            'sub-nav',
            'access-menu',
            'menu-depth-' . $depth
        );
        $class_names = implode( ' ', $classes );
 
        // Build HTML for output.
        $output .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }


    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= '<li' . $id . $value . $class_names .">\n";

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        
        if($this->cnt < 1) {
          $atts['id']     = 'register';
        } else {
          $atts['id']     = 'login_image';
        }
        $this->cnt++;

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after . "\n";

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    
}

?>


<? if (1) { ?>

  <div id="branding-top-nav">
    <a id="open-menu-arrow" href="javascript:void(0)" onclick="openNav(0)" title="<?=nau_trans("Open")?>">&#9776;</a>  
    <a href="<?=get_site_url()?>"><img id="logo" src="assets/img/nau_sempre_aprender.svg" alt="NAU logo"></a> 

    <!-- starts menu container -->
    <div id="menu-container">

      <!-- starts top nav menu -->
      <a id="close-menu-arrow" href="javascript:void(0)" onclick="closeNav(0)" title="<?=nau_trans("Close")?>">&#10005;</a>
      <div class="nav-icon"></div>
      <?php 
          wp_nav_menu(array(
                  "theme_location" => "main",
                  "depth" => 2,
                  "container" => "ul",
                  "menu_id" => "about-categories-entities",
                  "walker" => new NAU_Walker_Main_Nav_Menu()
                )); 
      ?>  

      <!-- starts top nav action container -->
      <div id="actions_container"> 
  
          <!-- starts top nav search bar -->          
          <form id="search-form" action="<?php echo home_url(); ?>" role="search" method="get">
            <input id="s" name="s" type="search" placeholder="<?=nau_trans("Search courses...")?>" value="<?=get_search_query()?>">
            <input name="submit-search" type="submit">
          </form>
          <!-- ends top nav search bar -->
      
      <!-- starts menu languages --> 
      
      <?php 
      
      $blogs  = MslsBlogCollection::instance();
      $mydata = MslsOptions::create();      
      $language_menu_item = [];
      
      foreach ( $blogs->get_objects() as $blog ) {
          $language = $blog->get_language();
          $url = $mydata->get_current_link();
          $current  = ( $blog->userblog_id == MslsBlogCollection::instance()->get_current_blog_id() );
          $language_menu_item[] = array(
              "this_blog" => $current,
              "url" => $blog->siteurl,
              "language" => $language,
              "description" => $blog->get_description(),
              "lang_id" => $blog->get_alpha2()
          );
      }

      ?>
      <div id="languages-actions-container">
        <ul id="menu_languages">
          <?php 
          
            foreach($language_menu_item as $menu_item) {                
                if ($menu_item["this_blog"]) {
                    print("<li class=\"current_language\">" . $menu_item["lang_id"] . "</li>");
                } else {
                    print("<li><a href=\"" . $menu_item["url"] . "\" title=\"" . $menu_item["description"] . "\">" . $menu_item["lang_id"] . "</a></li>");
                }
            }
          ?>
         </ul>
      </div>
        
        <!-- starts login and register -->      
        <?php 
        wp_nav_menu(array(
            "theme_location" => "access",
            "depth" => 2,
            "container" => "ul",
            "menu_id" => "menu_login_register",
            "menu_class" => "login_menu",
            "walker" => new NAU_Walker_Access_Menu()
         )); 

        ?>  
        
        <!-- ends login and register -->     
        </div>  
  <!-- ends top nav action container --> 
    </div>    
  <!-- ends menu container -->     
  </div>
  <!-- ends branding container -->
  <div id="menu-overlay" onclick="closeNav(0)"></div>

<? } else { ?>


  <div id="nau-top-nav">
    <a id="open-menu-burguer" href="javascript:void()" onclick="openNav()" title="<?=nau_trans("Open")?>">&#9776;</a>  
    <a href="<?=get_site_url()?>"><img id="logo" src="assets/img/nau_sempre_aprender.svg" alt="NAU logo"></a> 

    <!-- starts menu container -->
    <div id="menu-container">

      <!-- starts top nav menu -->
      <a id="close-menu-arrow" href="javascript:void()" onclick="closeNav()" title="<?=nau_trans("Close")?>">&#10005;</a>
      <div class="nav-icon"></div>
      <?php 
          wp_nav_menu(array(
                  "theme_location" => "main",
                  "depth" => 2,
                  "container" => "ul",
                  "menu_id" => "about-categories-entities",
                  "walker" => new NAU_Walker_Main_Nav_Menu()
                )); 
      ?>  

      <!-- starts top nav action container -->
      <div id="actions_container"> 
  
          <!-- starts top nav search bar -->          
          <form id="search-form" action="<?php echo home_url(); ?>" role="search" method="get">
            <input id="s" name="s" type="search" placeholder="<?=nau_trans("Search courses...")?>" value="<?=get_search_query()?>">
            <input name="submit-search" type="submit">
          </form>
          <!-- ends top nav search bar -->
      
      <!-- starts menu languages --> 
      
      <?php 
      
      $blogs  = MslsBlogCollection::instance();
      $mydata = MslsOptions::create();      
      $language_menu_item = [];
      
      foreach ( $blogs->get_objects() as $blog ) {
          $language = $blog->get_language();
          $url = $mydata->get_current_link();
          $current  = ( $blog->userblog_id == MslsBlogCollection::instance()->get_current_blog_id() );
          $language_menu_item[] = array(
              "this_blog" => $current,
              "url" => $blog->siteurl,
              "language" => $language,
              "description" => $blog->get_description(),
              "lang_id" => $blog->get_alpha2()
          );
      }

      ?>
      <div id="languages-actions-container">
        <ul id="menu_languages">
          <?php 
          
            foreach($language_menu_item as $menu_item) {                
                if ($menu_item["this_blog"]) {
                    print("<li class=\"current_language\">" . $menu_item["lang_id"] . "</li>");
                } else {
                    print("<li><a href=\"" . $menu_item["url"] . "\" title=\"" . $menu_item["description"] . "\">" . $menu_item["lang_id"] . "</a></li>");
                }
            }
          ?>
         </ul>
      </div>
        
        <!-- starts login and register -->      
        <?php 
        wp_nav_menu(array(
            "theme_location" => "access",
            "depth" => 2,
            "container" => "ul",
            "menu_id" => "menu_login_register",
            "menu_class" => "login_menu",
            "walker" => new NAU_Walker_Access_Menu()
         )); 

        ?>  
        
        <!-- ends login and register -->     
        </div>  
  <!-- ends top nav action container --> 
    </div>    
  <!-- ends menu container -->     
  </div>
  <!-- ends branding container -->
  <div id="menu-overlay" onclick="closeNav()"></div>

<? } ?>