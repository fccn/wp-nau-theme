<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title() ?></title>

    <?php wp_head(); ?>

    <base href="<?=get_template_directory_uri()?>/">

    <!-- starts JS and CSS links --> 
    <!-- starts styles links -->
    <link rel="stylesheet" href="assets/css/reset.css" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css" media="screen">
    <link rel="stylesheet" href="style.css">
    <!-- ends styles links --> 

    <!-- starts google fonts links -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- ends google fonts links --> 

    <!-- starts JS funtions --> 
    <script src="assets/js/functions.js"></script> 
    <!-- ends JS funtions --> 
    <!-- ends JS and CSS links -->
</head>
