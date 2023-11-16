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

### Php Modify a Php/Any File Programitically

```php
<?php

// Adjust this path if your wp-config.php is in a different location
$file_path = ABSPATH . 'wp-config.php'; 

// Read the contents of the wp-config.php file
$config_content = file_get_contents($file_path);

$str_to_write = 'define("DISABLE_WP_CRON", true);';

if (strpos($config_content, $str_to_write) !== false) {
    echo "<br/>The line is already present in the string.";

} else {
    echo "<br/>The line is not present in the string.";
    # Now Write Back the String
    $config_data = str_replace( '<?php', '<?php'."\n\n".$str_to_write, $config_content);
    file_put_contents($file_path, $config_data);
}


```

### Php Remove Deep Empty Array From Arr

```php

<?php

// https://stackoverflow.com/questions/9895130/recursively-remove-empty-elements-and-subarrays-from-a-multi-dimensional-array

function removeEmptyValuesAndSubarrays($array){
   foreach($array as $k=>&$v){
        if(is_array($v)){
            $v=removeEmptyValuesAndSubarrays($v);  // filter subarray and update array
            if(!sizeof($v)){ // check array count
                unset($array[$k]);
            }
        }elseif(!strlen($v)){  // this will handle (int) type values correctly
            unset($array[$k]);
        }
   }
   return $array;
}



```

### Create a Php Log File Quickly

```php
<?php

// Specify the path to your log file
$logFilePath = __DIR__.'/log.txt';

// Check if the file exists, and if not, create it
if (!file_exists($logFilePath)) {
    touch($logFilePath); // Create an empty file
}

$str_to_log = 'This is a log Test';

file_put_contents($logFilePath, $str_to_log . PHP_EOL, FILE_APPEND);


```

### Php Get Current Url

```php

<?php

## Or Get the Full Page
$page_url  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


// http://localhost/wp_fb_feeds/shop/?my-ajax-nonce=18a2e81436&_wp_http_referer=%2Fwp_fb_feeds%2Fshop%2F%3Fmy-ajax-nonce%3D18a2e81436%26wl_year%3D2006%26wl_make%3DBMW%26wl_model%3D130%2Bi%26wl_chassis%3DE87%26wl_engine%3DN46B20B%26wl_supplement%3D306D5&wl_year=2004&wl_make=BMW&wl_model=420+d&wl_chassis=F32&wl_engine=B38B15A&wl_supplement=306D3
echo "Current URL: " . $page_url;

// Php Get Base Url Only
// http://localhost/wp_fb_feeds/shop/

$url_arr = parse_url($page_url);
pr( $url_arr );

$base_url_only = $url_arr['scheme'].'://'.$url_arr['host'].$url_arr['path'];

```