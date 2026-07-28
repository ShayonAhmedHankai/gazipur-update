<?php
/**
 * Gazipur Update functions and definitions
 *
 * @package Gazipur_Update
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GAZIPUR_UPDATE_VERSION', '1.0.0' );
define( 'GAZIPUR_UPDATE_DIR', get_template_directory() );
define( 'GAZIPUR_UPDATE_URI', get_template_directory_uri() );

/**
 * Theme setup
 */
function gazipur_update_setup() {
	load_theme_textdomain( 'gazipur-update', GAZIPUR_UPDATE_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style',
		'navigation-widgets',
	) );

	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );

	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	add_theme_support( 'customize-selective-refresh-widgets' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'gazipur-update' ),
		'footer'  => esc_html__( 'Footer Menu', 'gazipur-update' ),
		'social'  => esc_html__( 'Social Links Menu', 'gazipur-update' ),
	) );

	add_image_size( 'gazipur-featured', 800, 450, true );
	add_image_size( 'gazipur-card', 400, 225, true );
	add_image_size( 'gazipur-thumb', 150, 150, true );
	add_image_size( 'gazipur-hero', 1200, 600, true );
}
add_action( 'after_setup_theme', 'gazipur_update_setup' );

/**
 * Content width
 */
function gazipur_update_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gazipur_update_content_width', 1200 );
}
add_action( 'after_setup_theme', 'gazipur_update_content_width', 0 );

/**
 * Enqueue scripts & styles
 */
function gazipur_update_scripts() {
	// Compiled Tailwind + theme utilities
	wp_enqueue_style(
		'gazipur-update-main',
		GAZIPUR_UPDATE_URI . '/assets/css/main.css',
		array(),
		GAZIPUR_UPDATE_VERSION
	);

	wp_enqueue_style(
		'gazipur-update-style',
		get_stylesheet_uri(),
		array( 'gazipur-update-main' ),
		GAZIPUR_UPDATE_VERSION
	);

	wp_enqueue_script(
		'gazipur-update-main',
		GAZIPUR_UPDATE_URI . '/assets/js/main.js',
		array(),
		GAZIPUR_UPDATE_VERSION,
		true
	);

	if ( is_front_page() || is_home() ) {
		wp_enqueue_script(
			'gazipur-update-ticker',
			GAZIPUR_UPDATE_URI . '/assets/js/ticker.js',
			array(),
			GAZIPUR_UPDATE_VERSION,
			true
		);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'gazipur-update-main', 'gazipur_ajax', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => wp_create_nonce( 'gazipur_nonce' ),
		'i18n'     => array(
			'loading' => esc_html__( 'Loading…', 'gazipur-update' ),
			'error'   => esc_html__( 'Something went wrong.', 'gazipur-update' ),
		),
	) );
}
add_action( 'wp_enqueue_scripts', 'gazipur_update_scripts' );

/**
 * Admin styles
 */
function gazipur_update_admin_styles( $hook ) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		wp_enqueue_style(
			'gazipur-update-admin',
			GAZIPUR_UPDATE_URI . '/assets/css/admin.css',
			array(),
			GAZIPUR_UPDATE_VERSION
		);
	}
}
add_action( 'admin_enqueue_scripts', 'gazipur_update_admin_styles' );

/**
 * Widget areas
 */
function gazipur_update_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gazipur-update' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Main sidebar widgets.', 'gazipur-update' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s mb-8 bg-white rounded-lg shadow-sm p-5">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title text-lg font-bold mb-4 pb-2 border-b-2 border-red-600">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Breaking News', 'gazipur-update' ),
		'id'            => 'header-breaking-news',
		'description'   => esc_html__( 'Optional widget area above the ticker.', 'gazipur-update' ),
		'before_widget' => '<div class="breaking-news-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="sr-only">',
		'after_title'   => '</span>',
	) );

	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer Column %d', 'gazipur-update' ), $i ),
			'id'            => 'footer-' . $i,
			'before_widget' => '<div class="footer-widget %2$s mb-6">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="text-white font-bold text-base mb-4 uppercase tracking-wide">',
			'after_title'   => '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'gazipur_update_widgets_init' );

/**
 * Excerpt length
 */
function gazipur_update_excerpt_length( $length ) {
	return 22;
}
add_filter( 'excerpt_length', 'gazipur_update_excerpt_length', 999 );

/**
 * Excerpt more
 */
function gazipur_update_excerpt_more( $more ) {
	return sprintf(
		'&hellip; <a href="%s" class="text-red-600 hover:text-red-700 font-medium inline-flex items-center gap-1">%s</a>',
		esc_url( get_permalink() ),
		esc_html__( 'Read more', 'gazipur-update' )
	);
}
add_filter( 'excerpt_more', 'gazipur_update_excerpt_more' );

/**
 * Body classes
 */
function gazipur_update_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'gazipur_update_body_classes' );

/**
 * Security hardening
 */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', function ( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
} );

/**
 * Include modular files
 */
require_once GAZIPUR_UPDATE_DIR . '/inc/template-functions.php';
require_once GAZIPUR_UPDATE_DIR . '/inc/customizer.php';
require_once GAZIPUR_UPDATE_DIR . '/inc/ajax-handlers.php';
require_once GAZIPUR_UPDATE_DIR . '/inc/class-walker-nav-menu.php';
