
<section id="flexible-content-area"> 
  
  <!-- starts carrousel of banners -->
  <div id="home-slider"> 
  <ul class="banner-changing-slider">
          <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/slider-circle-button.svg" alt="change banner slider button"></li>
          <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/slider-circle-button.svg" alt="change banner slider button"></li>
          <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/slider-circle-button.svg" alt="change banner slider button"></li>
          <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/slider-circle-button-light.svg" alt="change banner slider button"></li> 
        </ul>
    <!-- starts banner search bar -->
    <div id="banner-search-form-container">      
      <form id="banner-search-form" action="<?php echo home_url(); ?>" role="search" method="get">
        <input id="s" name="s" type="search" placeholder="<?=_("Search Courses")?>" value="<?=get_search_query()?>">        
        <input name="submit-search" type="submit">
      </form>
    </div>
    <!-- ends banner search bar -->
    <div id="nau-shape">
      <h1>Sempre<br>
        <span>a aprender!</span></h1>
      <p>Inserir aqui descrição do projeto<br>
        em duas ou três linhas</p>
    </div>
  </div>
  <!-- ends carrousel of banners --> 
</section>