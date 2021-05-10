<?php

function register_announcements_posttype() {
    register_post_type( 'announcements', 
        array(
            'labels' => array(
                'name' => __('Announcements', 'nau-theme'),
                'singular_name' => __('Announcement', 'nau-theme'),
                'add_new' => __('Add New', 'nau-theme'),
                'add_new_item' => __('Add New Announcement', 'nau-theme'),
                'new_item' => __('New Announcement', 'nau-theme'),
                'edit_item' => __('Edit Announcement', 'nau-theme'),
                'view_item' => __('View Announcement', 'nau-theme'),
                'all_items' => __('All Announcements', 'nau-theme'),
                'not_found' => __('No Announcements found.', 'nau-theme')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'announcements'),
            'exclude_from_search' => true,
            'menu_icon' => 'dashicons-images-alt2',
            'supports' => array('title', 'editor', 'thumbnail', 'revisions')
        )
    );
}

add_action( 'init', 'register_announcements_posttype' );

function register_announcements_taxonomy() {
    register_taxonomy('type', 'announcements', array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Types', 'nau-theme'),
            'singular_name' => _x( 'Type', 'nau-theme'),
            'search_items'      => __( 'Search Types', 'nau-theme' ),
            'all_items'         => __( 'All Types', 'nau-theme' ),
            'parent_item'       => __( 'Parent Type', 'nau-theme' ),
            'parent_item_colon' => __( 'Parent Type:', 'nau-theme' ),
            'edit_item'         => __( 'Edit Type', 'nau-theme' ),
            'update_item'       => __( 'Update Type', 'nau-theme' ),
            'add_new_item'      => __( 'Add New Type', 'nau-theme' ),
            'new_item_name'     => __( 'New Type Name', 'nau-theme' ),
            'menu_name'         => __( 'Type', 'nau-theme' ),
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'type'),
    ));
}

add_action( 'init', 'register_announcements_taxonomy');