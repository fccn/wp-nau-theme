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
  $sliderPostID = url_to_postid( $item["course"] );

  $course = load_course(get_post($sliderPostID));

/*
  $course = [
    "name" => get_the_title($sliderPostID),
    "tagline" => get_custom_value('tagline', ""),
    "logo" => "https://webrtc-hub.fccn.pt/nau-php/assets/img/course-image-placeholder-logo-03.png",
    "image" => get_the_post_thumbnail_url( $sliderPostID, 'full' ),
    "video" => get_custom_value("youtube", "")
  ];
*/  

  $link = $item["course"];
  $opacity = $item["opacity"];
  $hue_rotate = $item["hue"];
  $back_color = $item["back-color"];
  
  $headline = ($item["primary-line"]!=""?$item["primary-line"]:$course["name"]);
  $text = ($item["secondary-line"]!=""?$item["secondary-line"]:$course["tagline"]);

  
?>  
<!-- SLIDE - ITEM - COURSE -->
  
            <div class="homepage-slider-course" style="background-color:<?=$back_color?>;">  
               <?php if ($link != "") { ?><a href="<?=$link?>"><?php } ?>
                  <div class="homepage-slide-item <?=$item["template"]?>">
                    <img data-u="image" data-src="<?=$course["image"]?>" />                
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
                    <div class="video-know-more-icons"> 
                        <? if ($course["youtube"]) { ?>
                        <!-- starts video icon -->                     
                            <a class="see-video-icon" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$course["youtube"]?>" }' title="<?=nau_trans("See video")?>">
                              <img class="clear-other-video-icon-style" src="assets/img/see-video-icon-white.svg">
                            </a> 
                        <? } ?>
                        <!-- starts know more icon -->
                        <?php if ($link != "") { ?>
                            <a class="know-more-icon" href="<?=$link?>" title="Know more"><?=nau_trans("Know +")?></a> 
                        <?php } ?>
                    </div>                    
                </div>               
            </div>  

        
<!-- -->        