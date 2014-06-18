<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'finley', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/lib/languages', 'finley' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Finley Theme', 'finley' ) );
define( 'CHILD_THEME_URL', 'http://wpcanada.ca/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Javascript files
add_action( 'wp_enqueue_scripts', 'finley_enqueue_scripts' );
function finley_enqueue_scripts() {

	wp_enqueue_script( 'finley-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'finley-clear-search-form',  get_stylesheet_directory_uri() . '/js/clear-search-form.js', array( 'jquery' ), '1.0.0', true );

}

//* Enqueue CSS files
add_action( 'wp_enqueue_scripts', 'finley_enqueue_styles' );
function finley_enqueue_styles() {

	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Dosis:400,700|Open+Sans:400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'finley-dashicons-style', get_stylesheet_uri(), array('dashicons'), '1.0' );

}

//* Add new image sizes
add_image_size( 'square', 120, 120, TRUE );
add_image_size( 'small-square', 100, 100, TRUE );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Reposition the primary navigation
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'finley_post_info_filter' );
function finley_post_info_filter( $post_info ) {

	$post_info = '[post_date] By [post_author_link] [post_comments] [post_edit]';
	return $post_info;
}

//* Modify the Genesis content limit read more link
add_filter( 'get_the_content_more_link', 'finley_read_more_link' );
function finley_read_more_link() {
	return '... <a class="more-link" href="' . get_permalink() . '">Read More</a>';
}

//* Customize search form input box text
add_filter( 'genesis_search_text', 'finley_search_text' );
function finley_search_text( $text ) {
	return esc_attr( 'Search this website...' );
}

//* Modify the speak your mind title in comments
add_filter( 'comment_form_defaults', 'finley_comment_form_defaults' );
function finley_comment_form_defaults( $defaults ) {
 
	$defaults['title_reply'] = __( 'What Do You Think?' );
	$defaults['comment_notes_before'] = '<p class="comment-box">' . __( 'Please submit your comment with a real name.' );
	$defaults['comment_notes_after'] = '<p class="comment-box">' . __( 'Thanks for your feedback!' );
	return $defaults;
 
}

//* Modify the author says text in comments
add_filter( 'comment_author_says_text', 'finley_comment_author_says_text' );
function finley_comment_author_says_text() {
	return '';
}

//* Change the footer text
add_filter( 'genesis_footer_creds_text', 'finley_footer_creds_filter' );
function finley_footer_creds_filter( $creds ) {
	$creds = 'Copyright [footer_copyright] &middot; <a href="/">YourSite</a> on <a href="http://www.studiopress.com">Genesis Framework</a> &middot; All Rights Reserved';
	return $creds;
}