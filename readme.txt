=== Private Site ===
Contributors: cleancoded
Tags: private site, private website, private WordPress, private blog
Requires at least: 3.6
Tested up to: 4.9.8
Stable tag: 0.1

Keep your WordPress website private and require all users to be logged in.

== Description ==

<strong>Private Site</strong> is a plugin that keeps your WordPress website private. When active, this plugin will redirect all unauthenticated users to the WordPress login screen.

By default, the Private Site plugin requires users be added as a site member to view the website. You can broaden accessibility to any authenticated user by adding the following line to functions.php:

`add_filter( 'Private_Site_requires_membership', '__return_false' );`

== Installation ==

1. Install Private Site by uploading the `private-site` directory to your `/wp-content/plugins/` directory. 
2. Activate Private Site from the `Plugins` menu in WordPress.

Activating the plugin will make your WordPress website private.

== Frequently Asked Questions ==

None

== Changelog ==

= 0.1 (Aug. 27, 2018) =
* Initial release
