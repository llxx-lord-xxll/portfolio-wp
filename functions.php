<?php
/**
 * Author: Robert DeVore | @deviorobert
 * URL: html5blank.com | @html5blank
 * Custom functions, support, custom post types and more.
 */

require_once 'modules/is-debug.php';

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if ( ! isset( $content_width ) ) {
    $content_width = 900;
}

if ( function_exists( 'add_theme_support' ) ) {

    // Add Thumbnail Theme Support.
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'large', 700, '', true ); // Large Thumbnail.
    add_image_size( 'medium', 250, '', true ); // Medium Thumbnail.
    add_image_size( 'small', 120, '', true ); // Small Thumbnail.
    add_image_size( 'custom-size', 700, 200, true ); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use.
    /*add_theme_support('custom-background', array(
    'default-color' => 'FFF',
    'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use.
    /*add_theme_support('custom-header', array(
    'default-image'          => get_template_directory_uri() . '/img/headers/default.jpg',
    'header-text'            => false,
    'default-text-color'     => '000',
    'width'                  => 1000,
    'height'                 => 198,
    'random-default'         => false,
    'wp-head-callback'       => $wphead_cb,
    'admin-head-callback'    => $adminhead_cb,
    'admin-preview-callback' => $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Enable HTML5 support.
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

    // Localisation Support.
    load_theme_textdomain( 'html5blank', get_template_directory() . '/languages' );
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

// Navigation
function portfolio_nav($isMobile=false) {

    if ($isMobile){
        wp_nav_menu(
        array(
            'theme_location'  => 'header-menu',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'menu2',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'menu_link_inner_icon' => 'icon',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul class="list-unstyled" id="menu">%3$s</ul>',
            'depth'           => 0,
            'walker'          => '',
            )
        );
    }
    else{
        wp_nav_menu(array(
            'theme_location'  => 'header-menu',
            'menu'            => '',
            'container'       => 'ul',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'icon-menu d-none d-lg-block revealator-slideup revealator-once revealator-delay1',
            'menu_id'         => '',
            'menu_item_li_class' => 'icon-box',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '<h2>',
            'link_after'      => '</h2>',
            'depth'           => 0,
            'walker'          => '',
        ));
    }
}

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

function custom_walker_nav_menu_start_el($item_output, $item, $depth, $args){
    $output = '';
    $icon = get_field('icon', $item);
    if(isset($args->menu_item_li_class)) {
        if ($args->menu_item_li_class == 'icon-box'){
            $output .= '<i class="fa '.$icon.'"></i>';
        }
    }
    $output .= $item_output;

    return $output;
}
add_filter( 'walker_nav_menu_start_el', 'custom_walker_nav_menu_start_el' , 10, 4 );

function filter_nav_menu_item_title( $title, $item, $args, $depth ) {
    if(isset($args->menu_link_inner_icon)) {
        if ($args->menu_link_inner_icon == "icon"){
            $icon = get_field('icon', $item);
            if ($icon){
                $title = "<i class='fa $icon'></i><span>$title</span>";
            }
        }
    }
    return $title;
};

// add the filter
add_filter( 'nav_menu_item_title', 'filter_nav_menu_item_title', 10, 4 );

add_filter('nav_menu_css_class', 'menu_item_li_class', 1, 3);
function menu_item_li_class($classes, $item, $args) {
    if(isset($args->menu_item_li_class)) {
        $classes[] = $args->menu_item_li_class;
    }
    return $classes;
}

add_filter( 'body_class','add_body_classes' );
function add_body_classes( $classes ) {
    global $post;
    if (isset($post->post_name)){
        $classes[] = $post->post_name;
    }

    if ( is_single() && 'post' == get_post_type() ) {
        $classes[] = 'blog-post';
    }

    if ( is_front_page() && is_home() ) {
        // Default homepage
    } elseif ( is_front_page() ) {
        // static homepage
    } elseif ( is_home() ) {
        $classes[] = 'blog';
    } else {
        //everyting else
    }

    return $classes;

}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts() {
    if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
            // jQuery
            wp_deregister_script( 'jquery' );
            wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.5.0.min.js', array(), '3.5.0' );
            wp_register_script( 'styleswitcher', get_template_directory_uri() . '/js/styleswitcher.js', array()  ,'' , true);

            wp_register_script( 'preloader', get_template_directory_uri() . '/js/preloader.min.js', array()  ,'' , true);
            wp_register_script( 'revealator', get_template_directory_uri() . '/js/fm.revealator.jquery.min.js', array()  ,'' , true);
            wp_register_script( 'imagesloader', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array()  ,'' , true);
            wp_register_script( 'masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array()  ,'' , true);
            wp_register_script( 'classie', get_template_directory_uri() . '/js/classie.js', array()  ,'' , true);
            wp_register_script( 'cbpGridGallery', get_template_directory_uri() . '/js/cbpGridGallery.js', array()  ,'' , true);
            wp_register_script( 'hoverdir', get_template_directory_uri() . '/js/jquery.hoverdir.js', array()  ,'' , true);
            wp_register_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array()  ,'' , true);
            wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array() ,'4.4.1' , true);
            wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array() ,'2.7.1' , false);

            // Custom scripts
            wp_register_script(
                'custom',
                get_template_directory_uri() . '/js/custom.js',
                array(
                    'modernizr',
                    'jquery',
                    'bootstrap',
                    'styleswitcher',
                    'preloader',
                    'revealator',
                    'imagesloader',
                    'masonry',
                    'classie',
                    'cbpGridGallery',
                    'hoverdir',
                    'popper',
                ),
                '1.0.0',true );
            wp_localize_script( 'custom', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

        // Enqueue Scripts
            wp_enqueue_script( 'custom' );
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts() {
    if ( is_page( 'pagenamehere' ) ) {
        // Conditional script(s)
        wp_register_script( 'scriptname', get_template_directory_uri() . '/js/scriptname.js', array( 'jquery' ), '1.0.0' );
        wp_enqueue_script( 'scriptname' );
    }
}

// Load HTML5 Blank styles
function html5blank_styles() {
    if ( HTML5_DEBUG ) {
        // Custom CSS
        wp_register_style( 'portfolio-wp-styles', get_template_directory_uri() . '/css/style.css', array(), '1.0' );
        wp_register_style( 'portfolio-wp-stylesheet', get_template_directory_uri() . '/style.css', '1.0' );


        // Register CSS
        wp_enqueue_style( 'portfolio-wp-styles' );
        wp_enqueue_style( 'portfolio-wp-stylesheet' );
    } else {
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1' );
        wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7' );
        wp_register_style( 'fm-evaluator', get_template_directory_uri() . '/css/fm.revealator.jquery.min.css', array());
        wp_register_style( 'circle', get_template_directory_uri() . '/css/circle.css', array());
        wp_register_style( 'preloader', get_template_directory_uri() . '/css/preloader.min.css', array());
        wp_register_style( 'styleswitcher', get_template_directory_uri() . '/css/styleswitcher.css', array());


        wp_register_style( 'skin-blue', get_template_directory_uri() . '/css/skins/blue.css', array());
        wp_register_style( 'skin-blueviolet', get_template_directory_uri() . '/css/skins/blueviolet.css', array());
        wp_register_style( 'skin-goldenrod', get_template_directory_uri() . '/css/skins/goldenrod.css', array());
        wp_register_style( 'skin-green', get_template_directory_uri() . '/css/skins/green.css', array());
        wp_register_style( 'skin-magenta', get_template_directory_uri() . '/css/skins/magenta.css', array());
        wp_register_style( 'skin-orange', get_template_directory_uri() . '/css/skins/orange.css', array());
        wp_register_style( 'skin-purple', get_template_directory_uri() . '/css/skins/purple.css', array());
        wp_register_style( 'skin-red', get_template_directory_uri() . '/css/skins/red.css', array());
        wp_register_style( 'skin-yellow', get_template_directory_uri() . '/css/skins/yellow.css', array());
        wp_register_style( 'skin-yellowgreen', get_template_directory_uri() . '/css/skins/yellowgreen.css', array());

        // Custom CSS
        wp_register_style( 'portfolio-wp-styles', get_template_directory_uri() . '/css/style.css',
            array( 'bootstrap',
                'fontawesome',
                'fm-evaluator',
                'circle',
                'preloader',
                'styleswitcher',
                'skin-blue',
                'skin-blueviolet',
                'skin-goldenrod',
                'skin-green',
                'skin-magenta',
                'skin-orange',
                'skin-purple',
                'skin-red',
                'skin-yellow',
                'skin-yellowgreen',
            ), '1.0' );
        wp_register_style( 'portfolio-wp-stylesheet', get_template_directory_uri() . '/style.css', '1.0' );


        // Register CSS
        wp_enqueue_style( 'portfolio-wp-styles' );
        wp_enqueue_style( 'portfolio-wp-stylesheet' );
    }
}

// Register HTML5 Blank Navigation
function register_html5_menu() {
    register_nav_menus( array( // Using array to specify more menus if needed
        'header-menu'  => esc_html( 'Header Menu', 'html5blank' ), // Main Navigation
        'extra-menu'   => esc_html( 'Extra Menu', 'html5blank' ) // Extra Navigation if needed (duplicate as many as you need!)
    ) );
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args( $args = '' ) {
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter( $var ) {
    return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list( $thelist ) {
    return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class( $classes ) {
    global $post;
    if ( is_home() ) {
        $key = array_search( 'blog', $classes, true );
        if ( $key > -1 ) {
            unset( $classes[$key] );
        }
    } elseif ( is_page() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    } elseif ( is_singular() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    }

    return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
    $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
    return $html;
}


// If Dynamic Sidebar Exists
if ( function_exists( 'register_sidebar' ) ) {
    // Define Sidebar Widget Area 1
    register_sidebar( array(
        'name'          => esc_html( 'Widget Area 1', 'html5blank' ),
        'description'   => esc_html( 'Description for this widget-area...', 'html5blank' ),
        'id'            => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    // Define Sidebar Widget Area 2
    register_sidebar( array(
        'name'          => esc_html( 'Widget Area 2', 'html5blank' ),
        'description'   => esc_html( 'Description for this widget-area...', 'html5blank' ),
        'id'            => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;

    if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
        remove_action( 'wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ) );
    }
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links( array(
        'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format'  => '?paged=%#%',
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total'   => $wp_query->max_num_pages,
    ) );
}

// Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
function html5wp_index( $length ) {
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post( $length ) {
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt( $length_callback = '', $more_callback = '' ) {
    global $post;
    if ( function_exists( $length_callback ) ) {
        add_filter( 'excerpt_length', $length_callback );
    }
    if ( function_exists( $more_callback ) ) {
        add_filter( 'excerpt_more', $more_callback );
    }
    $output = get_the_excerpt();
    $output = apply_filters( 'wptexturize', $output );
    $output = apply_filters( 'convert_chars', $output );
    $output = '<p>' . $output . '</p>';
    echo esc_html( $output );
}

// Custom View Article link to Post
function html5_blank_view_article( $more ) {
    global $post;
    return '... <a class="view-article" href="' . get_permalink( $post->ID ) . '">' . esc_html_e( 'View Article', 'html5blank' ) . '</a>';
}

// Remove Admin bar
function remove_admin_bar() {
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove( $tag ) {
    return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ( $avatar_defaults ) {
    $myavatar                   = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = 'Custom Gravatar';
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments() {
    if ( ! is_admin() ) {
        if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
}

// Custom Comments Callback
function html5blankcomments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract( $args, EXTR_SKIP );

    if ( 'div' == $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo esc_html( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    <?php printf( esc_html( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ) ?>
    </div>
<?php if ( $comment->comment_approved == '0' ) : ?>
    <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' ) ?></em>
    <br />
<?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
        <?php
            printf( esc_html( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ) ?></a><?php edit_comment_link( esc_html_e( '(Edit)' ), '  ', '' );
        ?>
    </div>

    <?php comment_text() ?>

    <div class="reply">
    <?php comment_reply_link( array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php }

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action( 'wp_enqueue_scripts', 'html5blank_header_scripts' ); // Add Custom Scripts to wp_head
add_action( 'wp_print_scripts', 'html5blank_conditional_scripts' ); // Add Conditional Page Scripts
add_action( 'get_header', 'enable_threaded_comments' ); // Enable Threaded Comments
add_action( 'wp_enqueue_scripts', 'html5blank_styles' ); // Add Theme Stylesheet
add_action( 'init', 'register_html5_menu' ); // Add HTML5 Blank Menu
add_action( 'init', 'create_post_type_portfolio' ); // Add our HTML5 Blank Custom Post Type
add_action( 'widgets_init', 'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action( 'init', 'html5wp_pagination' ); // Add our HTML5 Pagination

// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Add Filters
add_filter( 'avatar_defaults', 'html5blankgravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
// add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter( 'nav_menu_item_id', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1 ); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
//add_filter( 'excerpt_more', 'html5_blank_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar
add_filter( 'style_loader_tag', 'html5_style_remove' ); // Remove 'text/css' from enqueued stylesheet
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode( 'portfolio_gallery', 'portfolio_gallery' ); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode( 'html5_shortcode_demo_2', 'html5_shortcode_demo_2' ); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_portfolio() {
    register_taxonomy_for_object_type( 'category', 'portfolio' ); // Register Taxonomies for Category
    register_taxonomy_for_object_type( 'post_tag', 'portfolio' );
    register_post_type( 'portfolio', // Register Custom Post Type
        array(
        'labels'       => array(
            'name'               => esc_html( 'Portfolios', 'errorxit-portfoliowp' ), // Rename these to suit
            'singular_name'      => esc_html( 'Portfolio', 'errorxit-portfoliowp' ),
            'add_new'            => esc_html( 'Add New', 'errorxit-portfoliowp' ),
            'add_new_item'       => esc_html( 'Add New HTML5 Blank Custom Post', 'errorxit-portfoliowp' ),
            'edit'               => esc_html( 'Edit', 'errorxit-portfoliowp' ),
            'edit_item'          => esc_html( 'Edit Portfolio', 'errorxit-portfoliowp' ),
            'new_item'           => esc_html( 'New Portfolio', 'errorxit-portfoliowp' ),
            'view'               => esc_html( 'View Portfolio', 'errorxit-portfoliowp' ),
            'view_item'          => esc_html( 'View Portfolio', 'errorxit-portfoliowp' ),
            'search_items'       => esc_html( 'Search Portfolios', 'errorxit-portfoliowp' ),
            'not_found'          => esc_html( 'No Portfolio found', 'errorxit-portfoliowp' ),
            'not_found_in_trash' => esc_html( 'No Portfolios found in Trash', 'errorxit-portfoliowp' ),
        ),
            'menu_icon'           =>    'dashicons-portfolio',
            'public'       => true,
            'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
            'has_archive'  => true,
            'show_in_rest' => true,
            'supports'     => array(
                'title',
                'thumbnail',
                'editor'
            ), // Go to Dashboard Custom HTML5 Blank post for supports
            'can_export'   => true, // Allows export in Tools > Export
            'taxonomies'   => array(
                'post_tag',
                'category'
            ) // Add Category and Post Tags support
    ) );
}

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function portfolio_gallery( $atts, $content = null ) {

    $portfolio_html =  '<div id="grid-gallery" class="container grid-gallery">
        <section class="grid-wrap">
            <ul class="row grid">';

    $args = array(
        'post_type'=> 'portfolio',
        'order'    => 'ASC'
    );

    $the_query = new WP_Query( $args );
    if($the_query->have_posts() ) :
        while ( $the_query->have_posts() ) :
            $the_query->the_post();
            $portfolio_html .= '<li><figure>' . get_the_post_thumbnail( array( 350, 350 ) ) . '<div><span>' . get_the_title() . '</span></div>' . '</figure></li>';
        endwhile;
        wp_reset_postdata();
    endif;

    $portfolio_html .= '</ul></section>';

    $portfolio_html .= '<section class="slideshow"><ul>';
    $args = array(
        'post_type'=> 'portfolio',
        'order'    => 'ASC'
    );

    $the_query = new WP_Query( $args );
    if($the_query->have_posts() ) :
        while ( $the_query->have_posts() ) :
            $the_query->the_post();
            $url = parse_url(get_field('preview_link'));

            if (isset($url['host']))
                $url = $url['host'];
            else
                $url = '';

            $portfolio_html .= '<li><figure><figcaption>';
            $portfolio_html .= "<h3>". get_the_title() ."</h3>";
            $portfolio_html .= '<div class="row open-sans-font">';


            $portfolio_html .= '</div></figcaption>' . apply_filters('the_content',get_the_content());
            $portfolio_html .= '</figure></li>';

        endwhile;
        wp_reset_postdata();
    endif;

    $portfolio_html .= '</ul>';

    $portfolio_html .= '<nav><span class="icon nav-prev"><img src="'.get_stylesheet_directory_uri() . '/img/left-arrow.png'.'" alt="previous"></span><span class="icon nav-next"><img src="'.get_stylesheet_directory_uri() . '/img/right-arrow.png'.'" alt="next"></span><span class="nav-close"><img src="'.get_stylesheet_directory_uri() . '/img/close-button.png'.'" alt="close"> </span></nav>';

    $portfolio_html .= '</section></div>';

    return $portfolio_html;
}

// Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
function html5_shortcode_demo_2( $atts, $content = null ) {
    return '<h2>' . $content . '</h2>';
}


add_action("wp_ajax_contact", "handle_contact");
add_action("wp_ajax_nopriv_contact", "handle_contact");

function handle_contact(){
    if ( !wp_verify_nonce( $_REQUEST['contact_nonce'], "contact")) {
        exit("No naughty business please");
    }
    else{
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])){
            $to = get_option('admin_email');
            $subject = 'A new message appeared [Derrekspace]';
            $body = '<table style="height: 228px; width: 483px;" border="0"><caption>
                        <h2>A new message just appeared in your contact form</h2>
                        </caption>
                        <tbody>
                        <tr style="height: 45px;">
                        <td style="width: 116px; height: 45px;">Name</td>
                        <td style="width: 351px; height: 45px;">'.$_POST['name'].'</td>
                        </tr>
                        <tr style="height: 45px;">
                        <td style="width: 116px; height: 45px;">Subject</td>
                        <td style="width: 351px; height: 45px;">'.$_POST['subject'].'</td>
                        </tr>
                        <tr style="height: 44px;">
                        <td style="width: 116px; height: 44px;">Email address</td>
                        <td style="width: 351px; height: 44px;">'.$_POST['email'].'</td>
                        </tr>
                        <tr style="height: 144px;">
                        <td style="width: 116px; height: 144px;">Message</td>
                        <td style="width: 351px; height: 144px;">'.$_POST['message'].'</td>
                        </tr>
                        </tbody>
                        </table>';
            $headers = array('Content-Type: text/html; charset=UTF-8' , "Reply-To: ".$_POST['name']." <".$_POST['email'].">");

            if (wp_mail( $to, $subject, $body, $headers )){
                exit("success");
            }
            else{
                exit("Failed");
            }
        }
    }
}


function wp_portfolio_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wp_portfolio_custom_excerpt_length', 999 );