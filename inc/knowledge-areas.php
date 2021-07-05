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