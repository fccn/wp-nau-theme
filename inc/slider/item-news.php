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
  $sliderPostID = url_to_postid( $item["news"] );

  setup_postdata( $sliderPostID ); 

  $article = [
    "name" => get_the_title($sliderPostID),
    "tagline" => get_custom_value('tagline', "", $sliderPostID),    
    "logo" => "https://webrtc-hub.fccn.pt/nau-php/assets/img/course-image-placeholder-logo-03.png",
    "image" => get_the_post_thumbnail_url( $sliderPostID, 'full' ),
    "video" => get_custom_value("youtube", "", $sliderPostID),
    "small_description" => get_the_excerpt($sliderPostID),
  ];              
  
  $opacity = 0.9;
  $hue_rotate = 0;
  $link = $item["news"];
  $back_image = $article["image"];
  $headline = ($item["primary-line"]!=""?$item["primary-line"]:$article["name"]);
  $text = ($item["secondary-line"]!=""?$item["secondary-line"]:"");
  $opacity = $item["opacity"];
  $hue_rotate = $item["hue"];
  $back_color = $item["back-color"];
  
  $text = str_replace("{sinopsys}", $article["small_description"], $text);
  
?>  
<!-- SLIDE - ITEM - NEWS -->
  
            <div class="homepage-slider-news" style="background-color:<?=$back_color?>;">  
              <?php if ($link != "") { ?><a href="<?=$link?>"><?php } ?>
                  <div class="homepage-slide-item <?=$item["template"]?>">
                    <img data-u="image" data-src="<?=$article["image"]?>" />                
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
               
               <? if ($article["youtube"] != "") { ?>
                    <div class="video-know-more-icons"> 
                        <!-- starts video icon -->                     
                        <a class="see-video-icon" href="#" onClick='openYoutubeVideoIFrame(this);' data-vars='{ "id" : "<?=$article["video"]?>" }' title="<?=nau_trans("See video")?>">
                            <svg version="1.1" id="video-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 34 34" style="enable-background:new 0 0 34 34;" xml:space="preserve">
                              <g>
                                <g id="Path_19" transform="translate(0 0)">
                                  <path class="icon-video-triangle" d="M17,0.2c9.3,0,16.8,7.5,16.8,16.8S26.3,33.8,17,33.8S0.2,26.3,0.2,17C0.2,7.7,7.7,0.2,17,0.2
                                C17,0.2,17,0.2,17,0.2z"/>
                                  <path class="icon-video-circle" d="M17,2C13,2,9.2,3.5,6.4,6.4S2,13,2,17s1.6,7.8,4.4,10.6S13,32,17,32s7.8-1.6,10.6-4.4S32,21,32,17
                                s-1.6-7.8-4.4-10.6S21,2,17,2 M17,0.2c9.3,0,16.8,7.5,16.8,16.8S26.3,33.8,17,33.8S0.2,26.3,0.2,17S7.7,0.2,17,0.2z"/>
                                </g>
                                <g id="Polygon_1" transform="translate(23.1 12.239) rotate(90)">
                                  <path class="icon-video-circle" d="M8,8.1H1.5l3.3-6.6L8,8.1z"/>
                                  <path class="icon-video-circle" d="M4.8,3.2L2.7,7.3h4.1L4.8,3.2 M4.8-0.2l4.5,9h-9L4.8-0.2z"/>
                                </g>
                              </g>
                            </svg>
                        </a> 
                    </div>  
               <? } ?>
                    <div class="action-know-more">
                        <!-- starts know more icon -->
                        <? if ($link != "") { ?>
                        <a class="know-more-icon" href="<?=$link?>"><?=nau_trans("Read More")?></a> 
                        <? } ?>
                    </div>                    
              </div>               
            </div>  

        
<!-- -->        