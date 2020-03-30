<?php /* Template Name: Course About Page */ ?>
<?php 
  $nauPageID = "secondary";
  $nauBodyClass = "class='secondary-pages'";
  get_header(); 
?>

<?php get_header(); ?>

<!-- starts Homepage grey menu opacity overlay when user click on menu button -->
<div id="menu-overlay"></div>
<!-- ends Homepage grey menu opacity overlay when user click on menu button --> 
<!-- starts homepage header -->
<section id="flexible-content-area"> 
  
  <!-- starts carrousel of banners -->
  <div id="home-slider">
    <div id="nau-shape"> <img id="secondary-course-logo" src="assets/img/ina.png" alt="INA">
      <h1>RGPD Para Cidadão Atentos - Uso Responsável do Medicamento</h1>
      <!-- starts video and know more icons, rating and certficate status -->
      <div class="video-know-more-icons"> <a href="#" class="banner-entity" title="Know more about this entity">INA</a><br>
        <ul class="aside-rating-star">
          <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star.svg" alt="course rating star"></li>
          <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star.svg" alt="course rating star"></li>
          <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star.svg" alt="course rating star"></li>
          <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star.svg" alt="course rating star"></li>
          <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star-light.svg" alt="course rating star"></li>
          <li id="number-of-participants">1300 Participantes</li>
        </ul>
        <ul class="aside-course-status">
          <li id="course-status" class="aside-course-state"><span>Aberto</span> em perman&ecirc;ncia</li>
          <li class="price-and-certificate-options"><span class="aside-course-price">€200</span> | <span class="aside-certificate-options">Certificado</span></li>
        </ul>
        <!-- starts video icon --> 
        <a class="see-video-icon" href="#" title="See video">
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
        <!-- starts know more icon, rating and certficate status --> 
        <a class="know-more-icon" href="#" title="Know more">Iniciar</a> 
        <!-- ends video and know more icons --> 
      </div>
    </div>
  </div>
  <!-- ends carrousel of banners --> 
