<?php
/**
 * Currently not in use by NAU !
 * 
 * Make Polylang compatible with the WP-API. 
 * Query language specific WP-API posts via a parameter and add the post language as a new REST field.
 * 
 * Reference:
 *   https://gist.github.com/them-es/3ab1aa674fdb1829a3079f09559c8614
 *   https://developer.wordpress.org/reference/hooks/rest_this-post_type_query
 *
 * Query language specific posts via "lang" parameter: /wp-json/wp/v2/posts?lang=en
 */
function nau_theme_filter_rest_post_query( $args, $request ) {
	$lang_parameter = $request->get_param('lang');

	if ( isset( $lang_parameter ) ) {
		$args['lang'] = $lang_parameter; // https://polylang.pro/doc/developpers-how-to/#query
	}

	return $args;
}
add_filter( 'rest_post_query', 'nau_theme_filter_rest_post_query', 10, 2 );
add_filter( 'rest_page_query', 'nau_theme_filter_rest_post_query', 10, 2 );


/**
 * https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints
 *
 * Register a new REST field "language" and add it to the post data
 * 
 */
add_action( 'rest_api_init', function () {

	register_rest_field( 'post', 'language', nau_theme_register_postlanguage_function() );
	register_rest_field( 'page', 'language', nau_theme_register_postlanguage_function() );
	//register_rest_field( '{my_custom_posttype}', 'language', nau_theme_register_postlanguage_function() ); // Optional: Custom posttype

});

function nau_theme_register_postlanguage_function() {
	return array(
		'methods'         => 'GET',
		'get_callback'    => 'nau_theme_get_postlanguage_function',
		'schema'          => null,
	);
}

function nau_theme_get_postlanguage_function( $data ) {
	$post_id = $data['id'];

	return ( function_exists( 'pll_get_post_language' ) ? pll_get_post_language( $post_id ) : null );
}
