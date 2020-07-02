<?php
  global $post;
  $url = get_permalink($post->ID);
  
  
  $un_labels = [
    nau_trans("No goal"),
    nau_trans("No poverty") ,
    nau_trans("Zero hunger") ,
    nau_trans("Good health and well-being") ,
    nau_trans("Quality education") ,
    nau_trans("Gender equality") ,
    nau_trans("Clean water and sanitation") ,
    nau_trans("Affordable and clean energy") ,
    nau_trans("Decent work and economic growth") ,
    nau_trans("Industry, innovation and infrastructure") ,
    nau_trans("Reduced inequalities") ,
    nau_trans("Sustainable cities and communities") ,
    nau_trans("Responsible consuption") ,
    nau_trans("Climate action") ,
    nau_trans("Life below water") ,
    nau_trans("Life on land") ,
    nau_trans("Peace, justice and strong institutions") ,
    nau_trans("Partnerships for the goals") 
  ]
  
?>

<div class="un-menu">
  <span class="un-option" id="top">
    <img src="assets/img/sustainable-development-goals-logo.svg" class="un-option-icon">
  </span>

  <?
    for($medida = 1; $medida <= 17; $medida++) {
  ?>
    <span class="un-option">
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
    ?>
    <div class="un-course-item">
      <h2><a id="un-<?=$medida?>" href="<?=$url?>#top"><?=$un_labels[$medida]?></a></h2>
     
       <? nau_un_courses_gallery($medida); ?>
    </div>
    <?
  }

?>
</div>