</section>
<!-- starts homepage body content -->
<div id="body-content"> 
  
  <!-- starts article -->
  <article>
    
    <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
 
            // Include the page content template.
            get_template_part( 'template-parts/content', 'page' );
 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
 
            // End of the loop.
        endwhile;
        ?>
  
  
    <h2>Abriram as matrículas do curso Uso Seguro e Responsável do Medicamento</h2>
    <p> Os medicamentos existem para ajudar a prevenir e a tratar doenças, e, portanto, podemos dizer que estes contribuem para uma maior qualidade de vida. Mas será que todos nós conhecemos bem os medicamentos que tomamos e os utilizamos da forma mais correta? Certamente todos temos dúvidas quando começamos a pensar nestas e noutras questões. Ao longo deste curso terá a oportunidade de</p>
    <h3>Porque devo realizar este curso</h3>
    <ul>
      <li>Definir o que é o medicamento</li>
      <li>Diferenciar um medicamento genérico de um medicamento de marca</li>
      <li>Enumerar os 10 passos para o uso seguro do medicamento</li>
      <li>Reconhecer a importância da adesão à terapêutica</li>
      <li>Indicar os cuidados a ter com os medicamentos fora de prazo ou não utilizados</li>
    </ul>
    <h3>Porque devo realizar este curso?</h3>
    <p>Os medicamentos existem para ajudar a prevenir e a tratar doenças, e, portanto, podemos dizer que estes contribuem para uma maior qualidade de vida. Mas será que todos nós conhecemos bem os medicamentos que tomamos e os utilizamos da forma mais correta? Certamente todos temos dúvidas quando começamos a pensar nestas e noutras questões. Ao longo deste curso terá a oportunidade de:</p>
    <ul>
      <li>Definir o que é o medicamento</li>
      <li>Diferenciar um medicamento genérico de um medicamento de marca</li>
      <li>Entidades
        <ul>
          <li>Diferenciar um medicamento genérico</li>
          <li>Diferenciar um medicamento genérico</li>
          <li>Diferenciar um medicamento genérico</li>
          <li>Diferenciar um medicamento genérico</li>
        </ul>
      </li>
      <li>Enumerar os 10 passos para o uso seguro do medicamento</li>
      <li>Reconhecer a importância da adesão à terapêutica</li>
      <li>Indicar os cuidados a ter com os medicamentos fora de prazo ou não utilizados</li>
    </ul>
    <h3>Porque devo realizar este curso?</h3>
    <img src="assets/img/secondary-image-place-holder.png" alt="Some alternative image reference here"> <small><i>Image description</i></small><br>
    <h3>Porque devo realizar este curso</h3>
    <p>Os medicamentos existem para ajudar a prevenir e a tratar doenças, e, portanto, podemos dizer que estes contribuem para uma maior qualidade de vida. Mas será que todos nós conhecemos bem os medicamentos que tomamos e os utilizamos da forma mais correta? Certamente todos temos dúvidas quando começamos a pensar nestas e noutras questões. Ao longo deste curso terá a oportunidade de:</p>
    <ul>
      <li>Definir o que é o medicamento</li>
      <li>Diferenciar um medicamento genérico de um medicamento de marca</li>
      <li>Enumerar os 10 passos para o uso seguro do medicamento</li>
      <li>Reconhecer a importância da adesão à terapêutica</li>
      <li>Indicar os cuidados a ter com os medicamentos fora de prazo ou não utilizados</li>
    </ul>
    <q>Os medicamentos existem para ajudar a prevenir e a tratar doenças, e, portanto, podemos dizer que estes contribuem para uma maior qualidade.</q>
    <p>Os medicamentos existem para ajudar a prevenir e a tratar doenças, e, portanto, podemos dizer que estes contribuem para uma maior qualidade de vida. Mas será que todos nós conhecemos bem os medicamentos que tomamos e os utilizamos da forma mais correta? Certamente todos temos dúvidas quando começamos a pensar nestas e noutras questões. Ao longo deste curso terá a oportunidade de:</p>
    <p>Os medicamentos existem para ajudar a prevenir e a tratar doenças, e, portanto, podemos dizer que estes contribuem para uma maior qualidade de vida. Mas será que todos nós conhecemos bem os medicamentos que tomamos e os utilizamos da forma mais correta? Certamente todos temos dúvidas quando começamos a pensar nestas e noutras questões. Ao longo deste curso terá a oportunidade de:</p>
    <hr/>
    <h3>Porque devo realizar este curso</h3>
    <p>Os medicamentos existem para ajudar a prevenir e a tratar doenças, e, portanto, podemos dizer que estes contribuem para uma maior qualidade de vida. Mas será que todos nós conhecemos bem os medicamentos que tomamos e os utilizamos da forma mais correta? Certamente todos temos dúvidas quando começamos a pensar nestas e noutras questões. Ao longo deste curso terá a oportunidade de:</p>
    <ul>
      <li>Definir o que é o medicamento</li>
      <li>Diferenciar um medicamento genérico de um medicamento de marca</li>
      <li>Entidades
        <ul>
          <li>Diferenciar um medicamento genérico</li>
          <li>Diferenciar um medicamento genérico</li>
          <li>Diferenciar um medicamento genérico</li>
          <li>Diferenciar um medicamento genérico</li>
        </ul>
      </li>
      <li>Enumerar os 10 passos para o uso seguro do medicamento</li>
      <li>Reconhecer a importância da adesão à terapêutica</li>
      <li>Indicar os cuidados a ter com os medicamentos fora de prazo ou não utilizados</li>
    </ul>
    <h4>Cursos disponiveis:</h4>
    <table>
      <tr>
        <th><strong>Curso A</strong></th>
        <th><strong>Curso B</strong></th>
        <th><strong>Curso C</strong></th>
        <th><strong>Curso D</strong></th>
      </tr>
      <tr>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
      </tr>
      <tr>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
      </tr>
      <tr>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
      </tr>
      <tr>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
        <td>Descri&ccedil;&atilde;o</td>
      </tr>
    </table>
  </article>
  <!-- ends article --> 
  
  <!-- starts aside course info -->
  <aside>
    <h3><span class="blue-vertical-line">|</span> RGPD Para Cidadãos  Atentos - Uso Responsável do Medicamento</h3>
    <ul class="aside-price-and-certificate-options">
      <li class="aside-institution"><a href="#" class="banner-entity" title="Know more about this entity">INA</a></li>
      <li class="price-and-certificate-options"><span class="aside-course-price">€200</span> | <span class="aside-certificate-options">Certificado</span></li>
    </ul>
    <ul class="aside-rating-star">
      <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star.svg" alt="course rating star"></li>
      <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star.svg" alt="course rating star"></li>
      <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star.svg" alt="course rating star"></li>
      <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star.svg" alt="course rating star"></li>
      <li><img onclick="someFunctionHere()" class="rating-star" src="assets/img/rating-star-light.svg" alt="course rating star"></li>
      <li id="number-of-participants">1300 Participantes</li>
      <li id="course-status" class="aside-course-state"><span>Aberto</span> em perman&ecirc;ncia</li>
    </ul>
    <img class="un-icons" src="assets/img/un-link-03.svg" alt="some alternative text here">
    <iframe class="un-icons" src="https://www.youtube-nocookie.com/embed/6DEd3S3ANVI"  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <ul class="course-related-links">
      <li id="course-code" class="course-details"><a href="#" target="_self">C&oacute;digo do curso<span class="aside-course-details">URM 101</span></a></li>
      <li id="starting-date" class="course-details"><a href="#" target="_self">In&iacute;cio do curso <span class="aside-course-details">22.01.2020</span></a></li>
      <li id="estimated-effort" class="course-details"><a href="#" target="_self">Esfor&ccedil;o estimado<span class="aside-course-details">3 horas</span></a></li>
      <li id="explore-courses" class="course-details right-arrow"><a href="#" target="_self">Cursos relacionados</a></li>
      <li id="explore-all-courses" class="course-details right-arrow"><a href="#" target="_self">Explorar todos os cursos</a></li>
      <li id="contact-email" class="course-details right-arrow"><a href="#" target="_self">E-mail</a></li>
      <li id="contact-website" class="course-details right-arrow"><a href="#" target="_self">Website</a></li>
      <li id="contact-telephone" class="course-details right-arrow"><a href="tel:+3512145678978" target="_self">+351 21 456 789 78</a></li>
      <li class="share-and-start-course">
          <ul>
              <li class="share-course"><a href="#">Partilhar</a></li>
              <li class="start-course"><a href="#" class="know-more-icon">Iniciar</a></li>
          </ul>
      </li>
    </ul>
  </aside>
  <!-- ends aside course info --> 
  
</div>
<!-- ends homepage body content --> 

<!-- starts homepage footer -->
<?php get_footer(); ?>
