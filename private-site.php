<?php
/*
Plugin Name: Private Site
Version: 0.2.0
Description: Keep your WordPress website private.
Author: CLEANCODED
Author URI: https://cleancoded.com
Plugin URI: https://github.com/cleancoded/private-site
Text Domain: private-site
*/

class Private_Site {

	private static $instance;

	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new Private_Site;
			self::$instance->setup_actions();
		}

		return self::$instance;
	}

	/**
	 * WordPress API integrations
	 */
	private function setup_actions() {

		add_action( 'template_redirect', array( $this, 'action_template_redirect' ) );	
		add_filter( 'rest_authentication_errors', array( $this, 'filter_rest_authentication_errors' ) );
	}

	/**
	 * Can this user view the WordPress website?
	 * @return bool
	 */
	private function user_can_view() {

		if ( is_user_logged_in() ) {

			// Viewing the WordPress website requires users to be authenticated
			$requires_membership = apply_filters( 'Private_Site_requires_membership', true );
			if ( $requires_membership && ! is_user_member_of_blog() ) {
				return false;
			}

			return true;
		}

		return false;
	}

	/**
	 * If a user isn't authenticated, redirect them to the login page
	 */
	public function action_template_redirect() {
		global $pagenow;

		if ( 'wp-login.php' !== $pagenow && ! $this->user_can_view() ) {
			auth_redirect();
		}
	}

	public function filter_rest_authentication_errors( $result ) {
		if ( ! empty( $result ) ) {
			return $result;
		}
		if ( ! self::user_can_view() ) {
			return new WP_Error( 'restx_logged_out', 'Sorry, you must be logged in to view this website.', array( 'status' => 401 ) );
		}
		return $result;
	}
}

/**
 * Load plugin
 */
function Private_Site() {
	return Private_Site::get_instance();
}
add_action( 'plugins_loaded', 'Private_Site' );
