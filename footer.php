<script>

/*
https://www.blogcyberini.com/2018/05/botao-para-compartilhamento-de-conteudo-facebook.html
*/
// Load lazilly the DOM
document.addEventListener("DOMContentLoaded", function() {            
    // change botton URL
    const shareButton = document.getElementById("share-button");
    if (shareButton != null) {
    	shareButton.setAttribute("rel", "nofollow");
    	shareButton.setAttribute("target", "_blank");
    	shareButton.href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
    }
}, false);
</script>
<? include "inc/cookie-bar.php"; ?>
<?php wp_footer(); ?>
</body>
</html>
