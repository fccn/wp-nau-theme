<?php

use lloc\Msls\MslsBlogCollection;
use lloc\Msls\MslsOptions;

require('menu/menu_walker.php');

?>
  <div class="branding-top-nav">
    <a id="open-menu-arrow" href="javascript:void(0)" onclick="openNav(0)" title="<?=nau_trans("Open")?>">&#9776;</a>  
    <a href="<?=get_site_url()?>" class="logo"></a>

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
            <input id="search-input" name="s" type="search" placeholder="<?=nau_trans("Search courses...")?>" value="<?=get_search_query()?>">
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
        /*
        wp_nav_menu(array(
            "theme_location" => "access",
            "depth" => 2,
            "container" => "ul",
            "menu_id" => "menu_login_register",
            "menu_class" => "login_menu",
            "walker" => new NAU_Walker_Access_Menu()
         )); */ 
        ?>

<ul id="menu_login_register" class="login_menu"><li id="menu-item-4403" class="menu-item menu-item-type-custom menu-item-object-custom open-edx-link login_or_menu_openedx menu-item-type-wp-edunext-marketing-site menu-item-object-menu_openedx menu-item-has-children menu-item-4403">
<a href="https://lms.nau.edu.pt/dashboard" id="register">sandrocosta</a>

<ul class="sub-nav access-menu menu-depth-0">
<li id="menu-item-5158" class="menu-item menu-item-type-custom menu-item-object-custom open-edx-link resume_openedx menu-item-type-wp-edunext-marketing-site menu-item-object-resume_openedx menu-item-5158">
<a href="https://lms.nau.edu.pt/courses/course-v1:SSI+PMS+2021_T1/jump_to/block-v1:SSI+PMS+2021_T1+type@html+block@1064ac63e9a44b9d8b92428f2f664452" id="login_image">Continuar curso</a>
</li>
<li id="menu-item-5174" class="menu-item menu-item-type-custom menu-item-object-custom open-edx-link dashboard_openedx menu-item-type-wp-edunext-marketing-site menu-item-object-dashboard_openedx menu-item-5174">
<a href="https://lms.nau.edu.pt/dashboard" id="login_image">Meus cursos</a>
</li>
<li id="menu-item-4311" class="menu-item menu-item-type-custom menu-item-object-custom open-edx-link account_openedx menu-item-type-wp-edunext-marketing-site menu-item-object-account_openedx menu-item-4311">
<a href="https://lms.nau.edu.pt/account/settings" id="login_image">Conta</a>
</li>
<li id="menu-item-4310" class="menu-item menu-item-type-custom menu-item-object-custom open-edx-link profile_openedx menu-item-type-wp-edunext-marketing-site menu-item-object-profile_openedx menu-item-4310">
<a href="https://lms.nau.edu.pt/u/sandrocosta" id="login_image">Perfil</a>
</li>
</ul>
</li>
<li id="menu-item-1719" class="menu-item menu-item-type-custom menu-item-object-custom open-edx-link signout_openedx menu-item-type-wp-edunext-marketing-site menu-item-object-signout_openedx menu-item-1719">
<a href="https://lms.nau.edu.pt/logout" id="login_image">Sair</a>
</li>
</ul>
        
        <!-- ends login and register -->     
        </div>  
  <!-- ends top nav action container --> 
    </div>    
  <!-- ends menu container -->     
  </div>
  <!-- ends branding container -->
  <div class="menu-overlay" onclick="closeNav(0)"></div>
