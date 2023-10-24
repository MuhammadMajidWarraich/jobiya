<?php

function majid_theme_supports(){
	add_theme_support('post-formats', array('aside', 'quote', 'status', 'gallery', 'image', 'chat', 'link', 'audio', 'video'));
}
add_action('after_theme_setup', 'majid_theme_supports');
	add_theme_support('post-thumbnails');


// Function to enqueue styles and scripts
function majid_enqueue_scripts(){
    // Enqueue Stylesheets
    wp_enqueue_style('style', get_template_directory_uri().'/style.css', array(), '1.1', 'all');
    wp_enqueue_style('majid-style', get_template_directory_uri().'/css/majid-style.css', array(), '1.1', 'all');
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_style('slick-style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');

    // Enqueue JS
    wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array(), null, true);
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('jquery', 'popper-js'), null, true);
    //wp_enqueue_script('https://code.jquery.com/jquery-3.6.0.min.js'); // Enqueue jQuery
    wp_enqueue_script('slick-slider', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'majid_enqueue_scripts');
