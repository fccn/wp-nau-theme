<?php

use lloc\Msls\MslsBlogCollection;
use lloc\Msls\MslsOptions;

require('menu/menu_walker.php');

?>
  <div class="branding-top-nav">
    <a id="open-menu-arrow" href="javascript:void(0)" onclick="openNav(0)" title="<?=nau_trans("Open")?>">&#9776;</a>  
    <a href="<?=get_site_url()?>" class="logo"><?=nau_trans("Homepage")?></a>

    <!-- starts menu container -->
    <div class="menu-container">

      <!-- starts top nav menu -->
      <a id="close-menu-arrow" href="javascript:void(0)" onclick="closeNav(0)" title="<?=nau_trans("Close")?>">&#10005;</a>
      <div class="nav-icon"></div>
      <?php 
          wp_nav_menu(array(
                  "theme_location" => "main",
                  "depth" => 2,
                  "container" => "ul",
                  "menu_id" => "about-categories-entities",
                  "menu_class" => "main-menu",
                  "walker" => new NAU_Walker_Main_Nav_Menu()
                )); 
      ?>  

      <!-- starts top nav action container -->
      <div id="actions_container"> 
  
          <!-- starts top nav search bar -->          
          <form id="search-form" action="<?php echo home_url(); ?>" role="search" method="get">
            <label id="search-form-label" for="search-input"><?=nau_trans("Search Courses")?></label>
            <input id="search-input" name="s" type="search" placeholder="<?=nau_trans("Search courses...")?>" value="<?=get_search_query()?>" aria-labelledBy="search-form-label" />
            <input name="submit-search" type="submit" value="<?=nau_trans("Search Courses")?>">
          </form>
          <!-- ends top nav search bar -->
      
      
      <? $nau_menu_languages = get_option('nau_menu_languages', 1) ?>
      <? if ($nau_menu_languages == 1) { ?>

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
      <? } ?>
        
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
  <div class="menu-overlay" onclick="closeNav(0)"></div>
