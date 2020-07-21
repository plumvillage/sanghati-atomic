<?php

add_action( 'wp_enqueue_scripts', function () {

    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'style.min.css',
        get_stylesheet_directory_uri() . '/css/style.min.css',
        [
            'atomic-blocks-shared-styles'
        ]
    );

    wp_enqueue_script(
        'main.min.js',
        get_stylesheet_directory_uri() . '/js/main.min.js',
        [ 'jquery' ],
        1.1,
        true
    );
});


// add theme options page
if( function_exists('acf_add_options_page') ) { 
    acf_add_options_page();
}

function redirect_based_on_ip() {
  if(!is_admin()){  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }  
    $apiUrl = 'https://pro.ip-api.com/json/'.$ip.'?fields=status,message,countryCode&key=' . get_field('ip_api_key', 'options');
    $response = wp_remote_get($apiUrl);
    $responseBody = wp_remote_retrieve_body( $response );
    $result = json_decode( $responseBody );
    if (! is_wp_error( $result ) && $result->status == 'success') {
      if($result->countryCode == 'US'){
        wp_redirect(get_field('us_donate_url', 'options'));
        exit;
      }
    }
  }
}

add_action('init', 'redirect_based_on_ip', 10, 0);
