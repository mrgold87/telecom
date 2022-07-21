<?php
function telecom_support_title()
{
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'telecom_support_title');
add_theme_support('post-thumbnails', array('slider'));
add_image_size('slider-thumb', 436, 315, true);
// css / js
function telecom_scripts()
{
    wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
    wp_enqueue_style('telecom-main', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style('telecom-style', get_stylesheet_uri());

    wp_enqueue_script('jquery');
    wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js', array('jquery'), false, true);
    wp_enqueue_script('init-owl-carousel', get_template_directory_uri() . '/js/custom.js', array('jquery', 'owl.carousel'), false, true);
}

add_action('wp_enqueue_scripts', 'telecom_scripts');

//CPT
add_action('init', 'telecom_register_post_type_init');

function telecom_register_post_type_init()
{
    $labels = [
        'name' => 'Слайдер',
        'singular_name' => 'Слайдер',
        'add_new' => 'Добавить новый слайд',
        'add_new_item' => 'Добавить новый слайд',
        'edit_item' => 'Редактировать слайд',
        'new_item' => 'Новый слайд',
        'all_items' => 'Все слайды',
        'search_items' => 'Поиск по слайдам',
        'not_found' => 'Не найдено',
        'menu_name' => 'Слайдер',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'slider'],
        'supports' => ['title', 'editor', 'thumbnail'],
    ];

    register_post_type('slider', $args);

    unset($args);
    unset($labels);

    $labels = [
        'name' => 'Тарифы',
        'singular_name' => 'Тариф',
        'add_new' => 'Добавить новый тариф',
        'add_new_item' => 'Добавить новый тариф',
        'edit_item' => 'Редактировать тариф',
        'new_item' => 'Новый тариф',
        'all_items' => 'Все тарифы',
        'search_items' => 'Поиск по тарифам',
        'not_found' => 'Не найдено',
        'menu_name' => 'Тарифы',
    ];

    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'tariff'],
        'supports' => ['title', 'editor'],
    ];

    register_post_type('tariff', $args);
}