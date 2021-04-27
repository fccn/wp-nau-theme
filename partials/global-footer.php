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

        <?
          $social_media = get_option( 'wpseo_social' ) // read from Yoast SEO > Social
        ?>

        <!-- starts social media -->
        <div class="footer-social">
        <span class="footer-title"><?=nau_trans("Social Media")?></span>
        <div id="social-media">
          <ul>
            
            <?php if (get_option('nau_subscribe_newsletter_link')) { ?>
              <li class="social-media">
                <a href="<?=get_option('nau_subscribe_newsletter_link')?>" title="<?=nau_trans("Subscribe newsletter")?>">
                  <i class="material-icons">email</i>
                </a>
              </li>
            <?php } ?>

            <?php if ($social_media["facebook_site"]) { ?>
              <li class="social-media">
                <a href="<?=$social_media["facebook_site"]?>" id="facebook-link" rel="noopener noreferrer nofollow" target="_blank" title="<?=nau_trans("Share on Facebook")?>">
                  <img src="assets/img/facebook.svg" alt="Facebook logo" title="Share on Facebook">
                </a>
              </li>
            <?php } ?>
            
            <?php if ($social_media["twitter_site"]) { ?>
              <li class="social-media">
                <a href="https://twitter.com/<?=$social_media["twitter_site"]?>" rel="noopener noreferrer nofollow" target="_blank" title="<?=nau_trans("Share on Twitter")?>">
                  <img src="assets/img/twitter.svg" alt="twitter logo" title="<?=nau_trans("Share on Twitter")?>">
                </a>
              </li>
            <?php } ?>

            <?php if ($social_media["linkedin_url"]) { ?>
              <li class="social-media">
                <a href="<?=$social_media["linkedin_url"]?>" rel="noopener noreferrer nofollow" target="_blank" title="<?=nau_trans("Share on Linkedin")?>">
                  <img src="assets/img/linkedin.svg" alt="Linkedin logo" title="<?=nau_trans("Share on Linkedin")?>">
                </a>
              </li>
            <?php } ?>

            <?php if ($social_media["instagram_url"]) { ?>
              <li class="social-media">
                <a href="<?=$social_media["instagram_url"]?>" rel="noopener noreferrer nofollow" target="_blank" title="<?=nau_trans("Share on Instagram")?>">
                  <img src="assets/img/instagram.svg" alt="Instagram logo" title="<?=nau_trans("Share on Instagram")?>">
                </a>
              </li>
            <?php } ?>

            <?php if ($social_media["wikipedia_url"]) { ?>
              <li class="social-media">
                <a href="<?=$social_media["wikipedia_url"]?>" rel="noopener noreferrer nofollow" target="_blank">
                  <img src="assets/img/more-share.svg" alt="Share list" title="Share list">
                </a>
              </li>
            <?php } ?>
          </ul>
          </div>

          <div id="openedx-logo">
            <a href="https://open.edx.org/" rel="noopener noreferrer nofollow" target="_blank">
              <img src="assets/img/edx-openedx-logo.png" alt="Powered by OpenEdX" title="<?=nau_trans("Visit OpenEdX website")?>">
            </a>
          </div>    
        </div>
        <!-- ends social media -->     
        </div>
      </section>
      <!-- ends footer links -->
      
      <!-- starts corporate entities -->
      <section id="entities-quick-links">
      <!--
        <ul class="flex-row">
          <li><a href="https://nau.edu.pt"><img id="logo-nau" src="assets/img/nau_sempre_aprender.svg" alt="Logo NAU" title="NAU - Sempre a Aprender"></a>
          </li>
          <li><a id="logo-compete" href="https://www.fccn.pt/financiamento-projeto-nau/"><img src="<?=get_template_directory_uri()?>/assets/img/co-financed.png" alt="Logos: Compete, Portugal 2020 e União Europeia - Fundo Europeu de Desenvolvimento Regional"  title="Compete 2020, Portugal 2020 e União Europeia - Fundo Europeu de Desenvolvimento Regional"></a></li>
          <li><a id="logo-incode2030" href="https://www.incode2030.gov.pt/" target="_blank"><img src="assets/img/incode.png" alt="Portugal - INcode2030" title="<?=nau_trans("Visit INcode2030 website")?>"></a></li>  
        </ul>
-->
        <?php if ( is_active_sidebar( 'footer_entity_logos' ) ) {
            dynamic_sidebar( 'footer_entity_logos' );
        } ?>
      </section>
      <section class="site-copyright">
        <div class="site-copyright--nau">
        <span>&copy; <?php echo date("Y");?> - FCT|FCCN<br>Todos os direitos reservados.</span>
        </div>
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
      <a href="javascript:void(0);" onclick="visibilityToogle('footer_debug_messages');">Toogle debug info</a>
      <div class="debug_messages" id="footer_debug_messages" style="display: none;">
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


