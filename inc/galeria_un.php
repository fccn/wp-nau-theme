<?php
  global $post;
  $url = get_permalink($post->ID);
  
  
  $un_labels = [
    __("No goal"),
    __("No poverty") ,
    __("Zero hunger") ,
    __("Good health and well-being") ,
    __("Quality education") ,
    __("Gender equality") ,
    __("Clean water and sanitation") ,
    __("Affordable and clean energy") ,
    __("Decent work and economic growth") ,
    __("Industry, innovation and infrastructure") ,
    __("Reduced inequalities") ,
    __("Sustainable cities and communities") ,
    __("Responsible consuption") ,
    __("Climate action") ,
    __("Life below water") ,
    __("Life on land") ,
    __("Peace, justice and strong institutions") ,
    __("Partnerships for the goals") 
  ]
  
?>

<div class="un-menu">
  <span class="un-option" id="top">
    <img src="assets/img/sustainable-development-goals-logo.svg" class="un-option-icon">
  </span>

  <?
    for($medida = 1; $medida <= 17; $medida++) {
  ?>
    <span class="un-option" id="top">
      <a class="un-option-link" href="<?=$url?>#un-<?=$medida?>">
        <img src="assets/img/sustainability-onu-<?=$medida?>.svg" id="icon-<?=$medida?>" class="un-option-icon">
      </a>
    </span>
  <?
    }
  ?>
</div>


<div class="un-course-list">
<?

  for($medida = 1; $medida <= 17; $medida++) {
     print("<h2><a id=\"un-$medida\" href=\"$url#top\">" . $un_labels[$medida] . "</a></h2>");
     nau_un_courses_gallery($medida);
  }

?>
</div>