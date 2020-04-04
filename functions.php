<?php 

if ( class_exists( 'Attachments' ) ){
    require_once 'lib/attachments.php';
}

if( site_url("http://localhost/dev") ){
    define( "VERSION", time() );
} else {
    define( "VERSION", wp_get_theme() -> get( "Version" ) );
}

function alpha_bootstraping(){
    load_theme_textdomain( "alpha" );
    add_theme_support( "post-thumbnails" );
    add_theme_support( "title-tag" );
    add_theme_support( 'html5', array( 'search-form' ) );
    $alpha_custom_header_details = array(
        'header-text'           => true,
        'default-text-color'    => "#222",
    );
    $alpha_custom_logo_default = array( 
        'width'     => '100',
        'height'    => '100'
    );
    add_theme_support( "custom-header", $alpha_custom_header_details );
    add_theme_support( "custom-logo", $alpha_custom_logo_default );
    add_theme_support( "custom-background" );
    register_nav_menu( "topmenu", __("Top Menu", "alpha") );
    register_nav_menu( "footermenu", __("Footer Menu", "alpha") );
    add_theme_support( "post-formats", array("image", "quote", "video", "audio") );
}
add_action( "after_setup_theme", "alpha_bootstraping" );

function alpha_assets(){
    // bootstrap css
    wp_enqueue_style( "bootstrap", "//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" );
    // featherlight css
    wp_enqueue_style( "featherlight-css", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" );
    // slick slider css
    wp_enqueue_style( "slick-theme-css", "//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" );
    wp_enqueue_style( "slick-css", "//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" );
    // main css
    wp_enqueue_style( "style", get_stylesheet_uri(), null, VERSION );

    // featherlight js
    wp_enqueue_script( "featherlight-js", "//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js", array("jquery"), "1.0", true );
    // slick slider js
    wp_enqueue_script( "slick-js", "//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js", array("jquery"), "1.0", true );
    // main js
    wp_enqueue_script( "main-js", get_template_directory_uri() . "/assets/js/script.js", null, VERSION, true );

}

add_action( "wp_enqueue_scripts", "alpha_assets" );

function alpha_sidebar(){
    register_sidebar( array(
        'name'          => __( 'Right Sidebar', 'theme_name' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Left', 'theme_name' ),
        'id'            => 'footer-left',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Right', 'theme_name' ),
        'id'            => 'footer-right',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( "widgets_init", "alpha_sidebar" );

function alpha_nav_menu_class( $classes, $item ) {
    $classes[] = "list-inline-item";
    return $classes;
}
add_filter( 'nav_menu_css_class' , 'alpha_nav_menu_class' , 10, 2 );

function alpha_about_page_template_inline_style(){
    if ( is_page() ) {
        $alpha_feat_image = get_the_post_thumbnail_url( null, "large" );
    }
    ?>

    <style>
        .page-header{
            background-image: url(<?php echo $alpha_feat_image; ?>);
        }
    </style>
    <?php

    if ( is_front_page() ) {
        if ( current_theme_supports( "custom-header" ) ){
            ?>
            <style>
            .header{
                background-image: url(<?php echo header_image(); ?>)
            }
            .header h1.heading a, .header h3.tagline{
                color: #<?php echo get_header_textcolor(); ?>;
                <?php if ( !display_header_text() ){
                    echo "display: none;";
                }
                ?>
            }
            </style>
            <?php
        }
    }
}
add_action( "wp_head", "alpha_about_page_template_inline_style", 11 );


function alpha_hilighted_search_result( $text ){

    if( is_search() ){
        $pattern = '/('.join( '|', explode( ' ', get_search_query() ) ).')/i';
        $text = preg_replace( $pattern, '<span class="search-highlight">\0</span>', $text );
    }
    return $text;
}

add_filter( "the_content", "alpha_hilighted_search_result" );
add_filter( "the_title", "alpha_hilighted_search_result" );
add_filter( "the_excerpt", "alpha_hilighted_search_result" );