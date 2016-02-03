<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis CG Theme' );
define( 'CHILD_THEME_URL', 'http://carmengrantham.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );


// Register widget area called 'home-below-content'
genesis_register_sidebar( array(
'id'            => 'home-below-content',
'name'          => __( 'Home Below Content', 'genesis' ),
'description'   => __( 'This is the home below content section.', 'genesis' ),
) );

//* Add the Home Below Content sections
add_action( 'genesis_entry_content', 'sk_show_posts' );
function sk_show_posts() {
    if ( is_front_page() ) {
        printf( '<div %s>', genesis_attr( 'home-below-content' ) );
        genesis_widget_area( 'home-below-content' );
        echo '</div>';
    }
}

//* Modify the Excerpt read more link, so rather than just plain text of ..., use a link with text [Continue Reading]
function new_excerpt_more($more) {
    return '&nbsp;<a class="more-link" href="' . get_permalink() . '"> [Continue Reading]</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
