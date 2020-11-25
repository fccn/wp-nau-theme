    <footer> 
      <!-- starts footer links -->
      <section id="footer-links">        
        <!-- starts quick links -->
        
        <div id="quick-links-section">


        <?php if ( is_active_sidebar( 'footer_left_area' ) ) {
            dynamic_sidebar( 'footer_left_area' );
        } ?>

        <?php if ( is_active_sidebar( 'footer_center_area' ) ) {
            dynamic_sidebar( 'footer_center_area' );
        } ?>

        <?php if ( is_active_sidebar( 'footer_right_area' ) ) {
            dynamic_sidebar( 'footer_right_area' );
        } ?>

        <?php
        /*
        wp_nav_menu(array(
                "theme_location" => "footer",
                "depth" => 2,        
                "menu_id" => "footer-menu",
                "container" => "ul",
                "container_id" => "footer",
                "walker" => new NAU_Walker_Footer_Nav_Menu()
              )); 
        */      
        ?>
        



        <?
          $social_media = get_option( 'wpseo_social' ) // read from Yoast SEO > Social
        ?>

        <!-- starts social media -->
        <div class="footer-social">
        <span class="footer-title"><?=nau_trans("Social Media")?></span>
        <div id="social-media">
          <ul>
          <?php if ($social_media["twitter_site"]) { ?>
            <li class="social-media">
              <a href="https://twitter.com/<?=$social_media["twitter_site"]?>" target="_blank" title="<?=nau_trans("Share on Twitter")?>">
                <img src="assets/img/twitter.svg" alt="twitter logo" title="<?=nau_trans("Share on Twitter")?>">
              </a>
            </li>
          <?php } ?>

          <?php if ($social_media["linkedin_url"]) { ?>
            <li class="social-media">
              <a href="<?=$social_media["linkedin_url"]?>" target="_blank" title="<?=nau_trans("Share on Linkedin")?>">
                <img src="assets/img/linkedin.svg" alt="Linkedin logo" title="<?=nau_trans("Share on Linkedin")?>">
              </a>
            </li>
          <?php } ?>

          <?php if ($social_media["facebook_site"]) { ?>
            <li class="social-media">
              <a href="<?=$social_media["facebook_site"]?>" id="facebook-link" rel="nofollow" target="_blank" title="<?=nau_trans("Share on Facebook")?>">
                <img src="assets/img/facebook.svg" alt="Facebook logo" title="Share on Facebook">
              </a>
            </li>
          <?php } ?>

          <?php if ($social_media["instagram_url"]) { ?>
            <li class="social-media">
              <a href="<?=$social_media["instagram_url"]?>" target="_blank" title="<?=nau_trans("Share on Instagram")?>">
                <img src="assets/img/instagram.svg" alt="Instagram logo" title="<?=nau_trans("Share on Instagram")?>">
              </a>
            </li>
          <?php } ?>

          <?php if ($social_media["wikipedia_url"]) { ?>
            <li class="social-media">
              <a href="<?=$social_media["wikipedia_url"]?>" target="_blank">
                <img src="assets/img/more-share.svg" alt="Share list" title="Share list">
              </a>
            </li>
          <?php } ?>
          </ul>
          </div>

          <div id="openedx-logo">
            <a href="https://open.edx.org/" target="_blank">
              <img src="assets/img/openedx.svg" alt="Powered by OpenEdX" title="<?=nau_trans("Visit OpenEdX website")?>">
            </a>
          </div>    
        </div>
        <!-- ends social media -->     
        </div>
      </section>
      <!-- ends footer links -->
      
      <!-- starts corporate entities -->
      <section id="entities-quick-links">        
        <ul class="flex-row">
          <li><a href="https://nau.edu.pt"><img id="logo-nau" src="assets/img/nau_sempre_aprender.svg" alt="Logo NAU" title="NAU - Sempre a Aprender"></a>
          <span id="copyright" >&copy; <?php echo date("Y")?> - FCT|FCCN. <?=nau_trans("All rights reserved.")?></span>
          </li>
          <li><a id="logo-compete" href="https://www.fccn.pt/financiamento-projeto-nau/"><img src="<?=get_template_directory_uri()?>/assets/img/co-financed.png" alt="Logos: Compete, Portugal 2020 e União Europeia - Fundo Europeu de Desenvolvimento Regional"  title="Compete 2020, Portugal 2020 e União Europeia - Fundo Europeu de Desenvolvimento Regional"></a></li>
          <li><a id="logo-incode2030" href="https://www.incode2030.gov.pt/" target="_blank"><img src="assets/img/incode.png" alt="Portugal - INcode2030" title="<?=nau_trans("Visit INcode2030 website")?>"></a></li>  
        </ul>
      </section>
      <!-- ends corporate entities --> 
    </footer>

    <div class="video_modal">
       <button class="video_modal_close" onClick="closeVideo();">x</button>
       <div id="videoPlayer"></div>
    </div>

<? 
  if (current_user_can('administrator') && (WP_DEBUG == true)) {
      ?>
      <div class="debug_messages">
          <b>Course</b>
          <pre>
          <? global $course; print_r($course); ?>
          </pre>
          <hr>
          <b>Entity</b>
          <pre>
          <? global $entity; print_r($entity); ?>
          </pre>
          <hr>
          <b>Server</b>
          <pre>
          <? print_r($_SERVER) ?>
          </pre>
      </div>
      <?
  }
?>


