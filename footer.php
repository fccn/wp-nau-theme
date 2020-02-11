<footer> 
  <!-- starts footer links -->
  <section id="footer-links">
    <h3>Links</h3>
    <!-- starts quick links -->
    
    <div id="quicklinks">
    

<?php

class NAU_Walker_Footer_Nav_Menu extends Walker_Nav_Menu {      

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ($depth == 0) 
            $output .= "\n<li class='footer-links-structure'>\n<h5>" . $item->title . "</h5>";
        else
            $output .= "<li><a href='" . $item->url . "'>" . $item->title . "</a></li>";
    }    
    
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ($depth == 0) 
            $output .= "</li>";
        else
            $output .= "";
        
        $output .= "\n";
    }    

    function start_lvl( &$output, $depth = 0, $args = array() ) {        
         // Build HTML for output.
        $output .= "\n" . '<ul>' . "\n";
    }
};


wp_nav_menu(array(
        "theme_location" => "footer",
        "depth" => 2,        
        "menu_id" => "footer",
        "container" => "ul",
        "container_id" => "footer",
        "walker" => new NAU_Walker_Footer_Nav_Menu()
      )); 
      
?>
    
    <!-- starts social media -->
    <ul>
    <li class="footer-links-structure">
    <ul id="social-media">
      <li>
        <h5>Social Media</h5><br><br>
      </li>
      <li><a href="index.php"><img src="assets/img/twitter.svg" alt="twitter logo" title="Share on Twitter"></a></li>
      <li><a href="#"><img src="assets/img/linkedin.svg" alt="Linkedin logo" title="Share on Linkedin"></a></li>
      <li><a href="#"><img src="assets/img/facebook.svg" alt="Facebook logo" title="Share on Facebook"></a></li>
      <li><a href="#"><img src="assets/img/instagram.svg" alt="Instagram logo" title="Share on Instagram"></a></li>
      <li><a href="#"><img src="assets/img/more-share.svg" alt="Share list" title="Share list"></a></li>
      <li id="openedx-logo"><a href="https://open.edx.org/" target="_blank"><img src="assets/img/openedx.svg" alt="Powered by openedX" title="Visit openedX website"></a></li>
    </ul>
    </li>
    </ul>      
    <!-- ends social media -->     
    </div>
  </section>
  <!-- ends footer links -->   
  <!-- starts corporate entities -->
  <section id="quick-links">
    <h3>Entidades</h3>
    <ul>
      <li><a href="https://nau.edu.pt"><img src="assets/img/nau_sempre_aprender.svg" alt="Logo NAU" title="NAU - Sempre a Aprender"></a><br><br>
      <span id="copyright" >&copy; <?php echo date("Y")?> - FCT|FCCN. All rights reserved.</span>
      </li>
      <li><a href="https://www.fccn.pt/financiamento-projeto-nau/"><img src="<?=get_template_directory_uri()?>/assets/img/co-financed.png" alt="Logos: Compete, Portugal 2020 e União Europeia - Fundo Europeu de Desenvolvimento Regional"  title="Compete 2020, Portugal 2020 e União Europeia - Fundo Europeu de Desenvolvimento Regional"></a></li>
      <li><a href="https://www.incode2030.gov.pt/" target="_blank"><img src="assets/img/incode.png" alt="Portugal - INcode2030" title="Visit INcode2030 website"></a></li>  
    </ul>
  </section>
  <!-- ends corporate entities --> 
</footer>

</div>
<?php wp_footer(); ?>
</body>
</html>

