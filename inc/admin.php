<?php
/*===================================================================================
* Add global options
* =================================================================================*/

/**
 *
 * The page content surrounding the settings fields. Usually you use this to instruct non-techy people what to do.
 *
 */
function nau_theme_settings_page(){ 
	?>
	<div class="wrap">
		<h1>NAU Theme Info</h1>
		<p>Variáveis para ativação do Theme NAU</p>
		<form method="post" action="options.php">
			<?php
			settings_fields("section");
			do_settings_sections("theme-options");
			submit_button();
			?>
		</form>
	</div>
	
	<?php }

/**
 *
 * Next comes the settings fields to display. Use anything from inputs and textareas, to checkboxes multi-selects.
 *
 */

// Current Environment
function nau_display_environment(){ ?>
	
	<input type="text" name="nau_environment" placeholder="NAU Environment" value="<?php echo get_option('nau_environment'); ?>" size="35">

<?php }

// Current News Page
function nau_display_news_page(){ ?>
	
	<input type="text" name="nau_news_page" placeholder="News Page ID" value="<?php echo get_option('nau_news_page'); ?>" size="6">

<?php }


// Courses slug page
function nau_display_slug_courses_page(){ ?>
	
	<input type="text" name="nau_slug_courses_page" placeholder="Course Pages slug" value="<?php echo get_option('nau_slug_courses_page'); ?>" size="6">

<?php }


// Google Code
function nau_display_google_gtag(){ ?>
	
	<input type="text" name="nau_google_gtag" placeholder="Google GTAG" value="<?php echo get_option('nau_google_gtag'); ?>" size="35">

<?php }


// Facebook Pixel Code
function nau_display_facebook_pixel(){ ?>
	
	<input type="text" name="nau_facebook_pixel" placeholder="Facebook Pixel ID" value="<?php echo get_option('nau_facebook_pixel'); ?>" size="35">

<?php }


/**
 *
 * Here you tell WP what to enqueue into the <form> area. You need:
 *
 * 1. add_settings_section
 * 2. add_settings_field
 * 3. register_setting
 *
 */

function nau_display_custom_info_fields(){

	add_settings_section("section", "NAU Option", null, "theme-options");

	add_settings_field("nau_environment", "Enviroment", "nau_display_environment", "theme-options", "section");
	add_settings_field("nau_news_page", "News Page", "nau_display_news_page", "theme-options", "section");
    add_settings_field("nau_slug_courses_page", "Slug Courses Page", "nau_display_slug_courses_page", "theme-options", "section");
    add_settings_field("nau_google_gtag", "Google GTAG", "nau_display_google_gtag", "theme-options", "section");
    add_settings_field("nau_facebook_pixel", "Facebook Pixel ID", "nau_display_facebook_pixel", "theme-options", "section");
    

	register_setting("section", "nau_environment");
	register_setting("section", "nau_news_page");
    register_setting("section", "nau_slug_courses_page");
    register_setting("section", "nau_google_gtag");
    register_setting("section", "nau_facebook_pixel");
    
}

add_action("admin_init", "nau_display_custom_info_fields");

/**
 *
 * Tie it all together by adding the settings page to wherever you like. For this example it will appear
 * in Settings > Contact Info
 *
 */

function add_nau_custom_info_menu_item(){
	
	add_options_page("NAU Settings", "NAU Settings", "manage_options", "nau-settings", "nau_theme_settings_page");
	
}

add_action("admin_menu", "add_nau_custom_info_menu_item");
