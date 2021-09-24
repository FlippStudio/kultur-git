<?php

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
     'supports' => array('title','page-attributes', 'thumbnail'),
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


/****************************
* Instytucje
****************************/
add_action('init', 'institution_register');

function institution_register() {
 $labels = array(
     'name' => _x('Institution', 'post type general name'),
     'singular_name' => _x('institution', 'post type singular name'),
     'add_new' => _x('Dodaj nowy', 'product_leser'),
     'add_new_item' => __('Dodaj nowy'),
     'edit_item' => __('Edytuj'),
     'new_item' => __('Nowy'),
     'view_item' => __('Pokaz'),
     'search_items' => __('Szukaj'),
     'not_found' =>  __('Brak n'),
     'not_found_in_trash' => __('Brak w koszu'),
     'parent_item_colon' => '',
     'menu_name' => 'Institution'
 );
 

 $args = array(
     'label' => __('Miejsca spotkań'),
     'singular_label' => __('miejsca-wydarzenia-instytucje'),
     'public' => true,
     'show_ui' => true,
     'capability_type' => 'post',
     'hierarchical' => true,
     'rewrite' => true,
      'menu_icon' => 'dashicons-tickets',
     'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
 );

 register_post_type( 'institution' , $args );

 register_taxonomy( 'places', array('institution'), array(
    'hierarchical' => true, 
    'label' => 'Kategorie', 
    'singular_label' => 'kategoria', 
    'rewrite' => array( 'slug' => 'places', 'with_front'=> false )
    )
    );

    register_taxonomy_for_object_type( 'categories', 'institution' );
}


/****************************
* Forum
****************************/
add_action('init', 'forum_register');

function forum_register() {
    
 $labels = array(
     'name' => _x('Discussion', 'post type general name'),
     'singular_name' => _x('discussion', 'post type singular name'),
     'add_new' => _x('Dodaj nowy', 'product_leser'),
     'add_new_item' => __('Dodaj nowy'),
     'edit_item' => __('Edytuj'),
     'new_item' => __('Nowy'),
     'view_item' => __('Pokaz'),
     'search_items' => __('Szukaj'),
     'not_found' =>  __('Brak n'),
     'not_found_in_trash' => __('Brak w koszu'),
     'parent_item_colon' => '',
     'menu_name' => 'Discussion'
 );
 

 $args = array(
     'label' => __('Forum'),
     'singular_label' => __('forum'),
     'public' => true,
     'show_ui' => true,
     'capability_type' => 'post',
     'hierarchical' => true,
     'rewrite' => true,
     'menu_icon' => 'dashicons-format-chat',
     'supports' => array('title', 'editor', 'page-attributes', 'thumbnail', 'author','comments'),
 );

 register_post_type( 'discussion' , $args );

 register_taxonomy('subjects', array('discussion'), array(
    'hierarchical' => true,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'forum' ),
  ));
}


/****************************
* Wydarzenia / spotkania
****************************/
add_action('init', 'meeting_module_register');

function meeting_module_register() {
    
 $labels = array(
     'name' => _x('Meetings', 'post type general name'),
     'singular_name' => _x('meetings', 'post type singular name'),
     'add_new' => _x('Dodaj nowy', 'product_leser'),
     'add_new_item' => __('Dodaj nowy'),
     'edit_item' => __('Edytuj'),
     'new_item' => __('Nowy'),
     'view_item' => __('Pokaz'),
     'search_items' => __('Szukaj'),
     'not_found' =>  __('Brak n'),
     'not_found_in_trash' => __('Brak w koszu'),
     'parent_item_colon' => '',
     'menu_name' => 'Meetings'
 );
 

 $args = array(
     'label' => __('Spotkanie'),
     'singular_label' => __('spotkanie'),
     'public' => false,
     'show_ui' => true,
     'capability_type' => 'post',
     'hierarchical' => false,
     'rewrite' => true,
     'menu_icon' => 'dashicons-buddicons-buddypress-logo',
     'supports' => array('title'),
 );

 register_post_type( 'meeting' , $args );

}

?>