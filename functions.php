<?php

add_action( 'wp_enqueue_scripts', function () {

    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'style.min.css',
        get_stylesheet_directory_uri() . '/css/style.min.css'
    );

    wp_enqueue_script(
        'main.min.js',
        get_stylesheet_directory_uri() . '/js/main.min.js',
        [ 'jquery' ],
        1.1,
        true
    );
});
