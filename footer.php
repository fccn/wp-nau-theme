<script>

/*
https://www.blogcyberini.com/2018/05/botao-para-compartilhamento-de-conteudo-facebook.html
*/
//Constrói a URL depois que o DOM estiver pronto
document.addEventListener("DOMContentLoaded", function() {            
    //altera a URL do botão
    document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
}, false);
</script>
<?php wp_footer(); ?>
</body>
</html>
