<?php
require_once __DIR__ . '/vendor/autoload.php';

use SuperbThemesCustomizer\CustomizerController;

/**
 * minimalist-blogger-x functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package minimalist-blogger-x
 */


if (!function_exists('minimalist_blogger_x_theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */

    function minimalist_blogger_x_theme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on minimalist-blogger-x, use a find and replace
         * to change 'minimalist-blogger-x' to the name of your theme in all the template files.
         */
        load_theme_textdomain('minimalist-blogger-x', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(300);

        add_image_size('minimalist-blogger-x-grid', 350, 230, true);
        add_image_size('minimalist-blogger-x-slider', 850);
        add_image_size('minimalist-blogger-x-small', 300, 180, true);


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1'    => esc_html__('Primary', 'minimalist-blogger-x'),
        ));

        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('minimalist_blogger_x_theme_custom_background_args', array(
            'default-color' => '#ffffff',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'flex-width'  => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'minimalist_blogger_x_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function minimalist_blogger_x_theme_content_width()
{
    $GLOBALS['content_width'] = apply_filters('minimalist_blogger_x_theme_content_width', 640);
}
add_action('after_setup_theme', 'minimalist_blogger_x_theme_content_width', 0);


function minimalist_blogger_x_theme_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'minimalist_blogger_x_theme_woocommerce_support');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function minimalist_blogger_x_theme_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'minimalist-blogger-x'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'minimalist-blogger-x'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="sidebar-headline-wrapper"><div class="sidebarlines-wrapper"><div class="widget-title-lines"></div></div><h3 class="widget-title">',
        'after_title'   => '</h3></div>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('WooCommerce Sidebar', 'minimalist-blogger-x'),
        'id'            => 'sidebar-wc',
        'description'   => esc_html__('Add widgets here.', 'minimalist-blogger-x'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="sidebar-headline-wrapper"><div class="sidebarlines-wrapper"><div class="widget-title-lines"></div></div><h3 class="widget-title">',
        'after_title'   => '</h3></div>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget', 'minimalist-blogger-x'),
        'id'            => 'footerwidget-1',
        'description'   => esc_html__('Add widgets here.', 'minimalist-blogger-x'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div><h3 class="widget-title">',
        'after_title'   => '</h3></div>',
    ));


    register_sidebar(array(
        'name'          => esc_html__('Header Widget', 'minimalist-blogger-x'),
        'id'            => 'headerwidget-1',
        'description'   => esc_html__('Add widgets here.', 'minimalist-blogger-x'),
        'before_widget' => '<section id="%1$s" class="header-widget widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div><div class="sidebar-title-border"><h3 class="widget-title">',
        'after_title'   => '</h3></div></div>',
    ));
}




add_action('widgets_init', 'minimalist_blogger_x_theme_widgets_init');


/**
 * Enqueue scripts and styles.
 */
