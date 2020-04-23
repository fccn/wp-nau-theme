<?
    if ($image == "") {
      $image = "assets/img/sustainability-onu-circle.svg";
    }
  
    $colorVal = hexdec($color);
    $red = 0xFF & ($colorVal >> 0x10);
    $green = 0xFF & ($colorVal >> 0x8);
    $blue = 0xFF & $colorVal;
?>
<style>
#un-slider::before {
  position: absolute;
  content: "";  
  background-position: 750px -180px;
  background-size: 400px 400px;
  background-repeat: no-repeat;
  top: 0; left: 0;
  width: 100%; height: 100%;	
  filter: opacity(45%);  
  background-image: url(assets/img/sustainability-onu-circle.svg);	
}

#un-slider {
    position: relative;
	width: 100%;
	min-height: 280px;    
    z-index: 0;
}

#un-slider #slider-objects {		
	padding: 50px;
	min-height: 52px;
	background-color: rgba(<?=255-$red?>, <?=255-$green?>, <?=255-$blue?>,<?=$opacity?>);
}


#flexible-content-area {  
  height: 150px !important;
  background: url("<?=$image?>") no-repeat !important;
  background-size: cover !important;
  background-repeat: no-repeat  !important;
  background-position: 50% 50% !important;
}

div#un-slider #slider-objects h1 {
    color: <?=$color?>; 
}

</style>

<section id="flexible-content-area"> 
  <div id="un-slider">
    <div id="slider-objects">      
       <h1><?=$page_title?></h1>
    </div>
  </div>
</section>

