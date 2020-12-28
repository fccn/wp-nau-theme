<?php

    $item = 1;
    $slider_itens = [];
            
    while(have_rows('homepage-slider-' . $item)) {
        the_row();
        $slider_itens[$item] = [
            "template" => get_sub_field('template'), 
            "backimage" => get_sub_field('backimage'),
            "primary-line" => get_sub_field('primary-line'),
            "secondary-line" => get_sub_field('secondary-line'),
            "item-link" => get_sub_field('link-external'),
            "course" => get_sub_field('link-internal-course'),
            "news" => get_sub_field('link-internal-news'),
            "entity" => get_sub_field('link-internal-entity'),
            "opacity" => get_sub_field('opacity'),
            "hue" => get_sub_field('hue'),
            "back-color" => get_sub_field('back-color'),
            "video" => get_sub_field('video')
        ];
        
        $item++;
    };
      
    if ($item > 1):
        
?>

<div id="home-slider">

    <div id="jssor-banner" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:560px;overflow:hidden;visibility:hidden;">
    
        <!-- Loading Screen -->
        <div data-u="loading" 
            class="jssorl-spin" 
            style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="assets/img/spin.svg" />
        </div>

        <!--
        <div 
          data-scale="0" 
          title="Mask" 
          class="nau-waves">
          <img src="assets/img/waves_all.svg" />
        </div>
        -->
        <div data-u="slides" class="homepage-slider" style="cursor:default;position:relative;top:0px;left:0px;overflow:hidden;">
           
        <?
            foreach($slider_itens as $item) {
              if ($item["template"] != "off") {
                include( "inc/slider/item-" . $item["template"] . ".php");
              }
            }
        ?>
           
        </div>
        
        
        <!-- Bullet Navigator -->
        
        <div data-u="navigator" class="jssorb132" style="position:absolute;bottom:24px;right:16px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i rating-star" style="width:12px;height:12px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1500;">
                    <circle class="b" cx="8000" cy="8000" r="5800" fill="#fff" color="#000"></circle>
                </svg>
            </div>
        </div>
                
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;z-index:1500;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>

        <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;z-index:1500;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>        
        
        
    </div>

</div>

<?

    endif;// There are Itens!

?>