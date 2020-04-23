<hr/>

<p><?=$stage_mode?></p>
<p><?=get_option('nau_environment')?></p>

<hr/>
<a href="/wp-admin/admin.php?page=wpseo_social#top#accounts">Editar em</a>
<pre>
<? print_r(get_option( 'wpseo_social' )) ?>
</pre>
<hr/>
<h2>Template DIR</h2>
<pre>
<?
$template     = get_template();
$theme_root   = get_theme_root( $template );
$template_dir = "$theme_root/$template";

print_r([
  "template" => $template,
  "theme_root" => $theme_root,
  "template_theme_dir" => $template_dir,
  "template_dir" => get_template_directory(),
  "available languages" => get_available_languages(),
  "LANG DIR" => WP_LANG_DIR,
  "lang_dir_null" => glob( WP_LANG_DIR ) ,
  "lang_dir_nau_theme" => glob( "nau-theme" ) ,
]);; ?>
</pre>

<hr>

<h2>CRON JOBS</h2>
<pre>
<?
$cron_jobs = get_option( 'cron' );
var_dump($cron_jobs);
?>
</pre>
<hr>
<h2>Child Theme Text Domain</h2>
<?

    $determined_locale = apply_filters( 'pre_determine_locale', null );
    if ( ! empty( $determined_locale ) && is_string( $determined_locale ) ) {
        return $determined_locale;
    }
 
    $determined_locale = get_locale();
 
    if ( is_admin() ) {
        $determined_locale = get_user_locale();
    }
 
    if ( isset( $_GET['_locale'] ) && 'user' === $_GET['_locale'] && wp_is_json_request() ) {
        $determined_locale = get_user_locale();
    }
 
    if ( ! empty( $_GET['wp_lang'] ) && ! empty( $GLOBALS['pagenow'] ) && 'wp-login.php' === $GLOBALS['pagenow'] ) {
        $determined_locale = sanitize_text_field( $_GET['wp_lang'] );
    }
 
    print_r($determined_locale);
    
?>
