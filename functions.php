<?php

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('google_fonts', '//fonts.googleapis.com/css?family=Playfair+Display|Raleway&display=swap" rel="stylesheet', false, null);
    wp_enqueue_style('icone_fonts', '//cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css', false, null);
    wp_enqueue_style('startheme-styles', get_template_directory_uri() . '/dist/css/main.css', false, null);
    wp_enqueue_script('startheme-scripts', get_template_directory_uri() . '/dist/js/main.js', ['jquery'], null, true);
    wp_localize_script('startheme-scripts', 'WPURLS', array('themeURL' => get_template_directory_uri()));
    }, 100);


/**
 * Theme configuration
 */
add_action('after_setup_theme', function () {

    //Register Custom Navigation Walker
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

    // Document title
    add_theme_support('title-tag');

    // Post thumbnails
    add_theme_support('post-thumbnails');

    // Translations
    load_theme_textdomain('startheme', get_template_directory() . '/languages');

    // Navigations
    register_nav_menus(
        array(
            'primary' => __('Navigation principale', 'startheme'),
            'footer_navigation' => __('Navigation pied de page', 'startheme'),
            'social' => __('Navigation sociale', 'startheme')
        )
    );

    // Custom Image sizes
    add_image_size('thumb-medium', 350, 250, true);
    add_image_size('thumb-large', 550, 1100, false);
});

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title h3">',
        'after_title' => '</h3>'
    ];
    register_sidebar([
            'name' => __('Zone droite', 'startheme') . ' ' . 1,
            'id' => 'sidebar-right'
        ] + $config);
    register_sidebar([
            'name' => __('Zone pied de page', 'startheme') . ' ' . 1,
            'id' => 'footer-sidebar-1'
        ] + $config);
    register_sidebar([
            'name' => __('Zone pied de page', 'startheme') . ' ' . 2,
            'id' => 'footer-sidebar-2'
        ] + $config);
    register_sidebar([
            'name' => __('Zone pied de page', 'startheme') . ' ' . 3,
            'id' => 'footer-sidebar-3'
        ] + $config);
});

/**
 * Excerpt More link
 */
add_filter('excerpt_length', function ($length) {
    return 20;
}, 999);

add_filter('excerpt_more', function () {
    return '&hellip;<div class="more-link"><a class="btn btn-outline-danger" href="' . get_permalink() . '" >' . __('Lire la suite', 'startheme') . '</a></div>';
});

/**
 * Archive title
 */
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        if (is_category(5)) {
            $title = __('Nos actualités', 'startheme');
        } else {
            $title = single_cat_title(__('Actualités', 'startheme') . ' - ', false);
        }
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive()) {
        if (get_post_type() == 'nos_proprietes') {
            $title = __('Nos propriétés', 'startheme');
        } else {
            $title = post_type_archive_title('', false);
        }
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }
    return $title;
});

add_action('pre_get_posts', function ($query) {

    if (is_admin()) return;
    if (!$query->is_main_query()) return;

    if (is_post_type_archive('nos_proprietes')) {

        if (isset($_GET['vil'])) {
            $query->set('tax_query', array(
                array(
                    'numberposts' => 6,
                    'taxonomy' => 'ville',
                    'field' => 'term_id',
                    'terms' => $_GET['vil']
                )
            ));
        }
    }

    return;

});

