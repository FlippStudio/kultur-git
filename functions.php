<?php
add_theme_support( 'post-thumbnails' );
add_image_size('galeria', 255, 174, true);
add_image_size('aktualnosci', 350, 263, true);
add_image_size('index', 395, 263, true);


/****************************
* Slider
****************************/
add_action('init', 'slider_register');

function slider_register() {
 $labels = array(
     'name' => _x('slider', 'post type general name'),
     'singular_name' => _x('slider', 'post type singular name'),
     'add_new' => _x('Dodaj nowy', 'product_leser'),
     'add_new_item' => __('Dodaj nowy'),
     'edit_item' => __('Edytuj'),
     'new_item' => __('Nowy'),
     'view_item' => __('Pokaz'),
     'search_items' => __('Szukaj'),
     'not_found' =>  __('Brak n'),
     'not_found_in_trash' => __('Brak w koszu'),
     'parent_item_colon' => '',
     'menu_name' => 'Slider'
 );

 $args = array(
     'label' => __('Slider'),
     'singular_label' => __('slider'),
     'public' => false,
     'show_ui' => true,
     'capability_type' => 'post',
     'hierarchical' => true,
     'rewrite' => true,
      'menu_icon' => 'dashicons-portfolio',
     'supports' => array('title','page-attributes'),
 );

 register_post_type( 'slider' , $args );
}

/****************************
* Partnerzy
****************************/
add_action('init', 'partner_register');

function partner_register() {
 $labels = array(
     'name' => _x('partner', 'post type general name'),
     'singular_name' => _x('partner', 'post type singular name'),
     'add_new' => _x('Dodaj nowy', 'product_leser'),
     'add_new_item' => __('Dodaj nowy'),
     'edit_item' => __('Edytuj'),
     'new_item' => __('Nowy'),
     'view_item' => __('Pokaz'),
     'search_items' => __('Szukaj'),
     'not_found' =>  __('Brak n'),
     'not_found_in_trash' => __('Brak w koszu'),
     'parent_item_colon' => '',
     'menu_name' => 'Partner'
 );

 $args = array(
     'label' => __('Partnerzy'),
     'singular_label' => __('partnerzy'),
     'public' => false,
     'show_ui' => true,
     'capability_type' => 'post',
     'hierarchical' => true,
     'rewrite' => true,
     'menu_icon' => 'dashicons-groups',
     'supports' => array('title', 'thumbnail', 'page-attributes'),
     'taxonomies' => array('category'),
 );

 register_post_type( 'partner' , $args );
}

// using function to add class to `the_post_thumbnail()`
function alter_attr_wpse_102158($attr) {
    remove_filter('wp_get_attachment_image_attributes','alter_attr_wpse_102158');
    $attr['class'] .= ' img-fluid';
    return $attr;
}
add_filter('wp_get_attachment_image_attributes','alter_attr_wpse_102158'); 


/****************************
* Media
****************************/
add_action('init', 'media_register');

function media_register() {
 $labels = array(
     'name' => _x('media', 'post type general name'),
     'singular_name' => _x('media', 'post type singular name'),
     'add_new' => _x('Dodaj nowy', 'product_leser'),
     'add_new_item' => __('Dodaj nowy'),
     'edit_item' => __('Edytuj'),
     'new_item' => __('Nowy'),
     'view_item' => __('Pokaz'),
     'search_items' => __('Szukaj'),
     'not_found' =>  __('Brak n'),
     'not_found_in_trash' => __('Brak w koszu'),
     'parent_item_colon' => '',
     'menu_name' => 'Media'
 );

 $args = array(
     'label' => __('Informacje medialne'),
     'singular_label' => __('informacje-medialne'),
     'public' => false,
     'show_ui' => true,
     'capability_type' => 'post',
     'hierarchical' => true,
     'rewrite' => true,
      'menu_icon' => 'dashicons-share',
     'supports' => array('title', 'page-attributes', 'thumbnail'),
 );

 register_post_type( 'media' , $args );
}
?>
