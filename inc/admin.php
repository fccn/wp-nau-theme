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

    <select name="nau_environment" placeholder="NAU Environment">
      <option value="dev" <? if (get_option('nau_environment') == "dev") echo "selected"; ?>>dev</option>
      <option value="stage" <? if (get_option('nau_environment') == "stage") echo "selected"; ?>>stage</option>
      <option value="prod" <? if (get_option('nau_environment') == "prod") echo "selected"; ?>>prod</option>
    </select>

<?php }

// Show or hide cookie message
function nau_display_cookie_message_visible(){ ?>

    <select name="nau_cookie_message_visible">
      <option value="1" <? if (get_option('nau_cookie_message_visible', 1) == "1") echo "selected"; ?>>Show</option>
      <option value="0" <? if (get_option('nau_cookie_message_visible', 1) == "0") echo "selected"; ?>>Hide</option>
    </select>

<?php }

// Cookie message
function nau_display_cookie_message(){ ?>
	
	<textarea name="nau_cookie_message" placeholder="Cookie Message" rows="10" cols="150"><?php echo get_option('nau_cookie_message'); ?></textarea>

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


// Confluence Widget Code
function nau_display_confluence_widget_key(){ ?>
	
	<input type="text" name="nau_confluence_widget_key" placeholder="Confluence Widget Key" value="<?php echo get_option('nau_confluence_widget_key'); ?>" size="35">

<?php }


// Javascript Header Code
function nau_display_extra_js(){ ?>

        <textarea name="nau_extra_js" placeholder="Extra Header Code" rows="10" cols="150"><?php echo get_option('nau_extra_js'); ?></textarea>


<?php }


// Show menu languages
function nau_display_menu_languages(){ ?>

    <select name="nau_menu_languages" placeholder="NAU Menu Languages">
      <option value="1" <? if (get_option('nau_menu_languages', 1) == "1") echo "selected"; ?>>Show</option>
      <option value="0" <? if (get_option('nau_menu_languages', 1) == "0") echo "selected"; ?>>Hide</option>
    </select>

<?php }


// Show Subscribe newsletter link
function nau_display_subscribe_newsletter_link(){ ?>

  <input type="text" name="nau_subscribe_newsletter_link" placeholder="Subscribe newsletter footer link" value="<?php echo get_option('nau_subscribe_newsletter_link'); ?>" size="100">

<?php }

// Show category slug for entities
function nau_display_category_slug_entity(){ ?>

  <input type="text" name="nau_category_slug_entity" placeholder="Entities comma separated categories slug, eg. 'entity,entidade'" value="<?php echo get_option('nau_category_slug_entity'); ?>" size="100">

<?php }

// Show category slug for courses
function nau_display_category_slug_course(){ ?>

  <input type="text" name="nau_category_slug_course" placeholder="Course comma separated categories slug, eg. 'course,curso'" value="<?php echo get_option('nau_category_slug_course'); ?>" size="100">

<?php }

// Show category slug for news
function nau_display_category_slug_news(){ ?>

  <input type="text" name="nau_category_slug_news" placeholder="News comma separated categories slug, eg. 'news,noticia'" value="<?php echo get_option('nau_category_slug_news'); ?>" size="100">

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
    add_settings_field("nau_cookie_message_visible", "Cookie Message", "nau_display_cookie_message_visible", "theme-options", "section");
    add_settings_field("nau_cookie_message", "Cookie Message (HTML)", "nau_display_cookie_message", "theme-options", "section");
    add_settings_field("nau_slug_courses_page", "Slug Courses Page", "nau_display_slug_courses_page", "theme-options", "section");
    add_settings_field("nau_google_gtag", "Google GTAG", "nau_display_google_gtag", "theme-options", "section");
    add_settings_field("nau_facebook_pixel", "Facebook Pixel ID", "nau_display_facebook_pixel", "theme-options", "section");
    add_settings_field("nau_confluence_widget_key", "Confluence Widget Key", "nau_display_confluence_widget_key", "theme-options", "section");
    add_settings_field("nau_extra_js", "Extra JS Code", "nau_display_extra_js", "theme-options", "section");
    add_settings_field("nau_menu_languages", "Menu languages", "nau_display_menu_languages", "theme-options", "section");
    add_settings_field("nau_subscribe_newsletter_link", "Subscribe newsletter link", "nau_display_subscribe_newsletter_link", "theme-options", "section");
    add_settings_field("nau_category_slug_entity", "Entities comma separated categories slug, eg. 'entity,entidade'", "nau_display_category_slug_entity", "theme-options", "section");
    add_settings_field("nau_category_slug_course", "Course comma separated categories slug, eg. 'course,curso'", "nau_display_category_slug_course", "theme-options", "section");
    add_settings_field("nau_category_slug_news", "News comma separated categories slug, eg. 'news,noticia'", "nau_display_category_slug_news", "theme-options", "section");
    
    
    

    register_setting("section", "nau_environment");
    register_setting("section", "nau_cookie_message_visible");
    register_setting("section", "nau_cookie_message");
    register_setting("section", "nau_slug_courses_page");
    register_setting("section", "nau_google_gtag");
    register_setting("section", "nau_facebook_pixel");
    register_setting("section", "nau_confluence_widget_key");
    register_setting("section", "nau_extra_js");
    register_setting("section", "nau_menu_languages");
    register_setting("section", "nau_subscribe_newsletter_link");
    register_setting("section", "nau_category_slug_entity");
    register_setting("section", "nau_category_slug_course");
    register_setting("section", "nau_category_slug_news");
    
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
