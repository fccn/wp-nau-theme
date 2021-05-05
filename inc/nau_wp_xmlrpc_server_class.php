<?php
/*
 * Custom NAU version of WordPress XML-RPC server.
 * 
 * Extends getPosts RPC with the 'lang' filter.
 * When activating the Polylang plugin the XML-RPC getPosts call only 
 * retrieves the default site language pages/posts.
 * With the new lang filter it's possible to the XML-RPC caller to 
 * get only the pages/posts by a specific or a list of languages.
 * 
 */

include_once(ABSPATH . WPINC . '/class-IXR.php');
include_once(ABSPATH . WPINC . '/class-wp-xmlrpc-server.php');

/**
 * Replace the standard XML-RPC server implementation of WordPress.
 * https://codex.wordpress.org/XML-RPC_Extending
 */
add_filter('wp_xmlrpc_server_class', function() {
    return new nau_wp_xmlrpc_server();
});

/**
 * This subclass it's a copy paste from WordPress upstream code, plus the 'lang' parameter.
 */
 class nau_wp_xmlrpc_server extends wp_xmlrpc_server {


    /**
     * Retrieve posts.
     *
     * @since 3.4.0
     *
     * @see wp_get_recent_posts()
     * @see wp_getPost() for more on `$fields`
     * @see get_posts() for more on `$filter` values
     *
     * @param array $args {
     *     Method arguments. Note: arguments must be ordered as documented.
     *
     *     @type int    $blog_id  Blog ID (unused).
     *     @type string $username Username.
     *     @type string $password Password.
     *     @type array  $filter   Optional. Modifies the query used to retrieve posts. Accepts 'post_type',
     *                            'post_status', 'number', 'offset', 'orderby', 's', and 'order'.
     *                            Default empty array.
     *     @type array  $fields   Optional. The subset of post type fields to return in the response array.
     * }
     * @return array|IXR_Error Array contains a collection of posts.
     */
    public function wp_getPosts( $args ) {
        if ( ! $this->minimum_args( $args, 3 ) ) {
                return $this->error;
        }

        $this->escape( $args );

        $username = $args[1];
        $password = $args[2];
        $filter   = isset( $args[3] ) ? $args[3] : array();

        if ( isset( $args[4] ) ) {
                $fields = $args[4];
        } else {
                /** This action is documented in wp-includes/class-wp-xmlrpc-server.php */
                $fields = apply_filters( 'xmlrpc_default_post_fields', array( 'post', 'terms', 'custom_fields' ), 'wp.getPosts' );
        }

        $user = $this->login( $username, $password );
        if ( ! $user ) {
                return $this->error;
        }

        /** This action is documented in wp-includes/class-wp-xmlrpc-server.php */
        do_action( 'xmlrpc_call', 'wp.getPosts', $args, $this );

        $query = array();

        if ( isset( $filter['post_type'] ) ) {
                $post_type = get_post_type_object( $filter['post_type'] );
                if ( ! ( (bool) $post_type ) ) {
                        return new IXR_Error( 403, __( 'Invalid post type.' ) );
                }
        } else {
                $post_type = get_post_type_object( 'post' );
        }

        if ( ! current_user_can( $post_type->cap->edit_posts ) ) {
                return new IXR_Error( 401, __( 'Sorry, you are not allowed to edit posts in this post type.' ) );
        }

        $query['post_type'] = $post_type->name;

        if ( isset( $filter['post_status'] ) ) {
                $query['post_status'] = $filter['post_status'];
        }

        if ( isset( $filter['number'] ) ) {
                $query['numberposts'] = absint( $filter['number'] );
        }

        if ( isset( $filter['offset'] ) ) {
            $query['offset'] = absint( $filter['offset'] );
        }

        if ( isset( $filter['orderby'] ) ) {
                $query['orderby'] = $filter['orderby'];

                if ( isset( $filter['order'] ) ) {
                        $query['order'] = $filter['order'];
                }
        }

        if ( isset( $filter['s'] ) ) {
                $query['s'] = $filter['s'];
        } 

        # Custom NAU
        if ( isset( $filter['lang'] ) ) {
                $query['lang'] = $filter['lang'];
        }

        $posts_list = wp_get_recent_posts( $query );

        if ( ! $posts_list ) {
                return array();
        }

        // Holds all the posts data.
        $struct = array();

        foreach ( $posts_list as $post ) {
                if ( ! current_user_can( 'edit_post', $post['ID'] ) ) {
                        continue;
                }

                $struct[] = $this->_prepare_post( $post, $fields );
        }

        return $struct;
    }

}
