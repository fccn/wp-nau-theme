<?php

require('menu/menu_walker.php');

$lang = function_exists("pll_current_language") ? pll_current_language() : 'pt';
$header_img_src_array = [ 
  "pt" => get_stylesheet_directory_uri() . '/assets/img/nau_sempre_aprender.svg',
  // in future uncomment this line, when we have a new english NAU logo
  //"en" => get_stylesheet_directory_uri() . '/assets/img/nau_keep_learning.svg',
];
$header_img_src = @$header_img_src_array[$lang] ?: $header_img_src_array['pt'];

?>
  <div class="branding-top-nav">
    <a id="open-menu-arrow" href="javascript:void(0)" onclick="openNav(0)" title="<?=nau_trans("Open")?>">&#9776;</a>  
    <a href="<?=function_exists("pll_home_url") ? pll_home_url() : get_site_url()?>">
      <picture>
        <source media="(max-width: 768px)" srcset="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-nau-mobile.svg">
        <img class="logo" src="<?= $header_img_src ?>" alt="<?=nau_trans("Header logo alt")?>" title="<?=nau_trans("Homepage")?>" height="28px">
      </picture>
    </a>

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
          <form id="search-form" action="<?php echo home_url(); ?>" role="search" method="post">
            <label id="search-form-label" for="search-input"><?=nau_trans("Search Courses")?></label>
            <input id="search-input" name="s" type="search" placeholder="<?=nau_trans("Search courses...")?>"/>
            <input name="submit-search" type="submit" value="<?=nau_trans("Search Courses")?>">
          </form>
          <!-- ends top nav search bar -->
              
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
