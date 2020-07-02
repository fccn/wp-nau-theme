<?  
/*  
Array
(
    [template] => link
    [backimage] => 1034
    [primary-line] => Projeto NAU
    [secondary-line] => Saiba mais sobre o Projeto NAU
    [item-link] => https://www.fccn.pt/financiamento-projeto-nau/
    [course] => 
    [news] => 
    [entity] => 
)
*/
  $opacity = 0.9;
  $hue_rotate = 0;
  $video = $item["video"]; 
  $headline = $item["primary-line"];
  $text = $item["secondary-line"];
  $opacity = $item["opacity"];
  $hue_rotate = $item["hue"];
  $back_color = $item["back-color"];
  
  $random_time = rand(0,5)*5;
?>  
<!-- SLIDE - ITEM - VIDEO -->

        <div class="homepage-slider-video" style="background-color:<?=$back_color?>;">  
          <?php if ($link != "") { ?><a href="<?=$link?>"><?php } ?>
              <div class="homepage-slide-item <?=$item["template"]?>">
                
                  <video class="slide-video" autoplay muted loop>
                    <source src="<?=$video["url"]?>#t=<?=$random_time?>" type="video/mp4">
                  </video>
                
                <div class="nau-logo-filter" style="filter: hue-rotate(<?=$hue_rotate?>deg) opacity(<?=$opacity?>);"></div>
                <div class="nau-slide-content">
                  <div class="nau-slider-label">
                    <h1><?=$headline?></h1>
                    <p><?=$text?></p>
                  </div>                    
                </div>
              </div>
           <?php if ($link != "") { ?></a><?php } ?>
        </div>
        
<!-- -->        