<?php /* Template Name: News List */ ?>

<?php 
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  get_header(); 
?>

<?php

  if( has_post_thumbnail() ) {
    $url = get_the_post_thumbnail_url();
  } else {
    $url = "assets/img/banner-01.jpg";
  }; 
    
  $color = get_custom_value('banner-color', 'black'); 
  
?>

<style>
body#secondary div#text-banner {
    background: transparent url("<?=$url?>") no-repeat 0 -74px !important;   
}    
</style>

<!-- starts page header -->
<section id="flexible-content-area"> 
  
  <!-- starts carrousel of banners -->
  <div id="text-banner" style="max-height: 150px;">
  
  
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 700.4 459" xml:space="preserve"
     preserveAspectRatio="xMidYMin slice"
     style="height: 100%; overflow: visible">
<style type="text/css">
	.st2{opacity:0.10;fill:<?=$color?>;enable-background:new    ;}
	.st3{opacity:0.60;fill:#FFFFFF;enable-background:new    ;}
</style>
<g id="Group_237" transform="translate(166.37 -191.64)">
	<path id="Path_116" class="st2" d="M534.1,623.2c-27.1-5.8-55.1-43.7-55.1-95.4h0l0-183.8c0-64-40.6-121.9-101.6-141.2
	c-22.4-7.1-45.7-10.7-69.1-10.7l0,0h-474.6v459h700.4V623.2z"/>
	<path id="Path_117" class="st3" d="M479,527.9L479,527.9l0-183.8c0-64-40.6-121.9-101.6-141.2c-70-22.2-146.3-9.5-205.4,34
c0.3,0.4,0.3,0.4,0,0c-22.3-28.3-56.4-44.8-92.4-44.8H5.3V220c27.1,5.8,55.1,43.7,55.1,95.4l0,0l0,183.8
c0,64,40.6,121.9,101.6,141.3c70,22.2,146.4,9.5,205.5-34.2c22.3,28.3,56.3,44.8,92.3,44.9h74.3v-27.9
C507,617.4,479,579.5,479,527.9 M351.2,579.3c-10,2.6-20.3,3.8-30.6,3.8c-68,0-123.1-44.1-123.1-112.1l0,0V310
c0-15.9-3.2-31.5-9.4-46.1l0,0c10-2.6,20.3-3.9,30.6-3.9c68,0,123.2,44.1,123.2,112.1h0v161.2c0,15.9,3.2,31.7,9.5,46.4
L351.2,579.3"/>
</g>
</svg>
  </div>  
  <!-- ends carrousel of banners --> 
</section>

<div id="body-content"> 
  <article>
  
  <h1><?= get_post_field('post_title', $pageID) ?></h1>
  
  <?= do_shortcode(get_post_field('post_content', $pageID)) ?>
  
  <?=nau_list_news()?>


<?php 
# comments_template(); 
?>

  </article>
</div>
<!-- ends homepage body content --> 

<?php
  get_template_part( "global", "footer" );
?>
<?php get_footer(); ?>
