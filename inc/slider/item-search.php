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
  $link = $item["item-link"];
  $back_image = wp_get_attachment_image_src($item["backimage"], "full")[0];
  $headline = $item["primary-line"];
  $text = $item["secondary-line"];
  $opacity = $item["opacity"];
  $hue_rotate = $item["hue"];
  $back_color = $item["back-color"];
?>  
<!-- SLIDE - ITEM - SEARCH -->


        <div style="background-color:<?=$back_color?>;">
          <div class="homepage-slide-item <?=$item["template"]?>">
            <img data-u="image" data-src="<?=$back_image?>" />                
            <div class="nau-logo-filter" style="filter: hue-rotate(<?=$hue_rotate?>deg) opacity(<?=$opacity?>);"></div>
              <div class="nau-slide-content">
                <div id="banner-search-form-container">                  
                   <form id="banner-search-form" action="<?php echo home_url(); ?>" role="search" method="get">
                     <input id="s" name="s" type="search" placeholder="<?=__("Search Courses")?>" value="<?=get_search_query()?>">        
                     <input name="submit-search" type="submit">
                   </form>
                </div>
            
                <div class="nau-slider-label">
                  <h1><?=$headline?></h1>
                 <p><?=$text?></p>
                </div>
              </div>
          </div>
        </div>
        
<!-- -->        