<?php

function register_announcements_posttype() {
    register_post_type( 'announcements', 
        array(
            'labels' => array(
                'name' => __('Announcements'),
                'singular_name' => __('Announcement'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Announcement'),
                'new_item' => __('New Announcement'),
                'edit_item' => __('Edit Announcement'),
                'view_item' => __('View Announcement'),
                'all_items' => __('All Announcements'),
                'not_found' => __('No Announcements found.')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'announcements'),
            'exclude_from_search' => true,
            'menu_icon' => 'dashicons-images-alt2'
        )
    );
}

add_action( 'init', 'register_announcements_posttype' );