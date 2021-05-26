<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.1/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.1/cookieconsent.min.js"></script>

<script>
window.addEventListener("load", function(){
  let domainFirstDot = window.location.hostname.indexOf(".");
  // cookie domain stats with a domain for shared whildcard domains
  let cookiedomain = domainFirstDot > 0 ?  window.location.hostname.substring(domainFirstDot) : window.location.hostname;
  window.cookieconsent.initialise({

    window: '<div role="dialog" tabindex="-1" id="cookiepopup" aria-label="cookieconsent" class="cc-window {{classes}}"><!--googleoff: all-->{{children}}<!--googleon: all--></div>',

    palette:{
      popup: {background: "#eee", text: "#000"},
      button: {background: "#074CE1", text: "#ffffff"},
      highlight: {background: "#074CE1", border: '#f8e71c', text: "blue"},
    },
    "content": {
      "message": "<?= nau_trans('This website uses cookies to ensure you get the best experience on our website. If you continue browsing this site, we understand that you accept the use of cookies.'); ?>",
      "dismiss": "<?= nau_trans('Got it!'); ?>",
      "link": "<?= nau_trans('Learn more'); ?>",
      "href": "//www.nau.edu.pt/pt/legal/politica-de-privacidade/",
    },
    theme: "classic",
    "elements": {
        "dismiss": '<a aria-label="dismiss cookie message" id="dismiss" role=button tabindex="2" class="cc-btn cc-dismiss:focus">{{dismiss}}</a>',
    },
    "position": "top",
    "static": "true",
    cookie: {
      domain: cookiedomain
    }
  },
  function(popup){

    jQuery(".cc-window").on('keydown', function(event) {
      if (event.keyCode == 27 ){
        popup.close();
      } 
    });

    jQuery("#dismiss").on('keydown', function(event) {
      if (event.keyCode == 13 || event.keyCode == 32 ) {
        popup.onButtonClick(event);
      }
    });  
  });
});
</script>
