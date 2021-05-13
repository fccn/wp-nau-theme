<?php

/* Loads post content into the sliders
 * Use WP_Query to fetch all announcements
 * Limit to the current language by taxonomy (pt | en)
 * Optional labels by area
 */

function get_announcements() {
    // get the current polylang language. If polylang is not defined, language is set to default.
    
    $default_language = 'pt';
    $language = function_exists('pll_current_language')? pll_current_language() : $default_language;
    
    $args = array(
        'post_type' => 'announcements',
        'tax_query' => array(
            array (
                'taxonomy' => 'languages',
                'field' => 'slug',
                'terms' => $language,
            )
        ),
    );

    return new WP_Query($args);
}