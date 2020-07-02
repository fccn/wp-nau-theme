  <?php
  
  global $course_list_title;
  
  global $post; 
 
  $terms = get_the_terms($post,'post_tag');
  $title = explode("|", $course_list_title);
    
  ?>   
  
  <!-- starts highlighted courses -->
  <section id="highlighted-courses" class="main-gallery">   
   <h2><?=$title[0]?> <span class="normal-font-weight"><?=$title[1]?></span></h2>       
    <div class="gallery term-gallery">
    
    <? foreach ($terms as $termObj) { 
      $term = load_term($termObj);
    ?>
    
      <div class="card term">
        <div class="image"> 
          <a href="<?=$term['url']?>" class="image image-link">
            <img class="card-image" src="<?=$term['image']?>" alt="<?=$term['name']?>">
          </a>          
        </div>
        <div class="title">
          <h3><?=$term["name"]?>
        </div>
        <div class="excerpt">
          <p><?=$term["excerpt"]?>
        </div>
      </div>
      
    <? } ?>
    
    </div>
  </section>    
  
  
  