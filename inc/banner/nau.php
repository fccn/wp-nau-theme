<style>
    div#home-slider {
        height: 150px !important;
        background: url("<?=$image?>") no-repeat !important;
        background-size: cover !important;
        background-repeat: no-repeat  !important;
        background-position: 50% 50% !important;
    }

    div#home-slider .slider-mask {
      filter: hue-rotate(<?=$hue?>deg) opacity(<?=$opacity?>) grayscale(<?=$grayscale?>); 
      -webkit-filter: hue-rotate(<?=$hue?>deg) opacity(<?=$opacity?>) grayscale(<?=$grayscale?>); 
    }

    div#home-slider #slider-objects h1 {
      color: <?=$color?>;
    }
</style>

<section id="flexible-content-area"> 
  <div id="home-slider">        
    <div id="slider-objects">      
       <h1><?=$page_title?></h1>
    </div>
    <img src="assets/img/banner-shape-long-blue.svg" class="slider-mask">  
  </div>
</section>



