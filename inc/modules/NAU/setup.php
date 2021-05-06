<?php

class Setup {

    const baseLanguageDir = '/languages';

    public static array $menus;
    public static array $supports;
    public static string $domain;
    public static array $styles;
    public static array $scripts;

    public function __construct(
        $supports = array(), 
        $menus = array(), 
        $domain = '', 
        $styles = array(), 
        $scripts = array()) {
            $this->menus = $menus;
            $this->supports = $supports;
            $this->domain = $domain;
            $this->styles = $styles;
            $this->scripts = $scripts;
    }

    public function getThemeVersion ($default = '1.0.0') {
        if ( WP_DEBUG )
            return time();
        if ( WP_NAU_THEME_VERSION != 'WP_NAU_THEME_VERSION' )
            return WP_NAU_THEME_VERSION;
        
        return $default;
    }

    private function registerNavMenus ($menus) {
        add_action('init', function() use ($menus) {
            foreach($menus as $location => $description){
                // gets an array of the menus and registers them
                register_nav_menu( $location, $description );
            }
        });
    }

    private function registerTextDomain ($domain) {
        add_action( 'after_setup_theme', function() use ($domain) {
            load_theme_textdomain( $domain, get_template_directory() . constant(self::baseLanguageDir) );
        });
    }

    private function registerThemeSupport ($supports) {
        add_action( 'after_setup_theme', function() use ($supports) {
            foreach($supports as $item) {
                add_theme_support( $item );
            }
        });
    }

    private function registerThemeScripts ($scripts) {
        /*
         * $scripts = array(
         *  'handle' => array(
         *          'src' => '',
         *          'deps' => array(),
         *          'version' => null,
         *          'in_footer' => false
         *      )
         * )
         */
        add_action( 'wp_enqueue_scripts' , function() use ($scripts) {
            foreach($scripts as $handle => $details) {
                wp_enqueue_script( 
                    $handle, 
                    $details["src"], 
                    $details["deps"], 
                    (isset($details["version"])) ? $details["version"] : $this->getThemeVersion(), 
                    $details["in_footer"]
                );
            }
        });
    }

    private function registerThemeStyles ($styles) {
        /*
         * $styles = array(
         *  'handle' => array(
         *          'src' => '',
         *          'deps' => array(),
         *          'version' => null,
         *          'media' => 'all'
         *      )
         * )
         */
        add_action( 'wp_enqueue_scripts' , function() use ($scripts) {
            foreach($styles as $handle => $details) {
                wp_enqueue_style( 
                    $handle, 
                    $details["src"], 
                    $details["deps"], 
                    (isset($details["version"])) ? $details["version"] : $this->getThemeVersion(), 
                    $details["media"]
                );
            }
        });
    }

    public function init() {
        // register text domain
        $this->registerTextDomain($this->domain);
        // register theme support
        $this->registerThemeSupport($this->supports);
        // register site menus
        $this->registerNavMenus($this->menus);
        // register theme scripts
        $this->registerThemeScripts($this->scripts);
        // register theme styles
        $this->registerThemeStyles($this->styles);
    }
}

/*
$setup = new Setup(<arrays>);
$setup->init();
*/