function minimalist_blogger_x_theme_scripts()
{
    wp_enqueue_style('minimalist-blogger-x-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('minimalist-blogger-x-style', get_stylesheet_uri());
    wp_enqueue_script('minimalist-blogger-x-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20170823', true);
    wp_enqueue_script('minimalist-blogger-x-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20170823', true);
    wp_enqueue_script('minimalist-blogger-x-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '20160720', true);
    if (!wp_is_mobile()) {
        wp_enqueue_script('minimalist-blogger-x-accessibility', get_template_directory_uri() . '/js/accessibility.js', array('jquery'), '20160720', true);
    }
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'minimalist_blogger_x_theme_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
CustomizerController::GetInstance();


/**
 * Google fonts
 */

function minimalist_blogger_x_theme_enqueue_assets()
{
    // Include the file.
    require_once get_theme_file_path('webfont-loader/wptt-webfont-loader.php');
    // Load the webfont.
    wp_enqueue_style(
        'minimalist-blogger-x-fonts',
        wptt_get_webfont_url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Lato:ital,wght@0,400;0,700;1,400;1,700&family=Merriweather:ital@0;1'),
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'minimalist_blogger_x_theme_enqueue_assets');



/**
 * Dots after excerpt
 */

function minimalist_blogger_x_theme_new_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'minimalist_blogger_x_theme_new_excerpt_more');


/**
 * Filter the excerpt length to 50 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function minimalist_blogger_x_theme_excerpt_length($length)
{
    if (is_admin()) {
        return $length;
    }
    return 50;
}
add_filter('excerpt_length', 'minimalist_blogger_x_theme_excerpt_length', 999);

/**
 * Blog Pagination
 */
if (!function_exists('minimalist_blogger_x_theme_numeric_posts_nav')) {
    function minimalist_blogger_x_theme_numeric_posts_nav()
    {
        $next_str = __('Next', 'minimalist-blogger-x');
        $prev_str = __('Previous', 'minimalist-blogger-x');
        //$prev_arrow = is_rtl() ? 'Previous' : 'Next';
        //$next_arrow = is_rtl() ? 'Next' : 'Previous';

        global $wp_query;
        $total = $wp_query->max_num_pages;
        $big = 999999999; // need an unlikely integer
        if ($total > 1) {
            /*
            if (!$current_page = get_query_var('paged')) {
                $current_page = 1;
            }
            */
            if (get_option('permalink_structure')) {
                $format = 'page/%#%/';
            } else {
                $format = '&paged=%#%';
            }
            echo wp_kses_post(paginate_links(array(
                'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'        => $format,
                'current'        => max(1, get_query_var('paged')),
                'total'         => $total,
                'mid_size'        => 1,
                'end_size'      => 0,
                'type'             => 'list',
                'prev_text'        => $prev_str,
                'next_text'        => $next_str,
            )));
        }
    }
}


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function minimalist_blogger_x_theme_skip_link_focus_fix()
{
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
        "use strict";
        /(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function() {
            var t, e = location.hash.substring(1);
            /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
        }, !1);
    </script>
    <?php
}
add_action('wp_print_footer_scripts', 'minimalist_blogger_x_theme_skip_link_focus_fix');



require_once get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

/**
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Free Seo Optimized Responsive Theme for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'minimalist_blogger_x_theme_register_required_plugins');

function minimalist_blogger_x_theme_register_required_plugins()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name'      => 'Superb Addons',
            'slug'      => 'superb-blocks',
            'required'           => false,
        ),
    );

    $config = array(
        'id'           => 'minimalist-blogger-x',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );


    tgmpa($plugins, $config);
}

/**
 * Deactivate Elementor Wizard
 */
function minimalist_blogger_x_theme_remove_elementor_onboarding()
{
    update_option('elementor_onboarded', true);
}
add_action('after_switch_theme', 'minimalist_blogger_x_theme_remove_elementor_onboarding');



/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function minimalist_blogger_x_theme_sanitize_checkbox($checked)
{
    // Boolean check.
    return ((isset($checked) && true == $checked) ? true : false);
}





/**
 *  Copyright and License for Upsell button by Justin Tadlock - 2016-2018 © Justin Tadlock. customizer button https://github.com/justintadlock/trt-customizer-pro
 */
require_once(trailingslashit(get_template_directory()) . 'justinadlock-customizer-button/class-customize.php');






// Initialize information content
require_once trailingslashit(get_template_directory()) . 'inc/vendor/autoload.php';

use SuperbThemesThemeInformationContent\ThemeEntryPoint;

ThemeEntryPoint::init([
    'type' => 'classic', // block / classic
    'theme_url' => 'https://superbthemes.com/minimalist-blogger-x/',
    'demo_url' => 'https://superbthemes.com/demo/minimalist-blogger-x/',
    'features' => array(
array('title'=>'Customize All Fonts'),
array('title'=>'Customize All Colors'),
array('title'=>'Customize Blog Layout And Design'),
array('title'=>'Customize Navigation Layout and Design'),
array('title'=>'Customize Post / Page Design'),
array('title'=>'Customize Footer Design'),
array('title'=>'Show Full Posts on Blog.'),
array('title'=>'Custom Copyright Text In Footer.'),
array('title'=>'Show "Continue Reading" Button on blog.'),
array('title'=>'Show Go To Top Button.'),
array('title'=>'Hide/show Related Posts On Posts And Pages.'),
array('title'=>'Activate Image Optimization.'),
array('title'=>'Optimized Mobile Layout'),
array('title'=>'Hide Author Name From Byline.'),
array('title'=>'Hide/show Next/previous Buttons On Posts.'),
array('title'=>'Hide/show Categories And Tags On Posts And Pages.'),
array('title'=>'Hide/show Shopping Cart in Navigation.'),
array('title'=>'Only Show Header On Front Page.'),
array('title'=>'Add A About The Author Section.'),
array('title'=>'Hide/Show Sidebar on WooCommerce Pages.'),
array('title'=>'Hide/Show Sidebar on Blog Feed, Search Page and Archive Pages.'),
array('title'=>'Hide/Show Header Button on Mobile.'),
array('title'=>'Custom border radius on elements & buttons.'),
array('title'=>'Only Display Header Widgets on Front Page.'),
array('title'=>'Choose Between Multiple Navigation Layouts.'),
array('title'=>'Choose Between Multiple Blog Layouts.'),
array('title'=>'Show Recent Posts on 404 Page.'),
array('title'=>'Show Recent Posts on 404 Page.'),
array('title'=>'Add Custom Button To Header.'),
array('title'=>'Hide/Show Header Tagline on Mobile.'),
array('title'=>'Choose Featured Image Mode'),
array('title'=>'Add Recent Posts Widget'),
array('title'=>'Remove "Tag" from tag page title'),
array('title'=>'Remove "Author" from author page title'),
array('title'=>'Remove "Category" from author page title')
    )
]);
