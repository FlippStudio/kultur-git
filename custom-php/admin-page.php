<?php 

function add_custom_menu_pages(){
    add_menu_page( 'Historia spotkań', 'Historia spotkań', 'read', get_page_link(295), '', 'dashicons-media-archive',  50);
    add_menu_page( 'Wiadomości', 'Wiadomości', 'read', get_page_link(311), '', 'dashicons-format-chat',  51);
    add_submenu_page( 'edit.php?post_type=meeting', __( 'Aktywne', 'textdomain' ), __( 'Aktywne', 'textdomain' ), 'read', 'edit.php?post_status=publish&post_type=meeting', '', 100 );
	add_submenu_page( 'edit.php?post_type=meeting', __( 'Historia', 'textdomain' ), __( 'Historia', 'textdomain' ), 'read', get_page_link(295), '', 150 );

}
add_action( 'init', 'add_custom_menu_pages' );

add_action('pre_get_posts', 'special_list' );
function special_list( $wp_query ) {
    if( is_admin()) {
        add_filter('views_edit-meeting', 'remove_edit_post_views');
    }
}

// add filter
function remove_edit_post_views($views) {
    global $wpdb, $wp_query, $current_user;
    
    $history = $wpdb->query("SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts WHERE wp_posts.post_type = 'meeting' AND wp_posts.post_status = 'closed' AND wp_posts.post_author = $current_user->ID");
	$active = $wpdb->query("SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts WHERE wp_posts.post_type = 'meeting' AND wp_posts.post_status = 'publish' AND wp_posts.post_author = $current_user->ID");
	$trash = $wpdb->query("SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts WHERE wp_posts.post_type = 'meeting' AND wp_posts.post_status = 'trash' AND wp_posts.post_author = $current_user->ID");

	($wp_query->query_vars['post_status'] == 'publish' || $wp_query->query_vars['post_status'] == 'NULL') ? $class = 'class="current"' : $class = '';
    $views['all'] = sprintf(__('<a href="%s"' . $class . '>Aktywne <span class="count"> (%d)</span></a>', 'active'), 'edit.php?post_status=publish&post_type=meeting', $active);
	$views['publish'] = sprintf(__('<a href="%s">Historia <span class="count"> (%d)</span></a>', 'history'), get_page_link(295), $history);
	($wp_query->query_vars['post_status'] == 'trash') ? $class_trash = 'class="current"' : $class_trash = '';
	$views['trash'] = sprintf(__('<a href="%s"' . $class_trash . '>Kosz <span class="count"> (%d)</span></a>', 'trash'), 'edit.php?post_status=trash&post_type=meeting', $trash);
	unset($views['mine']);

    return $views;
}

function custom_post_status(){
	register_post_status( 'closed', array(
		'label'                     => _x( 'Zamknięty', 'meeting' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => false,
		'show_in_admin_status_list' => false,
		'label_count'               => _n_noop( 'Zamknięty (%s)', 'Zamknięty (%s)' ),
	) );
}
add_action( 'init', 'custom_post_status' ); 
 
function wp37_limit_posts_to_author($query) {
	global $pagenow;
 
	if( 'edit.php' != $pagenow || !$query->is_admin )
	    return $query;
 
	if( ( !current_user_can( 'edit_others_posts' ) ) && ( $_GET['post_type'] == 'meeting' ) ) {
		global $user_ID;
		$query->set('author', $user_ID );
	}
	return $query;
}
add_filter('pre_get_posts', 'wp37_limit_posts_to_author');

?>