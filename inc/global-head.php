<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title() ?></title>

    <?php wp_head(); ?>

    <base href="<?=get_template_directory_uri()?>/">

    <!-- starts JS and CSS links --> 

    <!-- starts google fonts links -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- ends google fonts links --> 

    <!-- starts JS funtions --> 
    <!-- see functions.php -->    
    <!-- ends JS funtions --> 
    <!-- ends JS and CSS links -->
    
    
    <? $gtag = get_option('nau_google_gtag') ?>
    
    <? if ($gtag != "") {?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122313510-5"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '<?=$gtag?>');
    </script>
    <? } ?>
    
    <? $facebook_pixel_id = get_option('nau_facebook_pixel'); ?>
    <? if ($facebook_pixel_id != "") { ?>
        <!-- Facebook Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '<?=$facebook_pixel_id?>');
          fbq('track', 'PageView');
        </script>
        <noscript>
          <img height="1" width="1" style="display:none" 
               src="https://www.facebook.com/tr?id=<?=$facebook_pixel_id?>&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
    <? } ?>

</head>
