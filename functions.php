<?php
/**
 * wpfoundation functions and definitions
 *
 * @package wpfoundation
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'wpfoundation_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wpfoundation_setup() {
    /*
     * Go ahead and remove Wordpress Generator Tag in HEAD
     */
    remove_action( 'wp_head', 'wp_generator' );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wpfoundation, use a find and replace
	 * to change 'wpfoundation' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wpfoundation', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wpfoundation' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wpfoundation_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // wpfoundation_setup
add_action( 'after_setup_theme', 'wpfoundation_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function wpfoundation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wpfoundation' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'wpfoundation_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wpfoundation_scripts() {
    /*
     * Remove the default _s stylesheet...in favor of the default zurb foundation stylesheet
     */
	//wp_enqueue_style( 'wpfoundation-style', get_stylesheet_uri() );
    wp_enqueue_style( 'wpfoundation-app-style', get_stylesheet_directory_uri() . '/stylesheets/app.min.css', array(), '1.0.4', 'all' );

	//wp_enqueue_script( 'wpfoundation-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'wpfoundation-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
    }

    /*
     * Add ALL Foundation JS scripts as a minified version. This includes Fastclick.js & Modernizr.js
     */
    wp_enqueue_script( 'wpfoundation-foundation-all-js', get_template_directory_uri() . '/js/foundation.all.min.js', array('jquery'), '1.0.4', true );

    /*
     * Alternatively Load Foundation Scripts Individually
     */
    //FOUNDATION VENDOR SCRIPTS
    #wp_enqueue_script( 'wpfoundation-foundation-fastclick-js', get_template_directory_uri() . '/bower_components/foundation/js/vendor/fastclick.js', array( 'jquery' ), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-modernizr-js', get_template_directory_uri() . '/bower_components/foundation/js/vendor/modernizr.js', array( 'jquery' ), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-placeholder-js', get_template_directory_uri() . '/bower_components/foundation/js/vendor/placeholder.js', array( 'jquery' ), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-jquery-cookie-js', get_template_directory_uri() . '/bower_components/foundation/js/vendor/jquery.cookie.js', array( 'jquery' ), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-min', get_template_directory_uri() . '/bower_components/foundation/js/foundation.min.js', array( 'jquery', 'wpfoundation-foundation-fastclick-js', 'wpfoundation-foundation-modernizr-js' ), '1.0.4', true );
    //FOUNDATION PLUGIN SCRIPTS
    #wp_enqueue_script( 'wpfoundation-foundation-interchange-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.interchange.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-slider-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.slider.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-tab-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.tab.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-accordion-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.accordion.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-dropdown-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.dropdown.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-joyride-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.joyride.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-equalizer-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.equalizer.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-abide-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.abide.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-topbar-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.topbar.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-clearing-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.clearing.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-tooltip-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.tooltip.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-offcanvas-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.offcanvas.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-magellan-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.magellan.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-reveal-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.reveal.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-orbit-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.orbit.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
    #wp_enqueue_script( 'wpfoundation-foundation-alert-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.alert.js', array( 'jquery', 'wpfoundation-foundation-min'), '1.0.4', true );
}
add_action( 'wp_enqueue_scripts', 'wpfoundation_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
