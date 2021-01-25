<?

  $cookie_message = get_option("nau_cookie_message");

  if ($cookie_message == "") {
      $cookie_message = nau_trans("This site uses cookies (update this message on NAU Theme Options)!");
  }

  $nau_cookie_message_visible = get_option('nau_cookie_message_visible', 1)
?>      

<? if ($nau_cookie_message_visible == 1) { ?>
  <div id="cookie-notification" class="cookie-wrapper cookie" style="display: none;">    
    <div class="cookie-consent">
      <p><?=$cookie_message?></p>
      <a id="closeCookie" class="btn"><?=nau_trans("Accept")?></a>    
    </div>
  </div>
<? } ?>
