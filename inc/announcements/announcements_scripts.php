<?php

function setup_announcements_statics(){
    wp_enqueue_script('splide-js', get_template_directory_uri() . '/node_modules/@splidejs/splide/dist/js/splide.min.js', array(), version_id(), false);
    wp_enqueue_style('splide-style', get_template_directory_uri() . '/node_modules/@splidejs/splide/dist/css/splide.min.css', array(), version_id(), 'all');
}
add_action('wp_enqueue_scripts', 'setup_announcements_statics');

