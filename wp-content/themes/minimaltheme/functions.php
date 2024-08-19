<?php
/**
 * Minimal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Minimal
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function minimal_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Minimal, use a find and replace
		* to change 'minimal' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'minimal', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'minimal' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'minimal_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'minimal_setup' );

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function minimal_register_acf_blocks() {
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
	
    register_block_type( __DIR__ . '/blocks/testimonial' );
	register_block_type( __DIR__ . '/blocks/homepagehero' );
}
// Here we call our tt3child_register_acf_block() function on init.
add_action( 'init', 'minimal_register_acf_blocks' );

// Adding a new (custom) block category and show that category at the top
add_filter( 'block_categories_all', 'example_block_category', 10, 2);
function example_block_category( $categories, $post ) {
	
	array_unshift( $categories, array(
		'slug'	=> 'custom',
		'title' => 'Custom'
	) );

	return $categories;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function minimal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'minimal_content_width', 640 );
}
add_action( 'after_setup_theme', 'minimal_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function minimal_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'minimal' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'minimal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'minimal_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function minimal_scripts() {
	wp_enqueue_style( 'minimal-style', '/wp-content/themes/minimaltheme/dist/app.css', array(), false, 'all' );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/dist/bundle-min.js', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'minimal_scripts' );


// Minimal's includes directory.
$minimal_inc_dir = 'inc';

// Array of files to include.
$minimal_includes = array(
'/template-functions.php', // Functions which enhance the theme by hooking into WordPress.
'/template-tags.php',// Custom template tags for this theme.
'/uikit-navwalker.php',// UIKit Navwalker
);

// Include files.
foreach ( $minimal_includes as $file ) {
	require_once get_theme_file_path( $minimal_inc_dir . $file );
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Remove unused or uneeded files
 */

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');