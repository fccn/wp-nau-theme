<?php

function register_knowledge_areas() {
    register_taxonomy('knowledge_area', 'page', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => nau_trans( 'Knowledge Area', 'nau-theme'),
            'singular_name' => nau_trans( 'Knowledge Area', 'nau-theme'),
            'search_items'      => nau_trans( 'Search Knowledge Areas', 'nau-theme' ),
            'all_items'         => nau_trans( 'All Knowledge Areas', 'nau-theme' ),
            'parent_item'       => nau_trans( 'Parent Knowledge Area', 'nau-theme' ),
            'parent_item_colon' => nau_trans( 'Parent Knowledge Area:', 'nau-theme' ),
            'edit_item'         => nau_trans( 'Edit Knowledge Area', 'nau-theme' ),
            'update_item'       => nau_trans( 'Update Knowledge Area', 'nau-theme' ),
            'add_new_item'      => nau_trans( 'Add New Knowledge Area', 'nau-theme' ),
            'new_item_name'     => nau_trans( 'New Knowledge Area Name', 'nau-theme' ),
            'menu_name'         => nau_trans( 'Knowledge Area', 'nau-theme' ),
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'knowledge-area'),
        'show_in_rest' => true
    ));
}

add_action( 'init', 'register_knowledge_areas' );

function list_knowledge_areas() {
    
    $terms = get_terms([
        'taxonomy' => 'knowledge_area',
        'hide_empty' => false,
        'lang' => pll_current_language(),
    ]);

    echo '<h2 class="knowledge-areas-title screen-reader-text">' . nau_trans('Knowledge Areas') . '</h2>';
    echo '<ul class="knowledge-areas-list">';
        foreach($terms as $term) {
            $term_print = '<li>';

            if ($term->count) {

                $term_print .= '<a class="courses-available" href="'.get_term_link($term->slug, 'knowledge_area').'">' . $term->name . '<span class="courses-available-count" title="' . nau_trans('Number of courses available') . '">' . $term->count . '</span></a>';
            } else {
                $term_print .= '<span class="courses-unavailable">' . $term->name . '</span>';
            }

            $term_print .= '</li>';

            echo $term_print;
        }
    echo '</ul>';
}

add_shortcode( 'list_knowledge_areas', 'list_knowledge_areas');