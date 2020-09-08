<script>

/*
https://www.blogcyberini.com/2018/05/botao-para-compartilhamento-de-conteudo-facebook.html
*/
// Load lazilly the DOM
document.addEventListener("DOMContentLoaded", function() {            
    // change botton URL
    const facebookShareButton = document.getElementById("facebook-share-btt");
    if (facebookShareButton != null) {
    	facebookShareButton.href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
    }
}, false);
</script>
<? include "inc/cookie-bar.php"; ?>
<?php wp_footer(); ?>
</body>
</html>
