<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title() ?></title>

    <?php wp_head(); ?>

    <base href="<?=get_template_directory_uri()?>/">

    <!-- starts JS and CSS links --> 

    <!-- starts google fonts links -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- ends google fonts links --> 

    <!-- starts JS funtions --> 
    <!-- see functions.php -->    
    <!-- ends JS funtions --> 
    <!-- ends JS and CSS links -->
    
    
    <? $gtag = get_option('nau_google_gtag') ?>
    <? $analytics = load_analytics() ?>
    
    <? if ($gtag != "") {?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122313510-5"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      <? if (!empty($analytics[0])) {?>
        gtag('set', {'dimension1': '<?= $analytics[0] ?>'}); 
      <? } ?>
      <? if (!empty($analytics[1])) {?>
        gtag('set', {'dimension2': '<?= $analytics[1] ?>'}); 
      <? } ?>
      <? if (!empty($analytics[2])) {?>
        gtag('set', {'dimension3': '<?= $analytics[2] ?>'}); 
      <? } ?>
      <? $course_id = load_course_id($page) ?>
      <? if (!empty($course_id)) {?>
        gtag('set', {'dimension4': '<?= $course_id ?>'}); 
      <? } ?>
      <? $course_name = get_course_name($page) ?>
      <? if (!empty($course_name)) {?>
        gtag('set', {'dimension5': '<?= $course_name ?>'}); 
      <? } ?>
      gtag('config', '<?=$gtag?>');
    </script>
    <? } ?>
    
    <? $facebook_pixel_id = get_option('nau_facebook_pixel'); ?>
    <? if (($facebook_pixel_id != "") && 0) { ?>
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

    <? $jira_widget_key = get_option('nau_confluence_widget_key') ?>
    <? if ($jira_widget_key != "") {?>
      <script data-jsd-embedded data-key="<?=$jira_widget_key?>" data-base-url="https://jsd-widget.atlassian.com" src="https://jsd-widget.atlassian.com/assets/embed.js"></script>

      <script>
        window.addEventListener("load", function(event) {

          function sleep(milliseconds) {
            const start = Date.now();
            while (Date.now() - start < milliseconds);
          }

          while(true) {
            let widgetElement = document.getElementById('jsd-widget');
            if (widgetElement) {
              widgetElement.setAttribute('title', 'Preciso de Ajuda');
              break;
            }
            sleep(50);
            console.log("AA");
          }
        });
      </script>
    <? } ?>
    
    <? $nau_extra_js = get_option('nau_extra_js') ?>
    <? if($nau_extra_js) {
       echo $nau_extra_js;  
    }
    ?>

</head>
