<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! isset( $content_width ) ) $content_width = 1280;

function jms_init() {

    add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'custom-logo', array(
		'width' => 260,
		'height' => 100,
		'flex-height' => true,
		'flex-width' => true,
	) );
	add_theme_support( 'custom-header' );
	add_theme_support( 'woocommerce' );
	add_post_type_support( 'page', 'excerpt' );
	
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'jms' ) )
	);

	load_theme_textdomain( 'jms', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'jms_init' );

function jms_comment_reply() {
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_action( 'comment_form_before', 'jms_comment_reply' );

function jms_scripts_styles() {
	wp_enqueue_style( 'jms-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'jms_scripts_styles' );

function jms_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
};
add_action( 'elementor/theme/register_locations', 'jms_register_elementor_locations' );

function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
   }
   add_action( 'init', 'disable_emojis' );
   
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
	return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
	return array();
	}
   }
   
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {

		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
   
   $urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
   
   return $urls;
   }

function my_deregister_scripts(){
	wp_deregister_script( 'wp-embed' );
  }
  add_action( 'wp_footer', 'my_deregister_scripts' );

function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;

}
add_filter('upload_mimes', 'add_file_types_to_uploads');

function include_cf_script() {
    if( is_page( 'kontakt' ) || is_page( 'contact' ) ){
    wp_enqueue_script('cf', get_stylesheet_directory_uri() . '/js/contact-form.js', array(), null, true);
    }

}
add_action('wp_enqueue_scripts', 'include_cf_script');

function currentYear( $atts ){
    return date('Y');
}
add_shortcode( 'year', 'currentYear' );

function frontPagePosts() {
	$q = new WP_Query(array(
		'post_type' => 'post',
        'posts_per_page' => 2
    ));
    while ($q->have_posts()) {
		$q->the_post();
		$buffer=$buffer.'<h1><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>' . '<p>' . get_the_excerpt() . '</p>' . get_the_post_thumbnail( get_the_ID(), 'full' );

    }
	wp_reset_postdata();
	return $buffer;
}
add_shortcode( 'query', 'frontPagePosts' );
