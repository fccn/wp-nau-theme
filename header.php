<!doctype html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title><?php echo $pageTitle ?></title>

      <?php wp_head(); ?>
      <base href="<?=get_template_directory_uri()?>/" target="_blank">
      
<!-- starts JS and CSS links --> 
<!-- starts styles links -->
<link rel="stylesheet" type="text/css" href="assets/css/reset.css" media="screen">
<link rel="stylesheet" type="text/css" href="assets/css/styles.css" media="screen">
<!-- ends styles links --> 

<!-- starts google fonts links -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
<!-- ends google fonts links --> 

<!-- starts JS funtions --> 
<script src="assets/js/functions.js"></script> 
<!-- ends JS funtions --> 
<!-- ends JS and CSS links -->
</head>

<body id="<?php echo $pageID?>" class="secondary-pages">
<!-- starts container -->
<div id="main-container">
<!-- starts branding container -->
<div id="branding-top-nav">
<a href="#"><img id="logo" width="190" src="assets/img/nau_sempre_aprender.svg" alt="NAU logo"></a> 

<!-- starts menu container -->
<div id="menu-container">

<!-- starts top nav menu --> 
<a id="close-menu-arrow" href="javascript:void()" onclick="closeNav()" title="Close">&#10005;</a> <a id="open-menu-arrow"  href="javascript:void()" onclick="openNav()" title="Open">&#9776;</a>
<div class="nav-icon"> </div>

<?php 


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
  <form id="search-form" action="#" method="post">
    <input name="search" type="search" placeholder="Procurar cursos">
    <input name="submit-search" type="submit">
  </form>
  <!-- ends top nav search bar -->
  
  <!-- starts menu languages --> 
  
  <div id="languages-actions-container">     
    <?php 
    
    wp_nav_menu(array(
        "theme_location" => "language",        
        "container" => "div",
        "menu_id" => "menu_languages",
      )); 
    
    ?>  
    <!---    
    <ul id="menu_languages">
      <li><a id="portuguese" href="#" title="Portuguese">PT</a></li>
      <li><a id="english" href="#" title="English"><span>|</span> EN</a></li>
    </ul>
    --->
    <!-- ends menu languages --> 
    
    <!-- starts login and register -->      
    <?php 
    
    wp_nav_menu(array(
        "theme_location" => "access",
        "container" => "ul",
        "menu_id" => "menu_login_register",
    )); 
    
    ?>  
<!--    
    <ul id="menu_login_register">
      <li><a id="register" href="#" title="Register">REGISTO</a></li>
      <li><a id="login_image" href="#" title="Login"><span>|</span> LOGIN</a></li>
    </ul>
--->    
    <!-- ends login and register -->     
  </div>
  </div>
</div>
</div>
<!-- ends top nav action container --> 
<!-- ends menu container --> 