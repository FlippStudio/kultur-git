<?php

/**
 * Redirect wp-login.php to either a 404 page or an alternative login URL from
 * something like WooCommerce.
 *
 * To enable the login redirect, put the following in your functions.php file.
 *
 * define('HW_IS_LOGIN_REDIRECT_ENABLED', true);
 *
 * If you want to redirect to an alternative URL instead of ot a 404, enable
 * the option like this:
 *
 * define('HW_IS_LOGIN_REDIRECT_TO_URL_ENABLED', true);
 *
 */

// Block direct access.
if (!defined('WPINC')) {
   exit('Do NOT access this file directly.');
}

function custom_get_is_showing_wp_login() {
   return (strpos($_SERVER["SCRIPT_NAME"], "/wp-login.php") === 0);
}

function custom_get_is_login_redirect_enabled() {
   return defined('HW_IS_LOGIN_REDIRECT_ENABLED') &&
      (HW_IS_LOGIN_REDIRECT_ENABLED === true);
}

function custom_get_login_redirect_to_url_enabled() {
   return defined('HW_IS_LOGIN_REDIRECT_TO_URL_ENABLED') &&
      (HW_IS_LOGIN_REDIRECT_TO_URL_ENABLED === true);
}

function custom_get_is_wp_login_being_attempted() {
   $request_uri = $_SERVER['REQUEST_URI'];
   return custom_get_is_showing_wp_login() &&
      (strpos($request_uri, 'action=') === false) &&
      (strpos($request_uri, 'checkemail=confirm') === false);
}

function custom_get_is_wp_lostpassword_being_attempted() {
   $request_uri = $_SERVER['REQUEST_URI'];
   return custom_get_is_showing_wp_login() && (
      (strpos($request_uri, 'action=lostpassword') !== false)
      ||
      (strpos($request_uri, 'action=resetpass') !== false)
      ||
      (strpos($request_uri, 'action=rp') !== false)
      ||
      (strpos($request_uri, 'checkemail=confirm') !== false)
   );
}

function custom_get_login_redirect_url() {
   $login_redirect_url = null;

   // if ($is_login_redirect_to_url_enabled) {
   if (function_exists('wc_get_page_permalink')) {
      // WooCommerce login URL
      $login_redirect_url = wc_get_page_permalink('myaccount');
   } elseif (function_exists('UM') && !empty($login_page_id = UM()->options()->get('core_login'))) {
      // UltimateMember login URL
      $login_redirect_url = get_permalink($login_page_id);
   } else {
      // TODO. Check for BuddyPress login URL?
      // else...
      // TODO. Check for alternative login URL?
      // etc...
   }
   // }

   return $login_redirect_url;
}

function custom_redirect_login() {
   $is_login_redirect_enabled = custom_get_is_login_redirect_enabled();
   $is_login_redirect_to_url_enabled = custom_get_login_redirect_to_url_enabled();
   $is_login_being_attempted = custom_get_is_wp_login_being_attempted();

   if ($is_login_redirect_enabled && $is_login_being_attempted) {
      $login_redirect_url = null;
      if ($is_login_redirect_to_url_enabled) {
         $login_redirect_url = custom_get_login_redirect_url();
      }

      if (!empty($login_redirect_url)) {
         // Redirect to a an alternative URL.
         wp_redirect($login_redirect_url);
         exit;
      } else {
         // Redirect to a 404.
         $GLOBALS['wp_query']->set_404();
         status_header(404);
         nocache_headers();
         include get_query_template('404');
         exit;
      }
   }
}
add_action('init', 'custom_redirect_login');

function custom_login_url($login_url, $redirect, $force_reauth) {
   $is_login_redirect_enabled = custom_get_is_login_redirect_enabled();
   $is_lost_password_being_attempted = custom_get_is_wp_lostpassword_being_attempted();

   if ($is_login_redirect_enabled &&
      $is_lost_password_being_attempted &&
      !empty($login_redirect_url = custom_get_login_redirect_url())
   ) {
      $login_url = $login_redirect_url;
   }

   return $login_url;
}
add_filter('login_url', 'custom_login_url', 10, 3);