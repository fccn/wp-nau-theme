  <?php
  
  global $course_list_title;
  
  global $post; 
 
  $terms = get_the_terms($post,'post_tag');
  $title = explode("|", $course_list_title);
    
  ?>   
  
  <!-- starts highlighted courses -->
  <section id="highlighted-courses" class="main-gallery">   
   <h2><?php echo $title[0]?> <span class="normal-font-weight"><?php echo $title[1]?></span></h2>       
    <div class="gallery term-gallery">
    
    <? foreach ($terms as $termObj):
      $term = load_term($termObj);
    ?>
    
      <div class="card term">
        <div class="image"> 
          <a href="<?php echo $term['url']?>" class="image image-link">
            <img class="card-image" src="<?php echo $term['image']?>" alt="<?php echo $term['name']?>">
          </a>          
        </div>
        <div class="title">
          <h3><?php echo $term["name"]?>
        </div>
        <div class="excerpt">
          <p><?php echo $term["excerpt"]?>
        </div>
      </div>
      
    <? endforeach; ?>
    
    </div>
  </section>    
  
  
  