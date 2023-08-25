### For WordPress Plugin Development Follow This

* :boom: :fire: :rocket: [My Plugin Template Repository](https://github.com/arafat-cdr/my_plugin_template)


```php

<?php
/*
 *
 * Plugin Name:       My Plugin Name
 * Plugin URI:        https://simplerscript.com/
 * Description:       Plugin Description
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Yeasir Arafat
 * Author URI:        https://simplerscript.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://simplerscript.com/ikomex-shipping
 * Text Domain:       my-text-domain
 * Domain Path:       /languages
 *
 */


// Direct Access Not Allowed

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// All Constant Goes Here

define( 'MY_PLUGIN_TEXT_DOMAIN', 'my-text-domain' );
define( 'MY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MY_PLUGIN_BASE_URL', plugin_dir_url( __FILE__ ) );

defined( 'MY_PLUGIN_LOGO', MY_PLUGIN_BASE_URL.'/assets/my-logo.png' );

// All Inludes Goes Here


// Hooks Goes Here


// Short Code Goes Here


```