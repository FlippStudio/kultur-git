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

// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'Spotkania KulturLove';
}

add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

function admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
    $wp_admin_bar->remove_menu( 'wpa-logout' );
}
add_action( 'wp_before_admin_bar_render', 'admin_bar_remove_logo', 0 );

function customize_dashboard_name(){
    remove_menu_page( 'index.php' ); 
}
add_action( 'admin_menu', 'customize_dashboard_name' );

function customize_dashboard_title(){
    if ( $GLOBALS['title'] != 'Kokpit' ){
        return;
    }
    
    $GLOBALS['title'] =  __( 'Mój profil' ); 
}
add_action( 'admin_head', 'customize_dashboard_title' );

// wp application passwords available remove
add_filter('wp_is_application_passwords_available', '__return_false');

function admin_default_page() {
	return 'https://kulturlove.pl';
  }
  
  add_filter('login_redirect', 'admin_default_page');

function remove_website_row_css()
{
	echo '<style>tr.user-url-wrap, #simple-local-avatar-section .ratings-row, tr.user-profile-picture{ display: none; }</style>';
	echo '<script> jQuery(document).ready(function($) { $("#simple-local-avatar-section h3").text("Zdjęcie profilowe"); $("#simple-local-avatar-section .form-table th label").text("Prześlij zdjęcie"); $("#simple-local-avatar-remove").text("Usuń zdjęcie profilowe");})</script>';
}
add_action( 'admin_head-user-edit.php', 'remove_website_row_css' );
add_action( 'admin_head-profile.php',   'remove_website_row_css' );

function remove_website_row_css_meetings()
{
	echo '<style>#minor-publishing{ display: none; } #poststuff #post-body.columns-2{margin-right: 0;} #post-body.columns-2 #postbox-container-1{float: none;margin-right: 0;width: 100%;} #post-body-content{float: none;} #poststuff #post-body.columns-2 #side-sortables{width: 100%;}</style>';
	echo '<script> jQuery(document).ready(function($) { $("#publish").prop("value", "Dodaj spotkanie"); })</script>';
}
add_action( 'admin_head', 'remove_website_row_css_meetings' );

?>