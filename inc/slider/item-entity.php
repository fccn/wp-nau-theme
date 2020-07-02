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
  $sliderPostID = url_to_postid( $item["entity"] );

  setup_postdata( $sliderPostID ); 

  $logo = get_field('square-logo', $sliderPostID);
  if ($logo == "") {
      $logo = get_field('logo', $sliderPostID);
  }

  $entity = [
    "name" => get_the_title($sliderPostID),
    "tagline" => get_field('sigla', $sliderPostID),
    "logo" => $logo,
    "image" => get_the_post_thumbnail_url( $sliderPostID, 'full' ),
    "sigla" => get_field("sigla", $sliderPostID),
    "video" => get_field("youtube", $sliderPostID),
  ];              
  
  $link = $item["entity"];
  $back_image = $entity["image"];  
  $headline = ($item["primary-line"]!=""?$item["primary-line"]:$entity["name"]);
  $text = ($item["secondary-line"]!=""?$item["secondary-line"]:$entity["tagline"]);
  $hue_rotate = $item["hue"];
  $back_color = $item["back-color"];
  
?>  
<!-- SLIDE - ITEM - ENTITY -->
  
            <div class="homepage-slider-entity" style="background-color:<?=$back_color?>;">  
              <?php if ($link != "") { ?><a href="<?=$link?>"><?php } ?>
                  <div class="homepage-slide-item <?=$item["template"]?>">
                    <img data-u="image" data-src="<?=$entity["image"]?>" />                
                    <div class="nau-logo-filter" style="filter: hue-rotate(<?=$hue_rotate?>deg) opacity(<?=$opacity?>);"></div>
                    <div class="nau-slide-content">
                      <div class="nau-slider-label">
                        <h1><?=$headline?></h1>
                        <p><?=$text?></p>
                      </div>
                    </div>                    
                  </div>
               <?php if ($link != "") { ?></a><?php } ?>
               <div class="homepage-slide-actions">
                     <div class="entity-logo">
                       <img src="<?=$entity["logo"]?>">
                     </div>
                    <div class="video-know-more-icons"> 
                        <!-- starts video icon -->                     
                        <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$entity["video"]?>" }' title="<?=nau_trans("See video")?>">
                          <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white.svg">
                        </a> 
                        <!-- starts know more icon -->
                        <?php if ($link != "") { ?>
                        <a class="know-more-icon" href="<?=$link?>" title="Know more"><?=nau_trans("Know +")?></a> 
                        <?php } ?>
                    </div>                    
              </div>               
            </div>  

        
<!-- -->        