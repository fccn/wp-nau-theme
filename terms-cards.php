  <?php
  
  global $course_list_title;
  
  global $post; 
 
  $terms = get_the_terms($post,'post_tag');
  $title = explode("|", $course_list_title);
    
  ?>   
  
  <!-- starts highlighted courses -->
  <section id="highlighted-courses" class="main-gallery">   
   <h2><?=$title[0]?> <span class="normal-font-weight"><?=$title[1]?></span></h2>       
    <div class="courses-wrap">    
    
    <? foreach ($terms as $termObj) { 
      $term = load_term($termObj);
    ?>
    
      <ul class="card gallery-cell term">
        <li class="image"> 
          <a href="<?=$term['url']?>" class="image image-link">
            <img class="course-image card-image" src="<?=$term['image']?>" alt="<?=$term['name']?>">
          </a>          
        </li>
        <li class="title">
          <h3><?=$term["name"]?>
        </li>
        <li class="excerpt">
          <p><?=$term["excerpt"]?>
        </li>
      </ul>
      
    <? } ?>
    
    </div>
  </section>    
  
  
  